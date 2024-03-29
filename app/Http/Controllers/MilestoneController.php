<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Note;
use App\Models\StikeyMilestone;
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
        $milestones = Milestone::where(['user_id' => $user->id])->orderBy('due_date', 'asc')->get();

        $completed_milestones_count = Milestone::where('user_id', '=',Auth()->user()->id)
                                    ->where('status', '=', '1')->count();
        $inprogress_milestones_count = Milestone::where('user_id', '=',Auth()->user()->id)
                                    ->where('status', '=', '2')->count();
        $overdue_milestones_count = Milestone::where('user_id', '=',Auth()->user()->id)
                                    ->where('status', '=', '3')->count();

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


        return view('milestone_list', compact('milestones','in_progress','completed','overdue','completed_milestones_count','inprogress_milestones_count','overdue_milestones_count'));
    }

    public function create(MilestoneRequest $request)
    {
        $user = Auth::user();
        $milestone = new Milestone();
        $milestone->note = $request->get('note');
        $milestone->due_date = $request->get('due_date');
        $milestone->user_id = $user->id;
        $milestone->save();
        Toastr::success('Milestone is added successfully', 'Success');

        return redirect()->route('user.milestone');
    }

    public function destroy($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();
        Toastr::success('Milestone is deleted successfully', 'Deleted');
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
        Toastr::success('Milestone is update successfully', 'Updated');
        return array(
            'success'=>true
        );
    }
    public function edit_milestone($id)
    {
        $milestone = Milestone::findOrFail($id);

        return view('edit_milestone', compact('milestone','id'));

    }
    public function update_milestone(Request $request,$id)
    {
        //dd("");
        $milestone = Milestone::findOrFail($id);
        $milestone->note = $request->get('note');
        $milestone->due_date = $request->get('due_date');
        $milestone->save();

        Toastr::success('Goal is update successfully', 'Updated');
        return  redirect()->route('user.milestone');

    }
    public function add_s_note(Request $request)
    {
        $stikey_milestone =  new StikeyMilestone();
        $stikey_milestone->s_note = $request->get('s_note');
        $stikey_milestone->user_id = Auth()->user()->id;
        $stikey_milestone->milestone_id = $request->get('id');

        $stikey_milestone->save();
      //  Toastr::success('Milestone is update successfully :)', 'Updated');
        return array(
            'success'=>true
        );
    }
    public function edit_task($id)
    {
        $note =   Note::findOrFail($id);

      //  Toastr::success('Milestone is update successfully :)', 'Updated');
      return view('edit_task', compact('id','note'));

    }
    public function update_task(Request $request,$id)
    {
        $note =   Note::findOrFail($id);
        $note->text = $request->get('text');
        $note->due_date = $request->get('due_date');
        $note->milestone_id = $request->get('milestone_id');

        $note->save();
        Toastr::success('Task is update successfully', 'Updated');
        return redirect()->route('user.notes',$request->get('milestone_id'));
    }
    public function distory_s_note(Request $request)
    {
        $stikey_milestone =   StikeyMilestone::findOrFail($request->get('id'));
        $stikey_milestone->delete();

        //$stikey_milestone->save();
      //  Toastr::success('Milestone is update successfully :)', 'Updated');
        return array(
            'success'=>true
        );
    }
}
