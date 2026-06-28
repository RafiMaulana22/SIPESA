<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendudukModel extends Model
{
    use HasFactory;

    protected $table = 'penduduks';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSuratModel::class);
    }
}
