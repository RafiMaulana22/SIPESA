<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSuratModel extends Model
{
    use HasFactory;

    protected $table = 'arsip_surats';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanSuratModel::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }
}
