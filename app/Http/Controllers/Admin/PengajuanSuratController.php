<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\PengajuanSuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanSuratModel::with(['penduduk', 'jenisSurat']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat_id', $request->jenis_surat);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pengajuan', $request->tanggal);
        }

        $pengajuans = $query->orderBy('nomor_antrian')->paginate(10);

        return view('admin.pelayanan.pengajuan_surat.pengajuan_surat', [
            'pengajuans' => $pengajuans,
            'jenisSurats' => JenisSuratModel::orderBy('nama_surat')->get(),

            'totalPengajuan' => PengajuanSuratModel::count(),
            'menunggu' => PengajuanSuratModel::where('status', 'menunggu')->count(),
            'diproses' => PengajuanSuratModel::where('status', 'diproses')->count(),
            'selesai' => PengajuanSuratModel::where('status', 'selesai')->count(),
        ]);
    }

    public function proses($id)
    {
        $pengajuan = PengajuanSuratModel::where('id', $id)->first();
        $pengajuan->load(['penduduk', 'jenisSurat.kategoriSurat', 'lampiran.persyaratan', 'logs.user']);

        return view('admin.pelayanan.pengajuan_surat.proses', compact('pengajuan'));
    }

    public function setujui(Request $request, $id)
    {
        $pengajuan = PengajuanSuratModel::where('id', $id)->first();

        $antrianPertama = PengajuanSuratModel::where('status', 'menunggu')->orderBy('nomor_antrian')->first();

        if (!$antrianPertama || $antrianPertama->id != $pengajuan->id) {
            return back()->with('error', 'Pengajuan ini belum dapat diproses karena bukan antrean FIFO pertama.');
        }

        DB::transaction(function () use ($pengajuan, $request) {
            $pengajuan->update([
                'status' => 'diproses',
                'catatan_admin' => $request->catatan_admin,
            ]);

            // LogPengajuan::create([
            //     'pengajuan_surat_id' => $pengajuan->id,
            //     'user_id' => auth()->id(),
            //     'aktivitas' => 'Pengajuan disetujui operator',
            // ]);
        });

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan berhasil diproses.');
    }

    public function tolak(Request $request, $id)
    {
        $pengajuan = PengajuanSuratModel::where('id', $id)->first();

        $request->validate([
            'catatan_admin' => 'required',
        ]);

        $pengajuan->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        // LogPengajuan::create([
        //     'pengajuan_surat_id' => $pengajuan->id,
        //     'user_id' => auth()->id(),
        //     'aktivitas' => 'Pengajuan ditolak',
        // ]);

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan berhasil ditolak.');
    }
}
