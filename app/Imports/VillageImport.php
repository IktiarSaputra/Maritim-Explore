<?php

namespace App\Imports;

use App\Models\Village;
use Maatwebsite\Excel\Concerns\ToModel;

class VillageImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Village([
            'satuan_kerja' => $row[0],
            'provinsi' => $row[1],
            'kabupaten' => $row[2],
            'kecamatan' => $row[3],
            'kelurahan' => $row[4],
            'nama_desa' => $row[5],
        ]);
    }
}
