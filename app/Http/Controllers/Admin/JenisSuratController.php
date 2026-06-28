<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\KategoriSuratModel;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenis = JenisSuratModel::with('kategoriSurat')
                    ->latest()
                    ->get();

        $kategori = KategoriSuratModel::where('is_active', 1)->get();

        return view('admin.master_data.jenis_surat.jenis_surat', compact('jenis', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_surat_id' => 'required',
            'nama_surat'        => 'required',
            'deskripsi'         => 'nullable',
            'is_active'         => 'required',
        ]);

        $last = JenisSuratModel::latest()->first();

        if ($last) {
            $number = (int) substr($last->kode_surat, 3) + 1;
        } else {
            $number = 1;
        }

        $kode = 'JNS' . str_pad($number, 3, '0', STR_PAD_LEFT);

        JenisSuratModel::create([
            'kategori_surat_id' => $request->kategori_surat_id,
            'kode_surat'        => $kode,
            'nama_surat'        => $request->nama_surat,
            'deskripsi'         => $request->deskripsi,
            'is_active'         => $request->is_active,
        ]);

        return redirect()->back()->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jenis = JenisSuratModel::with('kategoriSurat')->findOrFail($id);

        return view('admin.jenis_surat.show', compact('jenis'));
    }

    public function update(Request $request, $id)
    {
        $jenis = JenisSuratModel::findOrFail($id);

        $request->validate([
            'kategori_surat_id' => 'required',
            'nama_surat'        => 'required',
            'deskripsi'         => 'nullable',
            'is_active'         => 'required',
        ]);

        $jenis->update([
            'kategori_surat_id' => $request->kategori_surat_id,
            'nama_surat'        => $request->nama_surat,
            'deskripsi'         => $request->deskripsi,
            'is_active'         => $request->is_active,
        ]);

        return redirect()->back()->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenis = JenisSuratModel::findOrFail($id);

        $jenis->delete();

        return redirect()->back()->with('success', 'Jenis surat berhasil dihapus.');
    }
}
