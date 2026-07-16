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
            $request->validate(
                [
                    'nama_persyaratan' => 'required',
                    'is_required' => 'required|boolean',
                    'tipe_input' => 'required|in:file,keterangan',
                ],
                [
                    'nama_persyaratan.required' => 'Nama persyaratan wajib diisi.',
                    'is_required.required' => 'Status wajib dipilih.',
                    'is_required.boolean' => 'Status harus berupa nilai boolean (0 atau 1).',
                    'tipe_input.required' => 'Jenis input wajib dipilih.',
                    'tipe_input.in' => 'Jenis input harus berupa "file" atau "keterangan".',
                ],
            );

            $placeholder = $this->generatePlaceholder($request->nama_persyaratan);

            if (PersyaratanSuratModel::where('placeholder', $placeholder)->exists()) {
                return back()->with('error', 'Placeholder otomatis "' . $placeholder . '" sudah digunakan.');
            }

            $jenisSurat = JenisSuratModel::findOrFail($id);

            $jenisSurat->persyaratan()->create([
                'nama_persyaratan' => $request->nama_persyaratan,
                'placeholder' => $this->generatePlaceholder($request->nama_persyaratan),
                'is_required' => $request->is_required,
                'tipe_input' => $request->tipe_input,
            ]);

            return redirect()->route('persyaratan-surat.index', $jenisSurat->id)->with('success', 'Persyaratan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->route('persyaratan-surat.index', $id)
                ->with('error', 'Terjadi kesalahan saat menambahkan persyaratan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'nama_persyaratan' => 'required',
                    'is_required' => 'required|boolean',
                    'tipe_input' => 'required|in:file,keterangan',
                ],
                [
                    'nama_persyaratan.required' => 'Nama persyaratan wajib diisi.',
                    'is_required.required' => 'Status wajib dipilih.',
                    'is_required.boolean' => 'Status harus berupa nilai boolean (0 atau 1).',
                    'tipe_input.required' => 'Jenis input wajib dipilih.',
                    'tipe_input.in' => 'Jenis input harus berupa "file" atau "keterangan".',
                ],
            );

            $placeholder = $this->generatePlaceholder($request->nama_persyaratan);

            if (PersyaratanSuratModel::where('placeholder', $placeholder)->where('id', '!=', $id)->exists()) {
                return back()->with('error', 'Placeholder otomatis "' . $placeholder . '" sudah digunakan.');
            }

            $persyaratan = PersyaratanSuratModel::findOrFail($id);

            $persyaratan->update([
                'nama_persyaratan' => $request->nama_persyaratan,
                'placeholder' => $this->generatePlaceholder($request->nama_persyaratan),
                'is_required' => $request->is_required,
                'tipe_input' => $request->tipe_input,
            ]);

            return redirect()->route('persyaratan-surat.index', $persyaratan->jenis_surat_id)->with('success', 'Persyaratan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->route('persyaratan-surat.index', $id)
                ->with('error', 'Terjadi kesalahan saat memperbarui persyaratan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $persyaratan = PersyaratanSuratModel::findOrFail($id);
            $persyaratan->delete();

            return redirect()->route('persyaratan-surat.index', $persyaratan->jenis_surat_id)->with('success', 'Persyaratan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('persyaratan-surat.index', $id)
                ->with('error', 'Terjadi kesalahan saat menghapus persyaratan: ' . $e->getMessage());
        }
    }

    private function generatePlaceholder($nama)
    {
        $placeholder = strtolower($nama);

        $placeholder = str_replace([' ', '/', '\\', '-', '.', ',', '(', ')'], '_', $placeholder);

        $placeholder = preg_replace('/[^a-z0-9_]/', '', $placeholder);

        $placeholder = preg_replace('/_+/', '_', $placeholder);

        return trim($placeholder, '_');
    }
}
