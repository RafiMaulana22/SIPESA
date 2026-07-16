<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ArsipSuratModel;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\KategoriSuratModel;
use Illuminate\Http\Request;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $arsips = ArsipSuratModel::with(['pengajuan.penduduk', 'pengajuan.jenisSurat.kategoriSurat']);

        if ($request->filled('kategori')) {
            $arsips->whereHas('pengajuan.jenisSurat', function ($q) use ($request) {
                $q->where('kategori_surat_id', $request->kategori);
            });
        }

        if ($request->filled('jenis')) {
            $arsips->whereHas('pengajuan', function ($q) use ($request) {
                $q->where('jenis_surat_id', $request->jenis);
            });
        }

        if ($request->filled('tahun')) {
            $arsips->whereYear('tanggal_surat', $request->tahun);
        }

        $arsips = $arsips->orderByDesc('tanggal_surat')->paginate(10);

        return view('admin.pelayanan.arsip_digital.arsip_digital', [
            'arsips' => $arsips,
            'kategoriSurats' => KategoriSuratModel::all(),
            'jenisSurats' => JenisSuratModel::all(),
            'totalArsip' => ArsipSuratModel::count(),
            'arsipBulan' => ArsipSuratModel::whereMonth('tanggal_surat', now()->month)->count(),
            'arsipHari' => ArsipSuratModel::whereDate('tanggal_surat', today())->count(),
            'totalJenis' => JenisSuratModel::count(),
        ]);
    }
}
