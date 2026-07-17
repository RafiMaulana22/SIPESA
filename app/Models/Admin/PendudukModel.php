<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;

class PendudukModel extends Model
{
    use HasFactory;

    protected $table = 'penduduks';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function setNikAttribute($value)
    {
        $this->attributes['nik'] = Crypt::encryptString($value);
    }

    public function getNikAttribute($value)
    {
        if (!$value) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function setNoKkAttribute($value)
    {
        $this->attributes['no_kk'] = Crypt::encryptString($value);
    }

    public function getNoKkAttribute($value)
    {
        if (!$value) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function setNoHpAttribute($value)
    {
        if ($value) {
            $this->attributes['no_hp'] = Crypt::encryptString($value);
        }
    }

    public function getNoHpAttribute($value)
    {
        if (!$value) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSuratModel::class);
    }
}
