<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisSurat::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_jenis', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%");
            });
        }

        // Filter by syarat
        if ($request->has('filter_syarat') && $request->filter_syarat != 'all') {
            if ($request->filter_syarat == 'with-syarat') {
                $query->whereNotNull('syarat_json')->where('syarat_json', '!=', '');
            } elseif ($request->filter_syarat == 'without-syarat') {
                $query->where(function($q) {
                    $q->whereNull('syarat_json')->orWhere('syarat_json', '');
                });
            }
        }

        // Order by latest
        $query->orderBy('created_at', 'desc');

        $dataJenisSurat = $query->paginate(12);

        return view('pages.guest.jenis-surat.index', compact('dataJenisSurat'));
    }

    public function create()
    {
        return view('pages.guest.jenis-surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required'
        ]);

        JenisSurat::create([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $dataJenisSurat = JenisSurat::findOrFail($id);
        return view('pages.guest.jenis-surat.edit', compact('dataJenisSurat'));
    }

    public function update(Request $request, string $id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required'
        ]);

        $jenisSurat->update([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->delete();

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus!');
    }
}
