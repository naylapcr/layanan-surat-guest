<?php
namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\PermohonanSurat;
use App\Models\Warga;
use Illuminate\Http\Request;
use App\Models\Multipleuploads;

class PermohonanSuratController extends Controller
{
// Tampilkan daftar data
    public function index()
    {
        $dataPermohonanSurat = \App\Models\PermohonanSurat::with(['warga', 'jenisSurat'])
        ->orderBy('created_at', 'desc')
        ->paginate(12); // Angka 12 adalah jumlah data per halaman
        return view('pages.guest.permohonan-surat.index', compact('dataPermohonanSurat'));
    }

    public function create()
    {
        return view('pages.guest.permohonan-surat.create');
    }

    // Fungsi Store dengan Multiple Upload
    public function store(Request $request)
    {
        $request->validate([
            'filename.*' => 'mimes:doc,docx,pdf,jpg,jpeg,png|max:2048'
        ]);

        // Simpan data permohonan surat utama
        $data = PermohonanSurat::create($request->all());

        // Upload Multiple File
        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $file->move(public_path('uploads/permohonan'), $filename);

                Multipleuploads::create([
                    'filename' => $filename,
                    'ref_table' => 'permohonan_surat',
                    'ref_id' => $data->id,
                ]);
            }
        }

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan berhasil dibuat!');
    }

    // Fungsi Show untuk Detail
    public function show($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $files = Multipleuploads::where('ref_table', 'permohonan_surat')
                                 ->where('ref_id', $id)
                                 ->get();

        return view('pages.guest.permohonan-surat.show', compact('permohonan', 'files'));
    }

    public function edit($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $files = Multipleuploads::where('ref_table', 'permohonan_surat')
                                 ->where('ref_id', $id)
                                 ->get();
        return view('pages.guest.permohonan-surat.edit', compact('permohonan', 'files'));
    }

    // Fungsi Update dengan Tambah File Baru
    public function update(Request $request, $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->update($request->all());

        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $file) {
                $filename = round(microtime(true) * 1000) . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads/permohonan'), $filename);

                Multipleuploads::create([
                    'filename' => $filename,
                    'ref_table' => 'permohonan_surat',
                    'ref_id' => $id,
                ]);
            }
        }

        return redirect()->route('permohonan-surat.index')->with('success', 'Data diperbarui!');
    }

    // Fungsi Hapus File Satuan (Opsional untuk halaman edit)
    public function deleteFile($id)
    {
        $file = Multipleuploads::findOrFail($id);
        $path = public_path('uploads/permohonan/' . $file->filename);
        if (File::exists($path)) {
            File::delete($path);
        }
        $file->delete();
        return back()->with('success', 'File berhasil dihapus!');
    }
}
