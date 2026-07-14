<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Admin\BeritaModel;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\PendudukModel;
use App\Models\Admin\PengajuanSuratModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing.home', [
            // Statistik
            'jumlahPenduduk' => PendudukModel::count(),

            'jumlahJenisSurat' => JenisSuratModel::where('is_active', 1)->count(),

            'suratDiproses' => PengajuanSuratModel::whereIn('status', ['diverifikasi', 'diproses'])->count(),

            'suratSelesai' => PengajuanSuratModel::where('status', 'selesai')->count(),

            // Layanan
            'jenisSurats' => JenisSuratModel::with('kategoriSurat')->where('is_active', 1)->orderBy('nama_surat')->get(),

            // Berita
            'beritas' => BeritaModel::latest()->take(3)->get(),
        ]);
    }
}
