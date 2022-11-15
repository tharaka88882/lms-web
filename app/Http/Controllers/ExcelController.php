<?php

namespace App\Http\Controllers;

//use App\Exports\UsersExport;
//use App\Imports\UsersImport;

use App\Exports\SubjectsExport;
use App\Imports\SubjectsImport;
use App\Imports\IndustryImport;
use Illuminate\Http\Request;
use App\Models\Teacher;
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


    public function cc_()
    {
        try{
            $cc=  null;
            $teacher = Teacher::findOrFail(3);
            $cc =$teacher;
            $teacher->delete();
            dd($cc);

           // dd('done');

        }catch(Exception $e){
            dd('error');
        }
    }
}
