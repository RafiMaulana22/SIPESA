<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ArsipSuratModel;
use App\Models\Admin\PendudukModel;
use App\Models\Admin\PengajuanSuratModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard', [
            // Statistik Pengajuan
            'menunggu' => PengajuanSuratModel::where('status', 'menunggu')->count(),
            'diproses' => PengajuanSuratModel::where('status', 'diproses')->count(),
            'selesai' => PengajuanSuratModel::where('status', 'selesai')->count(),

            // Total
            'penduduk' => PendudukModel::count(),
            'arsip' => ArsipSuratModel::count(),
            'totalSurat' => PengajuanSuratModel::count(),

            // Data terbaru
            'pengajuanTerbaru' => PengajuanSuratModel::with(['penduduk', 'jenisSurat'])
                ->latest('tanggal_pengajuan')
                ->take(5)
                ->get(),
        ]);
    }
}
