<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanSuratModel extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surats';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
    ];

    public function penduduk()
    {
        return $this->belongsTo(PendudukModel::class, 'penduduk_id');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSuratModel::class, 'jenis_surat_id');
    }

    public function lampiranPengajuans()
    {
        return $this->hasMany(LampiranPengajuanModel::class, 'pengajuan_surat_id');
    }

    public function arsipSurat()
    {
        return $this->hasOne(ArsipSuratModel::class, 'pengajuan_surat_id');
    }
}
