<?php

namespace App\Services;

use App\Models\Admin\PengajuanSuratModel;
use App\Models\Admin\TemplateSuratModel;
use PhpOffice\PhpWord\TemplateProcessor;

class WordTemplateService
{
    public function generate(PengajuanSuratModel $pengajuan)
    {
        $pengajuan->load(['penduduk', 'jenisSurat', 'lampiran.persyaratan']);

        $template = TemplateSuratModel::where('jenis_surat_id', $pengajuan->jenis_surat_id)->firstOrFail();

        $pathTemplate = public_path('template_surat/' . $template->file_template);

        if (!file_exists($pathTemplate)) {
            dd('Template tidak ditemukan', $pathTemplate);
        }

        // dd($pathTemplate);

        $zip = new \ZipArchive();

        $result = $zip->open($pathTemplate);

        // dd($result);

        $processor = new TemplateProcessor($pathTemplate);

        $processor->setValue('nomor_surat', $pengajuan->kode_pengajuan ?? '');

        $processor->setValue('tanggal_surat', $pengajuan->created_at ? $pengajuan->created_at->locale('id')->translatedFormat('d F Y') : '');

        // ==========================
        // DATA PENDUDUK
        // ==========================
        $processor->setValue('nama', $pengajuan->penduduk->nama);
        $processor->setValue('nik', $pengajuan->penduduk->nik);
        $processor->setValue('alamat', $pengajuan->penduduk->alamat);
        $processor->setValue('rt', $pengajuan->penduduk->rt);
        $processor->setValue('rw', $pengajuan->penduduk->rw);
        $processor->setValue('tempat_lahir', $pengajuan->penduduk->tempat_lahir);
        $processor->setValue('tanggal_lahir', $pengajuan->penduduk->tanggal_lahir ? \Carbon\Carbon::parse($pengajuan->penduduk->tanggal_lahir)->locale('id')->translatedFormat('d F Y') : '');

        $jenisKelamin = match ($pengajuan->penduduk->jenis_kelamin) {
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
            default => '',
        };

        $processor->setValue('jenis_kelamin', $jenisKelamin);
        $processor->setValue('agama', $pengajuan->penduduk->agama ?? '');
        $processor->setValue('pekerjaan', $pengajuan->penduduk->pekerjaan ?? '');
        $processor->setValue('keperluan', $pengajuan->keperluan ?? '');
        $processor->setValue('status', $pengajuan->penduduk->status_perkawinan ?? '');

        // ==========================
        // DATA PERSYARATAN
        // ==========================
        foreach ($pengajuan->lampiran as $lampiran) {
            if (!$lampiran->persyaratan) {
                continue;
            }

            $placeholder = $lampiran->persyaratan->placeholder;

            if ($lampiran->persyaratan->tipe_input == 'keterangan') {
                $processor->setValue($placeholder, $lampiran->keterangan ?? '');
            } else {
                $processor->setValue($placeholder, $lampiran->nama_file ?? '');
            }
        }

        foreach ($pengajuan->jenisSurat->persyaratan as $persyaratan) {
            $sudahAda = $pengajuan->lampiran->firstWhere('persyaratan_surat_id', $persyaratan->id);

            if (!$sudahAda) {
                $processor->setValue($persyaratan->placeholder, '');
            }
        }

        // ==========================
        // FOLDER HASIL
        // ==========================
        $folder = public_path('hasil_surat');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // ==========================
        // SIMPAN DOCX
        // ==========================
        $namaDocx = 'Surat-' . $pengajuan->kode_pengajuan . '.docx';

        $pathDocx = $folder . DIRECTORY_SEPARATOR . $namaDocx;

        $processor->saveAs($pathDocx);

        // ==========================
        // KONVERSI DOCX -> PDF
        // ==========================
        $soffice = '"C:\\Program Files\\LibreOffice\\program\\soffice.exe"';

        $command = $soffice . ' --headless --convert-to pdf --outdir "' . $folder . '" "' . $pathDocx . '"';

        exec($command, $output, $result);

        if ($result !== 0) {
            throw new \Exception('Gagal mengubah Word ke PDF.');
        }

        // ==========================
        // HAPUS FILE WORD
        // ==========================
        if (file_exists($pathDocx)) {
            unlink($pathDocx);
        }

        // ==========================
        // RETURN NAMA PDF
        // ==========================
        return 'Surat-' . $pengajuan->kode_pengajuan . '.pdf';
    }
}
