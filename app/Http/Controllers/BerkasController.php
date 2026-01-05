<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use App\Models\Media;
use Illuminate\Support\Facades\File;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // PERBAIKAN: Gunakan 'permohonan' dan 'permohonan.jenisSurat' (nested relation)
        // Jangan gunakan 'jenisSurat' langsung karena relasinya tidak ada di model Berkas.
        $query = BerkasPersyaratan::with(['permohonan.jenisSurat', 'media']);

        // Fitur Pencarian (Opsional, jika ingin diaktifkan)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_berkas', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('permohonan', function($q) use ($search) {
                      $q->where('nomor_permohonan', 'LIKE', '%' . $search . '%');
                  });
        }

        $data = $query->latest()->get(); // Menggunakan get() sesuai struktur awal Anda

        return view('pages.guest.berkas-persyaratan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permohonan = PermohonanSurat::all();
        return view('pages.guest.berkas-persyaratan.create', compact('permohonan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'permohonan_id' => 'required',
            'nama_berkas' => 'required',
            'file' => 'required|mimes:pdf,jpg,png|max:2048'
        ]);

        $berkas = BerkasPersyaratan::create([
            'permohonan_id' => $request->permohonan_id,
            'nama_berkas' => $request->nama_berkas,
            'valid' => 0 // Default belum valid
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            // SIMPAN KE MEDIA (Tabel Baru)
            Media::create([
                'ref_table'  => 'berkas_persyaratan',
                'ref_id'     => $berkas->berkas_id,
                'file_url'   => $filename,
                'caption'    => $request->nama_berkas,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => 0
            ]);
        }

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);
        return view('pages.guest.berkas-persyaratan.edit', compact('berkas'));
    }

    public function update(Request $request, string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);

        $request->validate([
            'nama_berkas' => 'required',
            'valid'       => 'required|boolean',
        ]);

        $berkas->update([
            'nama_berkas' => $request->nama_berkas,
            'valid'       => $request->valid,
        ]);

        return redirect()->route('berkas.index')->with('success', 'Data berkas berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);

        // Hapus Media terkait (Tabel Media)
        $media = Media::where('ref_table', 'berkas_persyaratan')->where('ref_id', $id)->first();
        if($media) {
            if(File::exists(public_path('uploads/' . $media->file_url))) {
                File::delete(public_path('uploads/' . $media->file_url));
            }
            $media->delete();
        }

        $berkas->delete();
        return redirect()->route('berkas.index')->with('success', 'Berkas dihapus');
    }
}
