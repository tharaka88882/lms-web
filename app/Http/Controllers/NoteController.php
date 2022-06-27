<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Milestone;
use App\Models\Note;
use App\Http\Requests\TaskRequest;
use Brian2694\Toastr\Facades\Toastr;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $in_progress = 0;
        $completed = 0;
        $Cancelled = 0;
        $milestone = Milestone::FindOrFail($id);

        foreach($milestone->notes as $note){

            $date_facturation = \Carbon\Carbon::parse($note->due_date);
            if( $note->status!=1 && $date_facturation->isPast() && $note->status!=0){
                $note->status=0;
            }

            if($note->status==2){
                $in_progress+=1;
            }else if($note->status==1){
                $completed+=1;
            }else if($note->status==0){
                $Cancelled+=1;
            }
            $note->save();
        }
        $tot = ($in_progress+$completed+$Cancelled);
        if($in_progress!=0){
            $in_progress = ($in_progress/$tot)*100;
        }
        if($completed!=0){
            $completed = ($completed/$tot)*100;
        }
        if($Cancelled!=0){
            $Cancelled = ($Cancelled/$tot)*100;
        }

        return view('student.notes', compact('milestone','in_progress','completed','Cancelled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $note = new Note();
        $note->text = $request->get('text');
        $note->due_date = $request->get('due_date');
        $note->status = 2;
        $note->milestone_id = $request->get('milestone_id');
        $note->save();
        Toastr::success('Task added successfully', 'Added');
        return redirect()->route('user.notes',$request->get('milestone_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $note = Note::FindOrFail($request->get('id'));
        $note->status = $request->get('status');
        $note->save();
        Toastr::success('Milestone updated successfully', 'Updated');
        return array(
            'success'=>true
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $note = Note::FindOrFail($request->get('id'));
        $note->delete();
        Toastr::success('Milestone deleted successfully', 'Deleted');
      //  return redirect()->route('user.notes',$request->get('milestone_id'));
      return array(
          'success'=>true
      );
    }
}
