<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Institute;
use Brian2694\Toastr\Facades\Toastr;


class AdminController extends Controller
{
    public function add_position(){
        $positions = Position::paginate(20);
        return view('admin.position', compact('positions'));
    }

    public function add_company(){
        $companies = Institute::paginate(20);
        return view('admin.company', compact('companies'));
    }

    public function store_position(Request $request){

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $position = new Position();
        $position->text = $request->get('name');
        $position->save();

        Toastr::success('New position added successfully :)', 'Success');
        return redirect()->route('admin.add_position');
    }

    public function store_company(Request $request){

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $company = new Institute();
        $company->text = $request->get('name');
        $company->save();

        Toastr::success('New Institute/Company added successfully :)', 'Success');
        return redirect()->route('admin.add_company');
    }

    public function edit_position($id){
        $position =  Position::findOrFail($id);

        return view('admin.edit_position', compact('id', 'position'));
    }

    public function edit_company($id){
        $company =  Institute::findOrFail($id);

        return view('admin.edit_company', compact('id', 'company'));
    }

    public function update_position(Request $request,$id){

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $position = Position::findOrfail($id);
        $position->text = $request->get('name');
        $position->save();

        Toastr::success('Position updated successfully :)', 'Success');
        return redirect()->route('admin.add_position');
    }

    public function update_company(Request $request,$id){

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $company = Institute::findOrFail($id);
        $company->text = $request->get('name');
        $company->save();

        Toastr::success('Institute/Company updated successfully :)', 'Success');
        return redirect()->route('admin.add_company');
    }

    public function destory_position($id){
        $position = Position::findOrFail($id);
        $position->delete();

        Toastr::success('New Position deleted successfully :)', 'Success');
        return redirect()->route('admin.add_position');
    }

    public function destory_company($id){
        $company = Institute::findOrFail($id);
        $company->delete();

        Toastr::success('Institute/Company deleted successfully :)', 'Success');
        return redirect()->route('admin.add_company');
    }
}
