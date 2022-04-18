<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $milestones = Milestone::where(['user_id' => $user->userable->id])->get();

        return view('milestone_list', compact('milestones'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $milestone = new Milestone();
        $milestone->note = $request->get('note');
        $milestone->due_date = $request->get('due_date');
        $milestone->user_id = $user->userable->id;
        $milestone->save();
        Toastr::success('Milestone is added successfully :)', 'Success');

        return redirect()->route('user.milestone');
    }

    public function destroy($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();
        Toastr::success('Milestone is deleted successfully :)', 'Deleted');
        return redirect()->route('user.milestone');
    }
}
