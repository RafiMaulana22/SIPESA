<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSuratModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_surats';

    protected $primaryKey = 'id';

    protected $fillable = ['kategori_surat_id', 'kode_surat', 'nama_surat', 'deskripsi', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function kategoriSurat()
    {
        return $this->belongsTo(KategoriSuratModel::class, 'kategori_surat_id');
    }
}
