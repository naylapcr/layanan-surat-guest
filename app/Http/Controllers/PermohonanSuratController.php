<?php
namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\PermohonanSurat;
use App\Models\Warga;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = PermohonanSurat::with(['warga', 'jenisSurat']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_permohonan', 'like', "%{$search}%")
                  ->orWhereHas('warga', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->has('filter_status') && $request->filter_status != 'all') {
            $query->where('status', $request->filter_status);
        }

        // Order by latest
        $query->orderBy('tanggal_pengajuan', 'desc');

        $dataPermohonanSurat = $query->paginate(12);

        return view('pages.guest.permohonan-surat.index', compact('dataPermohonanSurat'));
    }

    public function create()
    {
        $dataJenisSurat = JenisSurat::all();
        $dataWarga = Warga::all();

        return view('pages.guest.permohonan-surat.create', compact('dataJenisSurat', 'dataWarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,jenis_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'status' => 'required|in:DRAFT,DIAJUKAN,DIPROSES,DITOLAK,SELESAI,DIAMBIL',
            'catatan' => 'nullable|string',
        ]);

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

    public function edit($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $dataJenisSurat = JenisSurat::orderBy('nama_jenis', 'asc')->get();
        $dataWarga = Warga::orderBy('nama', 'asc')->get();

        return view('pages.guest.permohonan-surat.edit', compact('permohonanSurat', 'dataJenisSurat', 'dataWarga'));
    }

    public function update(Request $request, $id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);

        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,jenis_id',
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

    public function destroy($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $permohonanSurat->delete();

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil dihapus!');
    }

    public function show($id)
    {
        $permohonan = PermohonanSurat::with(['warga', 'jenisSurat'])->findOrFail($id);

        return view('pages.guest.permohonan-surat.show', compact('permohonan'));
    }
}
