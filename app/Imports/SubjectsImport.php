<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;

class SubjectsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row[1]);
    if(!empty($row[1])){
        return new Subject([
            'name' => $row[1],
            'status'    => 1
        ]);
    }
    }
}
