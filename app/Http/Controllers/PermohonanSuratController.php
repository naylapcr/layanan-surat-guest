<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\Media; // PENTING: Gunakan Model Media, bukan Multipleuploads
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PermohonanSuratController extends Controller
{
    /**
     * Menampilkan daftar permohonan surat.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status'];

        $permohonan['permohonan'] = PermohonanSurat::with(['warga', 'jenisSurat', 'files'])
                                    ->filter($request, $filterableColumns)
                                    ->latest()
                                    ->paginate(10)
                                    ->withQueryString();

        return view('pages.guest.permohonan-surat.index', $permohonan);
    }

    /**
     * Menampilkan form untuk membuat permohonan baru.
     */
    public function create()
    {
        $permohonan['dataWarga'] = Warga::all();
        $permohonan['dataJenisSurat'] = JenisSurat::all();

        return view('pages.guest.permohonan-surat.create', $permohonan);
    }

    /**
     * Menyimpan permohonan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_permohonan'  => 'required|unique:permohonan_surat,nomor_permohonan',
            'pemohon_warga_id'  => 'required|exists:warga,warga_id',
            'jenis_id'          => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status'            => 'required',
            'files.*'           => 'required|mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
        ]);

        // 1. Simpan Data Utama
        $permohonan = PermohonanSurat::create($request->except('files'));

        // 2. Proses Upload File (Menggunakan Tabel Media)
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $file->move(public_path('uploads'), $filename);

                    Media::create([
                        'file_url'   => $filename,
                        'ref_table'  => 'permohonan_surat',
                        'ref_id'     => $permohonan->permohonan_id,
                        'caption'    => $file->getClientOriginalName(),
                        'mime_type'  => $file->getClientMimeType(),
                        'sort_order' => 0
                    ]);
                }
            }
        }

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail spesifik.
     */
    public function show(string $id)
    {
        // Ambil data permohonan
        $permohonan = PermohonanSurat::with(['warga', 'jenisSurat'])->findOrFail($id);

        // Ambil file dari tabel Media
        $files = Media::where('ref_table', 'permohonan_surat')
                      ->where('ref_id', $id)
                      ->get();

        return view('pages.guest.permohonan-surat.show', compact('permohonan', 'files'));
    }

    /**
     * Menampilkan form untuk mengedit permohonan.
     */
    public function edit(string $id)
    {
        $permohonan['permohonan'] = PermohonanSurat::findOrFail($id);
        $permohonan['dataWarga'] = Warga::all();
        $permohonan['dataJenisSurat'] = JenisSurat::all();

        return view('pages.guest.permohonan-surat.edit', $permohonan);
    }

    /**
     * Mengupdate data permohonan.
     */
    public function update(Request $request, string $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $request->validate([
            'nomor_permohonan'  => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'pemohon_warga_id'  => 'required|exists:warga,warga_id',
            'jenis_id'          => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status'            => 'required',
            'files.*'           => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2048',
        ]);

        // 1. Update Data Utama
        $permohonan->update($request->except('files'));

        // 2. Proses Upload File Susulan (Menggunakan Tabel Media)
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $file->move(public_path('uploads'), $filename);

                    Media::create([
                        'file_url'   => $filename,
                        'ref_table'  => 'permohonan_surat',
                        'ref_id'     => $id,
                        'caption'    => $file->getClientOriginalName(),
                        'mime_type'  => $file->getClientMimeType(),
                        'sort_order' => 0
                    ]);
                }
            }
        }

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil diupdate!');
    }

    /**
     * Menghapus data permohonan.
     */
    public function destroy(string $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        // Hapus file fisik dan record di Media
        $files = Media::where('ref_table', 'permohonan_surat')->where('ref_id', $id)->get();
        foreach($files as $file){
            if(File::exists(public_path('uploads/' . $file->file_url))){
                File::delete(public_path('uploads/' . $file->file_url));
            }
            $file->delete();
        }

        $permohonan->delete();

        return redirect()->route('permohonan-surat.index')->with('success', 'Data permohonan berhasil dihapus!');
    }

    /**
     * Fungsi Hapus File Spesifik.
     */
    public function deleteFile($id)
    {
        $file = Media::findOrFail($id);

        // Hapus file fisik
        if(File::exists(public_path('uploads/' . $file->file_url))){
            File::delete(public_path('uploads/' . $file->file_url));
        }

        $permohonanId = $file->ref_id;
        $file->delete(); // Hapus dari DB

        return redirect()->route('permohonan-surat.show', $permohonanId)->with('success', 'Berkas berhasil dihapus.');
    }
}
