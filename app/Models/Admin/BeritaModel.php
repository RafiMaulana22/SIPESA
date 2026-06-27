<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeritaModel extends Model
{
     use HasFactory;

    protected $table = 'beritas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
