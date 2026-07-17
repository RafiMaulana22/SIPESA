<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSuratModel;
use App\Models\Admin\KategoriSuratModel;
use App\Models\Admin\LampiranPengajuanModel;
use App\Models\Admin\PendudukModel;
use App\Models\Admin\PengajuanSuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengajuanSuratController extends Controller
{
    public function validasiNik(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits:16',
        ]);

        $penduduk = PendudukModel::where('nik', $request->nik)->first();

        if (!$penduduk) {
            return response()->json([
                'status' => false,
                'message' => 'NIK tidak ditemukan.',
            ]);
        }

        return response()->json([
            'status' => true,
            'redirect' => route('landing.form', $penduduk->nik),
        ]);
    }

    public function formPengajuan(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required|exists:penduduks,id',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'keperluan' => 'required',

            'nama_usaha' => 'nullable|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
        ]);

        $jenis = JenisSuratModel::with('persyaratan')->findOrFail($request->jenis_surat_id);

        foreach ($jenis->persyaratan as $item) {
            $rule = $item->is_required ? 'required' : 'nullable';

            if ($item->tipe_input == 'file') {
                $request->validate([
                    'lampiran.' . $item->id => $rule . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
                ]);
            } else {
                $request->validate([
                    'keterangan.' . $item->id => $rule . '|string|max:1000',
                ]);
            }
        }

        // Generate kode pengajuan
        $kodePengajuan = 'PGJ-' . now()->format('YmdHis') . rand(100, 999);

        // Nomor antrian hari ini
        $nomorAntrian = PengajuanSuratModel::whereDate('tanggal_pengajuan', today())->count() + 1;
        DB::beginTransaction();

        try {
            $pengajuan = PengajuanSuratModel::create([
                'kode_pengajuan' => $kodePengajuan,
                'penduduk_id' => $request->penduduk_id,
                'jenis_surat_id' => $request->jenis_surat_id,
                'nomor_antrian' => $nomorAntrian,
                'tanggal_pengajuan' => now(),
                'keperluan' => $request->keperluan,
                'nama_usaha' => $request->nama_usaha,
                'jenis_usaha' => $request->jenis_usaha,
                'status' => 'menunggu',
            ]);

            foreach ($jenis->persyaratan as $item) {
                //==============================
                // FILE
                //==============================
                if ($item->tipe_input == 'file') {
                    if ($request->hasFile("lampiran.$item->id")) {
                        $file = $request->file("lampiran.$item->id");

                        $path = $file->store('lampiran', 'public');

                        LampiranPengajuanModel::create([
                            'pengajuan_surat_id' => $pengajuan->id,
                            'persyaratan_surat_id' => $item->id,
                            'nama_file' => $file->getClientOriginalName(),
                            'file_path' => $path,
                            'keterangan' => null,
                            'status' => 'menunggu',
                        ]);
                    }
                }

                //==============================
                // KETERANGAN
                //==============================
                else {
                    LampiranPengajuanModel::create([
                        'pengajuan_surat_id' => $pengajuan->id,
                        'persyaratan_surat_id' => $item->id,
                        'nama_file' => null,
                        'file_path' => null,
                        'keterangan' => $request->keterangan[$item->id] ?? null,
                        'status' => 'menunggu',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Pengajuan berhasil',
                'kode_pengajuan' => $pengajuan->kode_pengajuan,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e);

            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
        ]);

        $pengajuan = PengajuanSuratModel::with(['penduduk', 'jenisSurat'])
            ->where('kode_pengajuan', $request->keyword)
            ->orWhereHas('penduduk', function ($q) use ($request) {
                $q->where('nik', $request->keyword);
            })
            ->latest()
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.',
            ]);
        }

        return response()->json([
            'status' => true,
            'pengajuan' => [
                'kode' => $pengajuan->kode_pengajuan,
                'nama' => $pengajuan->penduduk->nama,
                'nik' => $pengajuan->penduduk->nik,
                'jenis_surat' => $pengajuan->jenisSurat->nama_surat,
                'status' => $pengajuan->status,
                'tanggal' => $pengajuan->tanggal_pengajuan->format('d M Y H:i'),
                'catatan' => $pengajuan->catatan_admin,
            ],
        ]);
    }

    public function getPersyaratan($id)
    {
        $jenisSurat = JenisSuratModel::with('persyaratan')->findOrFail($id);

        return response()->json([
            'status' => true,

            'jenis_surat' => [
                'id' => $jenisSurat->id,
                'nama_surat' => $jenisSurat->nama_surat,
            ],

            'persyaratan' => $jenisSurat->persyaratan->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_persyaratan' => $item->nama_persyaratan,
                    'is_required' => $item->is_required,
                    'tipe_input' => $item->tipe_input,
                ];
            }),
        ]);
    }

    public function form($nik)
    {
        $penduduk = PendudukModel::where('nik', $nik)->firstOrFail();

        $kategori = KategoriSuratModel::orderBy('nama_kategori')->get();

        return view('landing.pengajuan.form', compact('penduduk', 'kategori'));
    }

    public function getJenisSurat($kategori)
    {
        $jenis = JenisSuratModel::where('kategori_surat_id', $kategori)
            ->where('is_active', 1)
            ->orderBy('nama_surat')
            ->get(['id', 'nama_surat']);

        return response()->json([
            'status' => true,
            'jenis' => $jenis,
        ]);
    }
}
