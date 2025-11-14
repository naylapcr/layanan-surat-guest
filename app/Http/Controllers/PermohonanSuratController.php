<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\JenisSurat;
use App\Models\Warga;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data permohonan beserta relasi Warga dan JenisSurat
        $dataPermohonanSurat = PermohonanSurat::with(['warga', 'jenisSurat'])
            ->orderBy('tanggal_pengajuan', 'desc')
            ->paginate(10);

        return view('pages.guest.permohonan-surat.index', compact('dataPermohonanSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Debug: Cek data langsung
    $dataJenisSurat = \App\Models\JenisSurat::all();
    $dataWarga = \App\Models\Warga::all();

    // Log untuk debugging
    \Log::info('Create Permohonan - Jenis Surat Count: ' . $dataJenisSurat->count());
    \Log::info('Create Permohonan - Warga Count: ' . $dataWarga->count());

    // Jika development, tampilkan debug info
    if (app()->environment('local')) {
        logger('Jenis Surat Data:', $dataJenisSurat->toArray());
        logger('Warga Data:', $dataWarga->toArray());
    }

    return view('pages.guest.permohonan-surat.create', compact('dataJenisSurat', 'dataWarga'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,jenis_surat_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'status' => 'required|in:DRAFT,DIAJUKAN,DIPROSES,DITOLAK,SELESAI,DIAMBIL',
            'catatan' => 'nullable|string',
        ]);

        // Generate Nomor Permohonan otomatis
        $lastId = PermohonanSurat::max('permohonan_id') ?? 0;
        $nomorPermohonan = 'PMH-' . date('Ymd') . '-' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        PermohonanSurat::create([
            'nomor_permohonan' => $nomorPermohonan,
            'warga_id' => $request->warga_id,
            'jenis_surat_id' => $request->jenis_surat_id,
            'tanggal_pengajuan' => now()->toDateString(),
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil diajukan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);

        // Coba beberapa kemungkinan nama kolom
        try {
            $dataJenisSurat = JenisSurat::orderBy('nama_jenis', 'asc')->get();
        } catch (\Exception $e) {
            try {
                $dataJenisSurat = JenisSurat::orderBy('nama', 'asc')->get();
            } catch (\Exception $e) {
                // Jika semua gagal, ambil tanpa order
                $dataJenisSurat = JenisSurat::all();
            }
        }

        $dataWarga = Warga::orderBy('nama', 'asc')->get();

        return view('pages.guest.permohonan-surat.edit', compact('permohonanSurat', 'dataJenisSurat', 'dataWarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);

        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,jenis_surat_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'status' => 'required|in:DRAFT,DIAJUKAN,DIPROSES,DITOLAK,SELESAI,DIAMBIL',
            'catatan' => 'nullable|string',
        ]);

        $permohonanSurat->update([
            'warga_id' => $request->warga_id,
            'jenis_surat_id' => $request->jenis_surat_id,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $permohonanSurat->delete();

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil dihapus!');
    }
}
