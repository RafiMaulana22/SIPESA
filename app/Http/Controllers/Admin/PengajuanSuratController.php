<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ArsipSuratModel;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\LampiranPengajuanModel;
use App\Models\Admin\PengajuanSuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\WordTemplateService;

class PengajuanSuratController extends Controller
{
    protected $wordService;

    public function __construct(WordTemplateService $wordService)
    {
        $this->wordService = $wordService;
    }

    public function index(Request $request)
    {
        $query = PengajuanSuratModel::with(['penduduk', 'jenisSurat'])->whereIn('status', ['menunggu', 'diproses']); // hanya antrean aktif

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

        // Cek apakah masih ada surat yang sedang diproses
        $sedangDiproses = PengajuanSuratModel::where('status', 'diproses')->exists();

        // Nomor FIFO hanya muncul jika TIDAK ADA yang sedang diproses
        $nomorFifo = null;

        if (!$sedangDiproses) {
            $nomorFifo = PengajuanSuratModel::where('status', 'menunggu')->min('nomor_antrian');
        }

        return view('admin.pelayanan.pengajuan_surat.pengajuan_surat', [
            'pengajuans' => $pengajuans,
            'jenisSurats' => JenisSuratModel::orderBy('nama_surat')->get(),

            'nomorFifo' => $nomorFifo,
            'sedangDiproses' => $sedangDiproses,

            'totalPengajuan' => PengajuanSuratModel::count(),
            'menunggu' => PengajuanSuratModel::where('status', 'menunggu')->count(),
            'diproses' => PengajuanSuratModel::where('status', 'diproses')->count(),
            'selesai' => PengajuanSuratModel::where('status', 'selesai')->count(),
        ]);
    }

    public function proses($id)
    {
        $pengajuan = PengajuanSuratModel::with([
            'penduduk',
            'jenisSurat.kategoriSurat',
            'lampiran' => function ($q) {
                $q->whereHas('persyaratan', function ($q2) {
                    $q2->where('tipe_input', 'file');
                })->with('persyaratan');
            },
        ])->findOrFail($id);

        return view('admin.pelayanan.pengajuan_surat.proses', compact('pengajuan'));
    }

    public function mulaiProses($id)
    {
        $pengajuan = PengajuanSuratModel::with('lampiran')->findOrFail($id);

        // Sudah diproses sebelumnya
        if ($pengajuan->status != 'menunggu') {
            return redirect()->route('pengajuan-surat.proses', $pengajuan->id)->with('info', 'Pengajuan sudah diproses.');
        }

        // Tidak boleh ada lebih dari satu surat yang diproses
        $adaDiproses = PengajuanSuratModel::where('status', 'diproses')->exists();

        if ($adaDiproses) {
            return back()->with('error', 'Masih ada pengajuan yang sedang diproses. Selesaikan atau tolak terlebih dahulu.');
        }

        // Cek FIFO
        $antrianPertama = PengajuanSuratModel::where('status', 'menunggu')->orderBy('nomor_antrian')->first();

        if (!$antrianPertama || $antrianPertama->id != $pengajuan->id) {
            return back()->with('error', 'Pengajuan ini belum mendapat giliran sesuai metode FIFO.');
        }

        // Ubah status menjadi diproses
        $pengajuan->update([
            'status' => 'diproses',
        ]);

        return redirect()->route('pengajuan-surat.proses', $pengajuan->id)->with('success', 'Pengajuan berhasil masuk ke proses.');
    }

    public function setujui(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $pengajuan = PengajuanSuratModel::with(['penduduk', 'jenisSurat', 'lampiran.persyaratan'])->findOrFail($id);

            // generate PDF
            $namaFile = $this->wordService->generate($pengajuan);

            $pengajuan->update([
                'status' => 'selesai',
                'catatan_admin' => $request->catatan_admin,
                'file_surat' => $namaFile,
            ]);

            ArsipSuratModel::create([
                'pengajuan_surat_id' => $pengajuan->id,
                'nomor_surat' => $pengajuan->kode_pengajuan,
                'tanggal_surat' => now(),
                'file_pdf' => 'hasil_surat/' . $namaFile,
                'created_by' => auth()->id(),
            ]);
        });

        return redirect()->route('pengajuan-surat.index')->with('success', 'Surat berhasil dibuat dalam format PDF.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required',
        ]);

        $pengajuan = PengajuanSuratModel::findOrFail($id);

        DB::transaction(function () use ($pengajuan, $request) {
            $pengajuan->update([
                'status' => 'ditolak',
                'catatan_admin' => $request->catatan_admin,
            ]);
        });

        return redirect()->route('pengajuan-surat.index')->with('success', 'Pengajuan berhasil ditolak.');
    }

    public function validLampiran(Request $request, $id)
    {
        $lampiran = LampiranPengajuanModel::findOrFail($id);

        $lampiran->update([
            'status' => 'valid',
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Lampiran berhasil divalidasi.');
    }

    public function tolakLampiran(Request $request, $id)
    {
        $lampiran = LampiranPengajuanModel::findOrFail($id);

        $request->validate([
            'catatan' => 'required',
        ]);

        $lampiran->update([
            'status' => 'ditolak',
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Lampiran berhasil ditolak.');
    }

    public function detail($id)
    {
        $pengajuan = PengajuanSuratModel::with([
            'penduduk',
            'jenisSurat.kategoriSurat',
            'lampiran' => function ($q) {
                $q->whereHas('persyaratan', function ($q2) {
                    $q2->where('tipe_input', 'file');
                })->with('persyaratan');
            },
        ])->findOrFail($id);

        return view('admin.pelayanan.pengajuan_surat.detail', compact('pengajuan'));
    }

    public function download($id)
    {
        $pengajuan = PengajuanSuratModel::findOrFail($id);

        if (!$pengajuan->file_surat) {
            abort(404, 'Surat belum dibuat.');
        }

        $file = public_path('hasil_surat/' . $pengajuan->file_surat);

        if (!file_exists($file)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($file);
    }

    public function preview($id)
    {
        $pengajuan = PengajuanSuratModel::findOrFail($id);

        if (!$pengajuan->file_surat) {
            abort(404, 'Surat belum dibuat.');
        }

        $file = public_path('hasil_surat/' . $pengajuan->file_surat);

        if (!file_exists($file)) {
            abort(404, 'File PDF tidak ditemukan.');
        }

        return response()->file($file);
    }
}
