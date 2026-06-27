<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSuratModel extends Model
{
    use HasFactory;

    protected $table = 'arsip_surats';

    protected $primaryKey = 'id';

    protected $fillable = ['pengajuan_surat_id', 'nomor_surat', 'tanggal_surat', 'file_pdf', 'created_by'];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSuratModel::class, 'pengajuan_surat_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }
}
