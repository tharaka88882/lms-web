<?php

namespace App\Http\Controllers;

//use App\Exports\UsersExport;
//use App\Imports\UsersImport;

use App\Exports\SubjectsExport;
use App\Imports\SubjectsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
       return view('excel.excel');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request)
    {
        Excel::import(new SubjectsImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport()
    {
        return Excel::download(new SubjectsExport, 'users-collection.xlsx');
    }
}
