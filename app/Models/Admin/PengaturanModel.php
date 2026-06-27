<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengaturanModel extends Model
{
     use HasFactory;

    protected $table = 'pengaturans';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_desa',
        'alamat',
        'telepon',
        'email',
        'logo',
        'nama_kepala_desa',
        'jabatan_kepala_desa',
        'gambar_ttd',
        'stempel_desa',
    ];
}
