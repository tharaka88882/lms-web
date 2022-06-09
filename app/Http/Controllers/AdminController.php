<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Institute;
use Brian2694\Toastr\Facades\Toastr;


class AdminController extends Controller
{
    public function add_position(){
        dd("test");
    }

    public function add_company(){
        dd("test");
    }

    public function store_position(Request $request){
        $position = new Position();
        $position->text = $request->get('position');
        $position->save();

        Toastr::success('New Position added successfully :)', 'Success');
        return redirect()->route('admin.add_position');
    }

    public function store_company(Request $request){
        $company = new Institute();
        $company->text = $request->get('company');
        $company->save();

        Toastr::success('New Company added successfully :)', 'Success');
        return redirect()->route('admin.add_company');
    }

    public function edit_position(){
        dd("test");
    }

    public function edit_company(){
        dd("test");
    }

    public function update_position(Request $request,$id){
        $position = Position::findOrfail($id);
        $position->text = $request->get('position');
        $position->save();

        Toastr::success('New Position updated successfully :)', 'Success');
        return redirect()->route('admin.edit_position');
    }

    public function update_company(Request $request,$id){
        $company = Institute::findOrFail($id);
        $company->text = $request->get('company');
        $company->save();

        Toastr::success('New Company updated successfully :)', 'Success');
        return redirect()->route('admin.edit_company');
    }

    public function destory_position(Request $request){
        $position = Position::findOrfail($request->get('id'));
        $position->delete();

        Toastr::success('New Position deleted successfully :)', 'Success');
        return array(
            'success'=>true
        );
    }

    public function destory_company(Request $request){
        $company = Institute::findOrFail($request->get('id'));
        $company->delete();

        Toastr::success('New Company deleted successfully :)', 'Success');
        return array(
            'success'=>true
        );
    }
}
