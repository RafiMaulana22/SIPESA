<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    protected $table = 'kategori_surat';

    protected $fillable = [
        'nama_kategori',
        'timeout_menit',
        'keterangan',
    ];

    public function jenisSurat()
    {
        return $this->hasMany(JenisSurat::class);
    }
}
