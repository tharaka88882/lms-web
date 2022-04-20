<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Milestone;
use App\Models\Note;
use App\Http\Requests\TaskRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $milestone = Milestone::FindOrFail($id);
        return view('student.notes', compact('milestone'));
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
        $note->status = $request->get('status');
        $note->milestone_id = $request->get('milestone_id');
        $note->save();
        Toastr::success('Task is added successfully :)', 'Added');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $note = Note::FindOrFail($request->get('note_id'));
        $note->delete();
        Toastr::success('Milestone is deleted successfully :)', 'Deleted');
      //  return redirect()->route('user.notes',$request->get('milestone_id'));
      return array(
          'success'=>true
      );
    }
}
