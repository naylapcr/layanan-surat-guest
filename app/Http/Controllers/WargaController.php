<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        return view('pages.guest.data-warga.index', compact('warga'));
    }

    public function create()
    {
        return view('pages.guest.data-warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|max:16',
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pekerjaan' => 'required|max:255',
            'telp' => 'required|max:15',
            'email' => 'nullable|email',
        ]);

        try {
            Warga::create($request->all());
            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data warga: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Warga $warga)
    {
        return view('pages.guest.data-warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id|max:16',
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pekerjaan' => 'required|max:255',
            'telp' => 'required|max:15',
            'email' => 'nullable|email',
        ]);

        try {
            $warga->update($request->all());
            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data warga: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Warga $warga)
    {
        try {
            $warga->delete();
            return redirect()->route('warga.index')
                ->with('success', 'Data warga berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data warga: ' . $e->getMessage());
        }
    }
}
