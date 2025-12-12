<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by recent users
        if ($request->has('filter_recent') && $request->filter_recent != 'all') {
            if ($request->filter_recent == 'recent') {
                $query->where('created_at', '>=', now()->subDays(7));
            } elseif ($request->filter_recent == 'old') {
                $query->where('created_at', '<', now()->subDays(7));
            }
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');
        $users = $query->paginate(12);

        return view('pages.guest.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.guest.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Logic Upload Foto
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $data['foto_profil'] = $filename;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');}

    public function show(User $user)
    {
        return view('pages.guest.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.guest.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Tambahkan validasi role
            'role' => 'required|in:super_admin,staff,guest',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role, // Tambahkan ini agar role tersimpan
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Logic Update Foto
        if ($request->hasFile('foto_profil')) {
            // 1. Hapus foto lama jika ada
            if ($user->foto_profil && File::exists(public_path('uploads/profile/' . $user->foto_profil))) {
                File::delete(public_path('uploads/profile/' . $user->foto_profil));
            }

            // 2. Upload foto baru
            $file = $request->file('foto_profil');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $data['foto_profil'] = $filename;
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {

        // Hapus foto profil fisik saat user dihapus
        if ($user->foto_profil && File::exists(public_path('uploads/profile/' . $user->foto_profil))) {
            File::delete(public_path('uploads/profile/' . $user->foto_profil));
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
