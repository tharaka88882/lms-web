<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLinkedinRequest;
use App\Models\Complaint;
use App\Models\Conversation;
use App\Models\MentorConversation;
use App\Models\Milestone;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use App\Models\UserOrder;
use App\Models\Rating;
use App\Models\UserTransaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  Auth::user();
        // return get_class($user);

        $pending_count = Teacher::where('status', '=', '0')->count();
        //$teachers_count = $teachers->count();
        //dd($pending_count);
        $teachers_count = Teacher::where('status', '=', '1')->count();

        $my_teachers_count = 0;
        $my_students_count = 0;

        $mentee_teachers_count = Conversation::where('student_id', '=',Auth()->user()->userable_id)->count();
        $my_teachers_count += MentorConversation::where('mentee_id', '=',Auth()->user()->userable_id)->count();

        $my_students_count += Conversation::where('teacher_id', '=',Auth()->user()->userable_id)->count();
        $my_students_count += MentorConversation::where('mentor_id', '=',Auth()->user()->userable_id)->count();

        $students_count = Student::where('status', '=', '1')->count();
        $subject_count = Subject::Where('status', '=', '1')->count();

        $pending_teachers_list =  Teacher::where('status', 0)->get();
        $schedules = Schedule::where('teacher_id', $user->userable->id)->get();
        $schedule_count = Schedule::where('teacher_id', $user->userable->id)->count();

        $convo_count = Conversation::where('student_id', $user->userable->id)->count();

        $total_sale = 0;
        $total_payout =0;
        $user_orders = UserOrder::where('status',1)->get();
        foreach($user_orders as $user_order){
            $total_sale+=doubleval($user_order->amount);
        }
        $user_transactions = UserTransaction::where('receiver_id',3)->where('status', 1)->get();
        foreach ($user_transactions as $user_transaction) {
            $total_payout += doubleval($user_transaction->amount);
        }
        // $avalible_steams_count =

        $user_orders = UserOrder::where('user_id', Auth()->user()->id)->orderBy('created_at', 'desc')->take(3)->get();

        $subjects = TeacherSubject::select('name')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where('teacher_subjects.teacher_id', $user->userable->id)
            ->get();

        $my_subject_count = json_decode($subjects, true);
        $my_subject_count = count($my_subject_count);

        $milestones = Milestone::where(['user_id' => $user->id])->get();
        $my_milestones_count = json_decode($milestones, true);
        $my_milestones_count = count($my_milestones_count);


        $completed_milestones_count = Milestone::where('user_id', '=',Auth()->user()->id)
                                    ->where('status', '=', '1')->count();
        $inprogress_milestones_count = Milestone::where('user_id', '=',Auth()->user()->id)
                                    ->where('status', '=', '2')->count();
        $overdue_milestones_count = Milestone::where('user_id', '=',Auth()->user()->id)
                                    ->where('status', '=', '3')->count();

        $ratings = Rating::where('teacher_id',Auth()->user()->userable_id)->get();
        $rator_count = count(json_decode( $ratings,true));
        $rating_count = 0;
        $mediation = 0;
            foreach($ratings as $rating){
                $rating_count+=$rating->rating;
            }
       if($rator_count!=0){
        $mediation = $rating_count/$rator_count;
       }

        $round_mediation =(int)$mediation;
        // dd($round_mediation);
        if (get_class($user->userable) == 'App\Models\Teacher') {
            // return view('under_construction');
            return view('home_teacher', compact('pending_count', 'teachers_count', 'students_count', 'subject_count', 'pending_teachers_list', 'schedules', 'schedule_count', 'subjects', 'convo_count','my_teachers_count','my_students_count', 'my_subject_count', 'my_milestones_count','completed_milestones_count','inprogress_milestones_count','overdue_milestones_count','mediation','round_mediation'));
        } else if (get_class($user->userable) == 'App\Models\Student') {
            // return view('under_construction');
            return view('home_student', compact('pending_count', 'teachers_count', 'students_count', 'subject_count', 'pending_teachers_list', 'convo_count', 'user_orders', 'my_milestones_count', 'completed_milestones_count','inprogress_milestones_count','overdue_milestones_count','mentee_teachers_count'));
        } else if (get_class($user->userable) == 'App\Models\Admin') {
            return view('home', compact('pending_count', 'teachers_count', 'students_count', 'subject_count', 'pending_teachers_list', 'total_sale', 'total_payout'));
        } else {
            return "not found";
        }
        // return route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function privacy_policy()
    {
        return view('privacy');
    }

    public function disclaimer()
    {
        return view('disclaimer');
    }
    public function view_linkedin()
    {
        return view('auth.save_linkedin');
    }

    public function save_linkedin(SaveLinkedinRequest $request){
       if( $request->get('linkedin_link')!=null){
        $teacher = Teacher::findOrFail(Auth()->user()->userable_id);
        $teacher->linkedin_link = $request->get('linkedin_link');
        $teacher->save();
        Toastr::success('successfully :)', 'Success');
        return redirect('user/dashboard');
       }else{
        Toastr::error("Linkedin link can't be empty :(", 'Error');
        return redirect()->route('auth.view_linkedin');
       }

    }
}
