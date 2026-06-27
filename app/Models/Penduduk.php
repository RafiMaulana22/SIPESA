<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'nik_hash',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt_rw',
        'agama',
        'pekerjaan',
        'status_kawin',
    ];

    protected $hidden = [
        'nik_hash',
    ];

    protected function casts(): array
    {
        return [
            'nik' => 'encrypted',
            'tanggal_lahir' => 'date',
        ];
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanSurat::class);
    }
}
