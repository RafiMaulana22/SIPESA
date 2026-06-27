<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PendudukModel;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduk = PendudukModel::latest()->get();
        return view('admin.master_data.penduduk.penduduk', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'             => 'required|digits:16|unique:penduduks,nik',
            'no_kk'           => 'required|digits:16',
            'nama'            => 'required',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required',
            'alamat'          => 'required',
            'rt'              => 'required',
            'rw'              => 'required',
            'no_hp'           => 'nullable',
            'status_penduduk' => 'nullable'
        ]);

        PendudukModel::create($request->all());
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penduduk = PendudukModel::findOrFail($id);
        return response()->json($penduduk);
    }

    public function update(Request $request, $id)
    {
        $penduduk = PendudukModel::findOrFail($id);
        $request->validate([
            'nik'             => 'required|digits:16|unique:penduduks,nik,' . $id,
            'no_kk'           => 'required|digits:16',
            'nama'            => 'required',
            'tempat_lahir'    => 'required',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required',
            'alamat'          => 'required',
            'rt'              => 'required',
            'rw'              => 'required',
            'no_hp'           => 'nullable',
            'status_penduduk' => 'nullable'
        ]);

        $penduduk->update($request->all());
        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        PendudukModel::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
