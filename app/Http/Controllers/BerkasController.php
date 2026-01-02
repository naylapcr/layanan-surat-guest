<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasPersyaratan;
use App\Models\JenisSurat; // PENTING: Import Model ini
use App\Models\Media;
use Illuminate\Support\Facades\File;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Gunakan pagination dan filter pencarian agar sesuai dengan View Index
        $query = BerkasPersyaratan::with('jenisSurat'); // Menggunakan relasi ke Jenis Surat

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_berkas', 'LIKE', '%' . $search . '%');
        }

        $data = $query->latest()->paginate(9)->withQueryString();

        // Pastikan path view sesuai folder Anda
        return view('pages.guest.berkas-persyaratan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // PERBAIKAN UTAMA: Ambil data JenisSurat, bukan PermohonanSurat
        $jenisSurat = JenisSurat::all();

        // Kirim variabel $jenisSurat ke view agar tidak error "Undefined variable"
        return view('pages.guest.berkas-persyaratan.create', compact('jenisSurat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Sesuaikan validasi dengan form Master Data
        $request->validate([
            'nama_berkas'    => 'required|string|max:255',
            'jenis_surat_id' => 'nullable|exists:jenis_surat,jenis_id', // Pastikan nama kolom primary key di tabel jenis_surat benar
        ]);

        // Simpan data persyaratan
        $berkas = BerkasPersyaratan::create([
            'jenis_surat_id' => $request->jenis_surat_id, // Masuk ke kolom jenis_surat_id
            'nama_berkas'    => $request->nama_berkas,
            'deskripsi'      => $request->deskripsi,
            'is_required'    => $request->has('is_required') ? 1 : 0,
            'valid'          => 1 // Default valid karena dibuat oleh admin
        ]);

        return redirect()->route('berkas.index')->with('success', 'Persyaratan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);
        $jenisSurat = JenisSurat::all(); // Perlu ini untuk dropdown edit

        return view('pages.guest.berkas-persyaratan.edit', compact('berkas', 'jenisSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);

        $request->validate([
            'nama_berkas' => 'required|string|max:255',
        ]);

        $berkas->update([
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_berkas'    => $request->nama_berkas,
            'deskripsi'      => $request->deskripsi,
            'is_required'    => $request->has('is_required') ? 1 : 0,
        ]);

        return redirect()->route('berkas.index')->with('success', 'Data persyaratan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);
        $berkas->delete();

        return redirect()->route('berkas.index')->with('success', 'Persyaratan berhasil dihapus');
    }
}
