<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataJenisSurat'] = \App\Models\JenisSurat::all();
        return view('pages.guest.jenis-surat.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.guest.jenis-surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required'
        ]);

        \App\Models\JenisSurat::create([
            'kode' => $request->kode,
            'nama_jenis' => $request->nama_jenis,
            'syarat_json' => $request->syarat_json
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataJenisSurat'] = \App\Models\JenisSurat::findOrFail($id);
        return view('pages.guest.jenis-surat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisSurat = \App\Models\JenisSurat::findOrFail($id);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisSurat = \App\Models\JenisSurat::findOrFail($id);
        $jenisSurat->delete();

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus!');
    }
}
