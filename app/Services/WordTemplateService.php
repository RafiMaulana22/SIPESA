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

        $processor = new TemplateProcessor($pathTemplate);

        $processor->setValue('nama', $pengajuan->penduduk->nama);
        $processor->setValue('nik', $pengajuan->penduduk->nik);
        $processor->setValue('alamat', $pengajuan->penduduk->alamat);
        $processor->setValue('rt', $pengajuan->penduduk->rt);
        $processor->setValue('rw', $pengajuan->penduduk->rw);
        $processor->setValue('tempat_lahir', $pengajuan->penduduk->tempat_lahir);
        $processor->setValue('tanggal_lahir', date('d-m-Y', strtotime($pengajuan->penduduk->tanggal_lahir)));

        $processor->setValue('jenis_kelamin', $pengajuan->penduduk->jenis_kelamin ?? '');
        $processor->setValue('agama', $pengajuan->penduduk->agama ?? '');
        $processor->setValue('pekerjaan', $pengajuan->penduduk->pekerjaan ?? '');

        $processor->setValue('keperluan', $pengajuan->keperluan ?? '');

        foreach ($pengajuan->lampiran as $lampiran) {
            if (!$lampiran->persyaratan) {
                continue;
            }

            $placeholder = $lampiran->persyaratan->placeholder;

            if ($lampiran->persyaratan->tipe_input == 'keterangan') {
                $processor->setValue($placeholder, $lampiran->keterangan ?? '');
            } else {
                /*
                 * Untuk tipe file sementara dikosongkan.
                 * Nanti jika ingin menampilkan nama file atau gambar
                 * bisa ditambahkan di sini.
                 */

                $processor->setValue($placeholder, $lampiran->nama_file ?? '');
            }
        }

        foreach ($pengajuan->jenisSurat->persyaratan as $persyaratan) {
            $sudahAda = $pengajuan->lampiran->firstWhere('persyaratan_surat_id', $persyaratan->id);

            if (!$sudahAda) {
                $processor->setValue($persyaratan->placeholder, '');
            }
        }

        $namaFile = 'Surat-' . $pengajuan->kode_pengajuan . '.docx';

        $folder = public_path('hasil_surat');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        $processor->saveAs($folder . DIRECTORY_SEPARATOR . $namaFile);

        return $namaFile;
    }
}
