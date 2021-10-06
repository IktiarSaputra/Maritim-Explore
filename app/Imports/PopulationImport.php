<?php

namespace App\Imports;

use App\Models\Population;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PopulationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Population([
            'satuan_kerja' => $row[0],
            'nama_wilayah' => $row[1],
            'jumlah_penduduk' => $row[2],
            'pria' => $row[3],
            'wanita' => $row[4],
            '0_18' => $row[5],
            '18_40' => $row[6],
            '40_45' => $row[7],
            '55' => $row[8],
            'tahun' => $row[9],

        ]);
    }
}
