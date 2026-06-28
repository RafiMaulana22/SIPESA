<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSuratModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_surats';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSuratModel::class);
    }

    public function template()
    {
        return $this->hasOne(TemplateSuratModel::class);
    }

    public function persyaratan()
    {
        return $this->hasMany(PersyaratanSuratModel::class);
    }

    public function kategoriSurat()
    {
        return $this->belongsTo(KategoriSuratModel::class, 'kategori_surat_id');
    }
}
