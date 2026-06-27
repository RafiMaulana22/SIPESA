<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = [
        'kategori_surat_id',
        'nama_surat',
        'keterangan',
        'template_surat',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'kategori_surat_id');
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanSurat::class);
    }
}
