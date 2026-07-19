<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PendudukImport;
use App\Models\Admin\PendudukModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduk = PendudukModel::latest()->get();

        return view('admin.master_data.penduduk.penduduk', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:penduduks,nik',
            'no_kk' => 'required',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'no_hp' => 'nullable|max:20',
            'status_perkawinan' => 'required|string|max:50',
            'agama' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'no_kk.required' => 'No KK wajib diisi.',
            'no_kk.digits' => 'No KK harus terdiri dari 16 digit.',
            'nama.required' => 'Nama wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
        ]);

        PendudukModel::create($validated);

        return redirect()->back()->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penduduk = PendudukModel::findOrFail($id);

        return response()->json($penduduk);
    }

    public function update(Request $request, $id)
    {
        $penduduk = PendudukModel::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|unique:penduduks,nik,' . $id,
            'no_kk' => 'required',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'no_hp' => 'nullable|max:20',
            'status_perkawinan' => 'required|string|max:50',
            'agama' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'no_kk.required' => 'No KK wajib diisi.',
            'no_kk.digits' => 'No KK harus terdiri dari 16 digit.',
            'nama.required' => 'Nama wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'alamat.required' => 'Alamat wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'rw.required' => 'RW wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
        ]);

        $penduduk->update($validated);

        return redirect()->back()->with('success', 'Data penduduk berhasil diubah.');
    }

    public function destroy($id)
    {
        $penduduk = PendudukModel::findOrFail($id);

        $penduduk->delete();

        return redirect()->back()->with('success', 'Data penduduk berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        // Import the data using the PendudukImport class
        Excel::import(new PendudukImport, $file);

        return redirect()->back()->with('success', 'Data penduduk berhasil diimpor.');
    }
}
