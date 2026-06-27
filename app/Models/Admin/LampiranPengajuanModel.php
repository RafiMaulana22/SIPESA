<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LampiranPengajuanModel extends Model
{
    use HasFactory;

    protected $table = 'lampiran_pengajuans';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pengajuan_surat_id',
        'persyaratan_surat_id',
        'nama_file',
        'file_path',
    ];

    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSuratModel::class, 'pengajuan_surat_id');
    }

    public function persyaratanSurat()
    {
        return $this->belongsTo(PersyaratanSuratModel::class, 'persyaratan_surat_id');
    }
}
