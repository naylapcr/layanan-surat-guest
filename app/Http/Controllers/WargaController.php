<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataWarga = Warga::all();
        return view('guest.data-warga.data-warga', compact('dataWarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.data-warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'required|email',
        ]);

        $data['no_ktp']        = $request->no_ktp;
        $data['nama']          = $request->nama;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['agama']         = $request->agama;
        $data['pekerjaan']     = $request->pekerjaan;
        $data['telp']          = $request->telp;
        $data['email']         = $request->email;

        Warga::create($data);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
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
        $data['warga'] = Warga::findOrFail($id);
        return view('guest.data-warga.data-warga', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $$warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'required|email',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
