<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\TemplateSuratModel;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    public function index()
    {
        $template = TemplateSuratModel::with('jenisSurat')
            ->latest()
            ->get();
        $jenis = JenisSuratModel::where('is_active', 1)->get();

        return view('admin.master_data.template_surat.template_surat', compact('template', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'judul_surat'    => 'required|max:255',
            'isi_template'   => 'required',
        ]);

        TemplateSuratModel::create([
            'jenis_surat_id' => $request->jenis_surat_id,
            'judul_surat'    => $request->judul_surat,
            'isi_template'   => $request->isi_template,
        ]);

        return redirect()->back()->with('success', 'Template surat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $template = TemplateSuratModel::with('jenisSurat')->findOrFail($id);

        return view('admin.template_surat.show', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = TemplateSuratModel::findOrFail($id);

        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'judul_surat'    => 'required|max:255',
            'isi_template'   => 'required',
        ]);

        $template->update([
            'jenis_surat_id' => $request->jenis_surat_id,
            'judul_surat'    => $request->judul_surat,
            'isi_template'   => $request->isi_template,
        ]);

        return redirect()->back()->with('success', 'Template surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $template = TemplateSuratModel::findOrFail($id);

        $template->delete();

        return redirect()->back()->with('success', 'Template surat berhasil dihapus.');
    }
}
