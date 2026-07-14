<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\PersyaratanSuratModel;
use Illuminate\Http\Request;

class PersyaratanSuratController extends Controller
{
    public function index($id)
    {
        $jenisSurat = JenisSuratModel::with('persyaratan')->findOrFail($id);

        return view('admin.master_data.persyaratan_surat.persyaratan_surat', compact('jenisSurat'));
    }

    public function store(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_persyaratan' => 'required',
                'is_required' => 'required|boolean',
            ]);

            $jenisSurat = JenisSuratModel::findOrFail($id);

            $jenisSurat->persyaratan()->create([
                'nama_persyaratan' => $request->nama_persyaratan,
                'is_required' => $request->is_required,
            ]);

            return redirect()->back()->with('success', 'Persyaratan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan persyaratan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_persyaratan' => 'required',
                'is_required' => 'required|boolean',
            ]);

            $persyaratan = PersyaratanSuratModel::findOrFail($id);

            $persyaratan->update([
                'nama_persyaratan' => $request->nama_persyaratan,
                'is_required' => $request->is_required,
            ]);

            return redirect()->back()->with('success', 'Persyaratan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui persyaratan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $persyaratan = PersyaratanSuratModel::findOrFail($id);
            $persyaratan->delete();

            return redirect()->back()->with('success', 'Persyaratan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus persyaratan: ' . $e->getMessage());
        }
    }
}
