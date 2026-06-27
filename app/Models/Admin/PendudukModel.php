<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendudukModel extends Model
{
    use HasFactory;

    protected $table = 'penduduks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'no_hp',
        'status_penduduk',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
