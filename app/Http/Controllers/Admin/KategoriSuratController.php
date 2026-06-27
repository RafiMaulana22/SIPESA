<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\KategoriSuratModel;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    public function index()
    {
        $kategori = KategoriSuratModel::latest()->get();
        return view('admin.master_data.kategori_surat.kategori_surat', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
            'is_active' => 'required',
        ]);

        $last = KategoriSuratModel::latest()->first();

        if ($last) {
            $number = (int) substr($last->kode_kategori, 3) + 1;
        } else {
            $number = 1;
        }

        $kode = 'KTS' . str_pad($number, 3, '0', STR_PAD_LEFT);

        KategoriSuratModel::create([
            'kode_kategori' => $kode,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ]);
        
        return redirect()->back()->with('success', 'Kategori surat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = KategoriSuratModel::findOrFail($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriSuratModel::findOrFail($id);

        $request->validate([
            'kode_kategori' => 'required|unique:kategori_surats,kode_kategori,' . $id,
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
            'is_active' => 'required',
        ]);

        $kategori->update([
            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active,
        ]);

        return redirect()->back()->with('success', 'Kategori surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriSuratModel::findOrFail($id);
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori surat berhasil dihapus.');
    }
}
