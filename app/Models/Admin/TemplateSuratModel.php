<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemplateSuratModel extends Model
{
     use HasFactory;

    protected $table = 'template_surats';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSuratModel::class, 'jenis_surat_id');
    }
}
