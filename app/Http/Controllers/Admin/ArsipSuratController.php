<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArsipSuratController extends Controller
{
    public function index()
    {
        return view('admin.pelayanan.arsip_digital.arsip_digital');
    }
}
