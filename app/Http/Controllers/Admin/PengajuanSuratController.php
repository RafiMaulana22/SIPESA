<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $pengajuan = PengajuanSuratModel::with(['penduduk', 'jenisSurat.kategoriSurat', 'lampiran.persyaratan'])->findOrFail($id);

        return view('admin.pelayanan.pengajuan_surat.proses', compact('pengajuan'));
    }

    public function mulaiProses($id)
    {
        $pengajuan = PengajuanSuratModel::with('lampiran')->findOrFail($id);

        // Sudah diproses sebelumnya
        if ($pengajuan->status != 'menunggu') {
            return redirect()->route('pengajuan-surat.proses', $pengajuan->id)->with('info', 'Pengajuan sudah diproses.');
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

    public function setujui(Request $request, $id, WordTemplateService $wordService)
    {
        DB::transaction(function () use ($request, $id, $wordService) {
            $pengajuan = PengajuanSuratModel::with(['penduduk', 'jenisSurat'])->findOrFail($id);

            // Generate surat
            $namaFile = $wordService->generate($pengajuan);

            // Update pengajuan
            $pengajuan->update([
                'status' => 'selesai',
                'catatan_admin' => $request->catatan_admin,
                'file_surat' => $namaFile,
            ]);

            // Simpan ke arsip digital
            ArsipSuratModel::create([
                'pengajuan_surat_id' => $pengajuan->id,
                'nomor_surat' => $pengajuan->kode_pengajuan,
                'tanggal_surat' => now(),
                'file_pdf' => 'hasil_surat/' . $namaFile,
                'created_by' => auth()->id(),
            ]);
        });

        return redirect()->route('pengajuan-surat.index')->with('success', 'Surat berhasil dibuat.');
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
        $pengajuan = PengajuanSuratModel::with(['penduduk', 'jenisSurat.kategoriSurat', 'lampiran.persyaratan'])->findOrFail($id);

        return view('admin.pelayanan.pengajuan_surat.detail', compact('pengajuan'));
    }

    public function cetak($id)
    {
        $pengajuan = PengajuanSuratModel::with(['penduduk', 'jenisSurat'])->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pelayanan.pengajuan_surat.pdf', compact('pengajuan'));

        return $pdf->stream('Surat-' . $pengajuan->kode_pengajuan . '.pdf');
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

        // dd(file_exists(public_path('hasil_surat/' . $pengajuan->file_surat)));

        if (!file_exists($file)) {
            dd($file); // sementara untuk debug
        }

        return response()->file($file);
    }
}
