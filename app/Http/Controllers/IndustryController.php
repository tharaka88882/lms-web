<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::paginate(20);
        return view('admin.industry', compact('industries'));
    }

    public function store(Request $request)
    {

        $industry_list = Industry::all();

        $flag = true;

        foreach ($industry_list as $industry) {
            if (Str::lower($request->get('name')) == Str::lower($industry->name)) {
                $flag = false;
            }
        }

        if ($flag) {
            $subject = new Industry();
            $subject->name = $request->get('name');
            $subject->status = 1;
            $subject->save();
            Toastr::success('Industry is added successfully', 'Success');
        } else {
            Toastr::error('Duplicate Industry Name', 'Error');
        }

        return redirect()->route('admin.industry');
    }

    public function destroy($id)
    {
        $indstry = Industry::findOrFail($id);
        $indstry->delete();
        Toastr::success('Industry is deleted successfully', 'Deleted');
        return redirect()->route('admin.industry');
    }
}
