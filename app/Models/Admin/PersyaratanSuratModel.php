<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersyaratanSuratModel extends Model
{
    use HasFactory;

    protected $table = 'persyaratan_surats';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSuratModel::class, 'jenis_surat_id');
    }

    public function lampiranPengajuans()
    {
        return $this->hasMany(LampiranPengajuanModel::class, 'persyaratan_surat_id');
    }
}
