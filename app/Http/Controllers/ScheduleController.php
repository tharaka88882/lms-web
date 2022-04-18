<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\TeacherSubject;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('teacher.calender');

        $user = Auth::user();
        $schedules = Schedule::where('teacher_id', $user->userable->id)->paginate(10);
        return view('teacher.schedule_list', compact('schedules'));
        //return view('teacher.calender',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =  Auth::user();
        $subjects = TeacherSubject::query()->select('teacher_subjects.*', 'subjects.name')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where(['teacher_subjects.teacher_id' => $user->userable->id])->get();
        return view('teacher.add_schedule', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddScheduleRequest $request)
    {
        $schedule = new Schedule();
        $user = Auth::user();
        $schedule->name = $request->get('name');
        $schedule->description = $request->get('description');
        $schedule->schedule_date = $request->get('schedule_date');
        $schedule->start_time = $request->get('start_time');
        $schedule->end_time = $request->get('end_time');
        $schedule->teacher_id = $user->userable->id;
        $schedule->save();

        return redirect()->route('teacher.schedule_list');
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
        $schedule = Schedule::findOrFail($id);
        $user =  Auth::user();
        $subjects = TeacherSubject::query()->select('teacher_subjects.*', 'subjects.name')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where(['teacher_subjects.teacher_id' => $user->userable->id])->get();
        return view('teacher.edit_schedule', compact('schedule', 'id', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->name = $request->get('name');
        $schedule->description = $request->get('description');
        $schedule->schedule_date = $request->get('schedule_date');
        $schedule->start_time = $request->get('start_time');
        $schedule->end_time = $request->get('end_time');
        $schedule->save();
        $user = Auth::user();
        $schedules = Schedule::where('teacher_id', $user->userable->id)->get();

        return redirect()->route('teacher.schedule_list', compact('schedules'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('teacher.schedule_list');
    }
}
