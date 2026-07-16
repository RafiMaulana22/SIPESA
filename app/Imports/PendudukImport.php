<?php

namespace App\Imports;

use App\Models\Admin\PendudukModel as AdminPendudukModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendudukImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AdminPendudukModel([
            'nik' => $row['nik'],
            'no_kk' => $row['no_kk'],
            'nama' => $row['nama'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'agama' => $row['agama'],
            'pekerjaan' => $row['pekerjaan'],
            'no_hp' => $row['no_hp'],
            'alamat' => $row['alamat'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'status_perkawinan' => $row['status_perkawinan'] ?? 'Belum Menikah', // Default value if not provided
        ]);
    }
}
