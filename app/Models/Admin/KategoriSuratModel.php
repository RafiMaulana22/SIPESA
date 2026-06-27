<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSuratModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_surats';

    protected $primaryKey = 'id';

    protected $fillable = ['kode_kategori', 'nama_kategori', 'deskripsi', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jenisSurats()
    {
        return $this->hasMany(JenisSuratModel::class, 'kategori_surat_id');
    }
}
