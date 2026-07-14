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
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik',
            'no_kk' => 'required|digits:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'no_hp' => 'nullable|max:20',
            'status_penduduk' => 'required|string|max:50',
            'agama' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
        ]);

        PendudukModel::create($validated);

        return redirect()->back()->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penduduk = PendudukModel::findOrFail($id);

        return response()->json($penduduk);
    }

    public function update(Request $request, $id)
    {
        $penduduk = PendudukModel::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik,' . $id,
            'no_kk' => 'required|digits:16',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'no_hp' => 'nullable|max:20',
            'status_penduduk' => 'required|string|max:50',
            'agama' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
        ]);

        $penduduk->update($validated);

        return redirect()->back()->with('success', 'Data penduduk berhasil diubah.');
    }

    public function destroy($id)
    {
        $penduduk = PendudukModel::findOrFail($id);

        $penduduk->delete();

        return redirect()->back()->with('success', 'Data penduduk berhasil dihapus.');
    }
}
