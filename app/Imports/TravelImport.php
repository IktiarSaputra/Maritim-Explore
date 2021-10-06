<?php

namespace App\Imports;

use App\Models\Travel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Str;

class TravelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Travel([
            'work_unit' => $row[0],
            'slug' => Str::slug($row[2]),
            'region_name' => $row[1],
            'tourist_attraction' => $row[2],
            'address' => $row[3],
            'manager' => $row[4],
        ]);
    }
}
