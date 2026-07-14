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
        $template = TemplateSuratModel::with('jenisSurat')->latest()->get();
        $jenis = JenisSuratModel::where('is_active', 1)->get();

        return view('admin.master_data.template_surat.template_surat', compact('template', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'jenis_surat_id' => 'required|exists:jenis_surats,id',
                'judul_surat' => 'required|max:255',
                'file_template' => 'required|mimes:doc,docx|max:5120',
            ],
            [
                'file_template.required' => 'File template harus diunggah.',
                'file_template.mimes' => 'File template harus berupa file DOC atau DOCX.',
                'file_template.max' => 'Ukuran file template tidak boleh lebih dari 5MB.',
            ],
        );

        $namaFile = null;

        if ($request->hasFile('file_template')) {
            $file = $request->file('file_template');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('template_surat'), $namaFile);
        }

        TemplateSuratModel::create([
            'jenis_surat_id' => $request->jenis_surat_id,
            'judul_surat' => $request->judul_surat,
            'file_template' => $namaFile,
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

        $request->validate(
            [
                'jenis_surat_id' => 'required|exists:jenis_surats,id',
                'judul_surat' => 'required|max:255',
                'file_template' => 'nullable|mimes:doc,docx|max:5120',
            ],
            [
                'file_template.mimes' => 'File template harus berupa file DOC atau DOCX.',
                'file_template.max' => 'Ukuran file template tidak boleh lebih dari 5MB.',
            ],
        );

        $namaFile = $template->file_template;

        if ($request->hasFile('file_template')) {
            if ($template->file_template && file_exists(public_path('template_surat/' . $template->file_template))) {
                unlink(public_path('template_surat/' . $template->file_template));
            }

            $file = $request->file('file_template');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('template_surat'), $namaFile);
        }

        $template->update([
            'jenis_surat_id' => $request->jenis_surat_id,
            'judul_surat' => $request->judul_surat,
            'file_template' => $namaFile,
        ]);

        return redirect()->back()->with('success', 'Template surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $template = TemplateSuratModel::findOrFail($id);

        if ($template->file_template && file_exists(public_path('template_surat/' . $template->file_template))) {
            unlink(public_path('template_surat/' . $template->file_template));
        }

        $template->delete();

        return redirect()->back()->with('success', 'Template surat berhasil dihapus.');
    }
}
