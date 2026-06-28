<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LampiranPengajuanModel extends Model
{
    use HasFactory;

    protected $table = 'lampiran_pengajuans';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanSuratModel::class);
    }

    public function persyaratan()
    {
        return $this->belongsTo(PersyaratanSuratModel::class);
    }
}
