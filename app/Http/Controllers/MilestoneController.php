<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MilestoneRequest;

class MilestoneController extends Controller
{
    public function index()
    {
        $in_progress = 0;
        $completed = 0;
        $overdue = 0;
        $user = Auth::user();
        $milestones = Milestone::where(['user_id' => $user->userable->id])->get();

        foreach($milestones as $milestone){
            $date_facturation = \Carbon\Carbon::parse($milestone->due_date);
            if( $milestone->status!=1 && $date_facturation->isPast() && $milestone->status!=0){
                $milestone->status=3;
            }

            if($milestone->status==2){
                $in_progress+=1;
            }else if($milestone->status==1){
                $completed+=1;
            }else if($milestone->status==3){
                $overdue+=1;
            }
            $milestone->save();
        }
       $tot =($in_progress+$completed+$overdue);
       if($in_progress!=0){
        $in_progress = ($in_progress/$tot)*100;
       }
       if($completed!=0){
        $completed = ($completed/$tot)*100;
       }
       if($overdue!=0){
        $overdue = ($overdue/$tot)*100;
       }

       // dd($in_progress." ".$completed." ".$overdue);


        return view('milestone_list', compact('milestones','in_progress','completed','overdue'));
    }

    public function create(MilestoneRequest $request)
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
    public function update(Request $request)
    {
        $milestone = Milestone::findOrFail($request->get('id'));
        $milestone->status = $request->get('status');

        $date_facturation = \Carbon\Carbon::parse($milestone->due_date);
        if( $milestone->status!=1 && $date_facturation->isPast() && $milestone->status!=0){
            $milestone->status=3;
        }
        $milestone->save();
        Toastr::success('Milestone is update successfully :)', 'Updated');
        return array(
            'success'=>true
        );
    }
}
