<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTeachersRequest;
use App\Http\Requests\RequestPayoutRequest;
use App\Http\Requests\StoreMySubjectRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Complaint;
use App\Models\Conversation;
use App\Models\Industry;
use App\Models\MentorConversation;
use App\Models\MentorMessage;
use App\Models\Message;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;
use App\Traits\UserTrait;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\UserTransaction;
use App\Models\Milestone;
use App\Models\Institute;
use App\Models\RatingView;
//use App\Traits\UserTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MenteeComplaints;



use function PHPUnit\Framework\isEmpty;

class TeacherController extends Controller
{

    use UserTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::paginate(10);
        $id = '';
        $classes = array();
        return view('admin.teachers_list', compact('teachers', 'id', 'classes'));
    }
    // public function addTeachers()
    // {
    //     // $teachers = Teacher::all();
    //     // $id = '';
    //     // $classes = array();
    //    // return view('admin.add_teacher');
    // }

    //save new teacher with login
    public function save_teacher(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTeachersRequest $request)
    {
        $user = null;
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' =>  $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);


            $teacher = new Teacher();
            $teacher->nic = $request->get('nic');
            $teacher->qualification = $request->get('qualification');
            $teacher->experience = $request->get('experience');
            $teacher->skills = $request->get('skills');
            if ($request->get('status') == 'on') {
                $teacher->status = true;
            } else {
                $teacher->status = false;
            }

            $teacher->save();
            $teacher->user()->save($user);
            Toastr::success('Teacher Added successfully', 'Success');

            DB::commit();
        } catch (Exception $e) {
            return $e;
            Log::error($e);
            DB::rollback();
            Toastr::error($e->getMessage(), 'Error');
        }

        return redirect()->route('admin.add-teachers');
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
        $teacher =  Teacher::findOrFail($id);
        return view('admin.edit_teacher', compact('id', 'teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateTeacherRequest $request, $id)
    {
        //dd($id);
        $teacher = Teacher::findOrFail($id);
        $teacher->user->name = $request->get('name');
        $teacher->user->address = $request->get('address');
        $teacher->user->city = $request->get('city');
        $teacher->user->country = $request->get('country');
        //$teacher->user->email = $request->get('email');
        // if (!empty($request->get('password'))) {
        //     $teacher->user->password = $request->get('password');
        // }
        $teacher->nic = $request->get('nic');
        $teacher->qualification = $request->get('qualification');
        $teacher->experience = $request->get('experience');
        $teacher->skills = $request->get('skills');
        $teacher->industry = $request->get('industry');
        $teacher->job = $request->get('job');
        $teacher->level = $request->get('level');
        $teacher->linkedin_link = $request->get('linkedin_link');
        if ($request->get('status') == 'on') {
            $teacher->status = true;
            $this->createNotification($teacher->user->id, 'Your account has been Activated');
        } else {
            $teacher->status = false;
            $this->createNotification($teacher->user->id, 'Your account has been Deactivated');
        }
        $teacher->save();
        $teacher->user->save();
        Toastr::success('Teacher Updated successfully', 'Success');

        return redirect()->route('admin.edit_teacher', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        Toastr::success('Teacher Deleted successfully', 'Deleted');
        return redirect()->route('admin.teachers');
    }
    public function pending()
    {
        //  $status = 0;
        $teachers =  Teacher::where('status', 0)->get();
        return view('admin.pending_teachers', compact('teachers'));
    }
    public function my_subject()
    {

        $user =  Auth::user();
        $subjects = TeacherSubject::query()->select('teacher_subjects.*', 'subjects.name')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where(['teacher_subjects.teacher_id' => $user->userable->id])->get();

        return view('teacher.my_subject_list', compact('subjects', $user->userable->id));
    }
    public function find_subject()
    {
        $subjects = Subject::where('status', 1)->get();
        // $user =  Auth::user();

        return view('teacher.add_my_subject', compact('subjects'));
    }
    public function stor_my_subject(StoreMySubjectRequest $request)
    {
        $user = Auth::user();

        $subject = TeacherSubject::where('subject_id', $request->get('subject'))->Where('teacher_id', $user->userable->id)->get();
        // $teacher_s = TeacherSubject::where('teacher_id',$user->userable->id)->get();
        //  return $subject;

        if (empty($subject[0])) {

            $teacher_subject = new TeacherSubject();
            $teacher_subject->teacher_id = $user->userable->id;
            $teacher_subject->subject_id = $request->get('subject');
            $teacher_subject->save();

            $teacher = Teacher::findOrFail(Auth()->user()->userable_id);
            if( $teacher->skills!=null){
                $teacher->skills  =  $teacher->skills." | ".$teacher_subject->subject->name;
            }else{
                $teacher->skills  = $teacher_subject->subject->name;
            }
            $teacher->save();
            Toastr::success('Mentoring Topic Added successfully', 'Success');
        }else{
            Toastr::warning('This Topic has already been taken', 'Warning');
            return redirect()->back();
        }


        return redirect()->route('teacher.my_subject');
    }
    public function stor_my_subject1(StoreMySubjectRequest $request)
    {
        $user = Auth::user();

        $subject = TeacherSubject::where('subject_id', $request->get('subject'))->Where('teacher_id', $user->userable->id)->get();
        // $teacher_s = TeacherSubject::where('teacher_id',$user->userable->id)->get();
        //  return $subject;

        if (empty($subject[0])) {

            $teacher_subject = new TeacherSubject();
            $teacher_subject->teacher_id = $user->userable->id;
            $teacher_subject->subject_id = $request->get('subject');
            $teacher_subject->save();

            $teacher = Teacher::findOrFail(Auth()->user()->userable_id);
            if( $teacher->skills!=null){
                $teacher->skills  =  $teacher->skills." | ".$teacher_subject->subject->name;
            }else{
                $teacher->skills  = $teacher_subject->subject->name;
            }
            $teacher->save();
            Toastr::success('Mentoring Topic Added successfully', 'Success');
        }else{
            Toastr::warning('This Topic has already been taken', 'Warning');
            return array(
                'error'=>true
            );
        }


        return array(
            'error'=>false
        );
    }

    public function edit_my_subject($id)
    {
        $teacher =  Teacher::findOrFail($id);
        return view('teacher.edit_my_subject', compact('id', 'teacher'));
    }

    public function destroy_subject(Request $request)
    {
        $teacher_subject = TeacherSubject::findOrFail($request->get('id'));
        $teacher_subject->delete();

        return array(
            "success" => true
        );
    }

    public function chat(Request $request, $id)
    {

        $conversation = Conversation::findOrFail($id);
        $menteeDevs = Milestone::where('user_id', $conversation->student->user->id)->get();
        //dd($menteeDevs);
        $userTransaction = UserTransaction::where('sender_id', $conversation->student->user->id)
            ->where('receiver_id', Auth()->user()->id)->where('status', 0)->first();
        return view('teacher.chat', compact('request', 'id', 'conversation', 'userTransaction','menteeDevs'));
    }

    public function conversations(Request $request)
    {
        $query1 = Conversation::query();
        $query2 = MentorConversation::query();
        $query1 = $query1->select('conversations.*')->join('students', 'students.id', '=', 'conversations.student_id')->join('users', 'users.userable_id', '=', 'students.id')->where('conversations.teacher_id', Auth()->user()->userable->id)->where('users.userable_type','App\Models\Student');
        $query2 = $query2->select('mentor_conversations.*')->join('students', 'students.id', '=', 'mentor_conversations.mentee_id')->join('users', 'users.userable_id', '=', 'students.id')->where('mentor_conversations.mentor_id', Auth()->user()->userable->id)->where('users.userable_type','App\Models\Teacher');

        if($request->get('m_name')!=null){
            $query1->where('users.name', 'like', $request->get('m_name').'%');
            $query2->where('users.name', 'like', $request->get('m_name').'%');
        }
         if($request->get('develop')!=null){
            $query1->join('milestones','milestones.user_id','=','users.id')->where('milestones.note', 'like', $request->get('develop').'%');
            $query2->join('milestones','milestones.user_id','=','users.id')->where('milestones.note', 'like', $request->get('develop').'%');
        }
        //dd( $mentee_conversations);
        $mentee_conversations = $query1->get();
        $mentor_conversations = $query2->get();
        $conversations =  array();
        $stikey = '';
        $i = 0;
        foreach ($mentee_conversations as $mentee_conversation) {
                foreach($mentee_conversation->student->stikey as $stikey){
                    if($stikey->user_id==Auth()->user()->id && $stikey->student_id==$mentee_conversation->student->id){
                        $stikey = $stikey->note;
                    }
                }
            $conversations[$i] = array(
                'ar_index' =>$i,
                'id' => $mentee_conversation->student_id,
                'name' => $mentee_conversation->student->user->name,
                'image' => $mentee_conversation->student->user->image,
                'email' => $mentee_conversation->student->user->email,
                'grade' => $mentee_conversation->student->grade,
                'user' => 'mentee',
                'conversation_id' => $mentee_conversation->id,
                'milestone'=> $mentee_conversation->student->user->milestones,
                'stikey'=> $mentee_conversation->student->stikey,
                'status' => $mentee_conversation->student->status,
                'updated_at' => $mentee_conversation->updated_at
            );
            $i++;
        }
        $i = sizeof($conversations) + 1;
        foreach ($mentor_conversations as $mentor_conversation) {

            foreach($mentor_conversation->mentee->stikey as $stikey){
                if($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$mentor_conversation->mentee->id){
                    $stikey = $stikey->note;
                }
            }
            $conversations[$i] = array(
                'ar_index' =>$i,
                'id' => $mentor_conversation->mentee_id,
                'name' => $mentor_conversation->mentee->user->name,
                'image' => $mentor_conversation->mentee->user->image,
                'email' => $mentor_conversation->mentee->user->email,
                'grade' => 'Non',
                'user' => 'mentor',
                'conversation_id' => $mentor_conversation->id,
                'milestone' => $mentor_conversation->mentee->user->milestones,
                'stikey'=> $mentor_conversation->mentee->stikey,
                'status' => $mentor_conversation->mentee->status,
                'updated_at' => $mentor_conversation->updated_at
            );
            $i++;
        }
        $conversations = collect($conversations)->sortBy('updated_at')->reverse()->toArray();

        // dd($conversations);

        return view('teacher.my_students', compact('conversations', 'request'));
    }



    public function mentors(Request $request)
    {
        $query = null;
        $select_subject = null;
        $query = Teacher::query();
        $query = $query->select('teachers.*')->join('users','users.userable_id','=','teachers.id')->where('teachers.id', '<>', Auth()->user()->userable->id)->where('users.userable_type','App\Models\Teacher');
       // dd($query->get());
        if ($request->get('search_industry')!=null) {

            $query->where('teachers.industry', $request->get('search_industry'));
        }
         if ($request->get('m_name')!= null) {
            $query->where('users.name','LIKE', $request->get('m_name').'%');
        }
         if ($request->get('company') != null) {
            $query->leftjoin('experiences', 'experiences.teacher_id', '=', 'teachers.id')
            ->join('institutes', 'institutes.id', '=', 'experiences.institute_id')
            ->where('institutes.text', $request->get('company'));
        }
         if ($request->get('search_subject') !=null) {
            $query->leftjoin('teacher_subjects', 'teacher_subjects.teacher_id', '=', 'teachers.id')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where('subjects.id', $request->get('search_subject'));
            $select_subject = Subject::findOrFail($request->get('search_subject'));
        } if ($request->get('city')) {
            // dd('test2');
            // dd($request->get('city'));
            $query->where('users.city', 'like', $request->get('city'))->where('users.id', '<>', Auth()->user()->id);
        } if ($request->get('country') != null) {
            // dd('test3');
            // dd($request->get('country'));
            $query->where('users.country', 'like', $request->get('country'))->where('users.id', '<>', Auth()->user()->id);
        } if($request->get('select_order') != null){
            if($request->get('select_order') == '1'){
                $query->orderBy('rating', 'DESC');
            }else{
                $query->orderBy('rating', 'ASC');
            }
        } else {
            $query->orderBy('rating', 'DESC');
            //dd('test4');
          //  $query = Teacher::where('status', 1)->where('id', '<>', Auth()->user()->userable->id);
        }



        $tutors = $query->get();

        for ($i=0; $i < count($tutors); $i++) {
            $tutor_subjects = TeacherSubject::select('subjects.*')->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')->where('teacher_subjects.teacher_id', '=', $tutors[$i]['id'])->get();
            $tutor_subjects = json_decode($tutor_subjects, true);
            $tutors[$i]['subjects'] = $tutor_subjects;

            $tutor_convversation = MentorConversation::where('mentor_id', $tutors[$i]['id'])->where('mentee_id', Auth()->user()->userable->id)->first();
            $tutor_convversation = json_decode($tutor_convversation, true);
            $tutors[$i]['conversation'] = $tutor_convversation;
            $tutors[$i]['avg_time'] =rand(1,5);

        }


        $subjects = Subject::all();
        $industries = Industry::all();
        $institutes = Institute::all();



        return view('teacher.find_mentors', compact('tutors', 'subjects', 'industries','institutes','request','select_subject'));
    }

    public function view_mentor(Request $request, $id)
    {
        // dd($request);
        $teacher = Teacher::findOrFail($id);
        $schedules = Schedule::where('teacher_id',$id)->get();


         // Rating-------------------------------------------------------------------------

         $ratings = Rating::where('teacher_id',$id)->get();
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

        $query = MentorConversation::where('mentor_id',$id)->where('mentee_id', Auth()->user()->userable->id)->first();
        // dd($query);
        $conversations = array();
        if ($query != null) {
            $conversations = MentorMessage::where('conversation_id', $query->id)->where('sender_id', $teacher->id)->get();
        }
        // dd($teacher->user->id);


        //$rating = Rating::where('teacher_id',  $id)->where('user_id', Auth()->user()->id)->get();

        $subjects = TeacherSubject::select('name')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where('teacher_subjects.teacher_id',$id)
            ->get();

        //return $rating;
        $old_ratings = Rating::where('teacher_id',$id)->where('user_id',Auth()->user()->id)->get();
       // $time_total_array = explode(",",$id)[1];
        return view('teacher.view_mentor', compact('request', 'teacher', 'conversations', 'mediation', 'schedules', 'query', 'subjects','old_ratings'));
    }


    public function mentor_chat(Request $request, $id)
    {
        $setting = Setting::first();
        $conversation = MentorConversation::findOrFail($id);
        $teacher = Teacher::findOrFail($conversation->mentor_id);
        $menteeDevs = Milestone::where('user_id', $conversation->mentee->user->id)->get();
        $teacherSubs = TeacherSubject::select('*')->join('subjects','teacher_subjects.subject_id','=','subjects.id')->where('teacher_id', $conversation->mentor_id)->get();

        $rating_view =null;
        $rating_view = RatingView::where('r_count','<=',3)->where('status',0)->where('user_id',Auth()->user()->id)->first();
        if($rating_view == null){
            $rating_view = RatingView::where('r_count',3)->where('status',0)->where('user_id',Auth()->user()->id)->first();
        }



        $userTransaction = UserTransaction::where('sender_id', Auth()->user()->id)->where('receiver_id', $conversation->mentor->user->id)->where('status', 0)->first();
        $userMentorTransaction = UserTransaction::where('sender_id', $conversation->mentee->user->id)->where('receiver_id', Auth()->user()->id)->where('status', 0)->first();

        //dd($conversation->mentor);
        //  return view('teacher.mentor_chat', compact('request', 'id', 'conversation'));
        // $conversations = MentorConversation::where('mentee_id', Auth()->user()->userable->id)->where('mentor_id',$conversation->mentor_id)->first();
        $conversations = MentorConversation::select('mentor_messages.sender_id')->join('mentor_messages', 'mentor_messages.conversation_id', '=', 'mentor_conversations.id')
            ->where('mentor_conversations.mentee_id', Auth()->user()->userable->id)->get();
       // dd($conversations);
        $flag = false;
        $looping_count =0;
        $conver_count =  MentorConversation::select('mentor_messages.sender_id')->join('mentor_messages', 'mentor_messages.conversation_id', '=', 'mentor_conversations.id')
        ->where('mentor_conversations.mentee_id', Auth()->user()->userable->id)->count();
       // dd($conver_count);
     if(sizeof( $conversations)>0){
        foreach($conversations as $conver){
            $looping_count ++;
            //dd($conver);
            if($conver->sender_id != Auth()->user()->userable->id){
                $flag = false;
                 $rating = Rating::where('teacher_id', $conver->sender_id)->where('user_id', Auth()->user()->id)->first();

                 if($rating == null){
                    if($rating_view == null){
                        $rating_view = new RatingView();
                        $rating_view->r_count = 1;
                        $rating_view->status = 0;
                        $rating_view->mentor_id = $conver->sender_id;
                        $rating_view->user_id =Auth()->user()->id;
                        $rating_view->save();
                        return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs','rating_view'));
                    }else{
                    if($rating_view->r_count<3){
                        $rating_view->r_count = $rating_view->r_count +1;
                        $rating_view->save();
                        return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs','rating_view'));
                    }else{
                  if($rating_view->status == 0){
                    Toastr::warning("Please rate mentor (" . $rating_view->mentor->user->name . ")", 'Warning');
                    return redirect()->route('teacher.view_mentor', $rating_view->mentor->id);
                  }
                    }
                    }
                 }else{
                    //dd($conver->sender_id);
                    $flag = true;
                 }


            }else{
                $flag = true;
            }
        }
     }else{
        return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs','rating_view'));
     }
        if($flag && $looping_count == $conver_count){
            return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs','rating_view'));
        }

            //return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs','rating_view'));
        //dd($conversations);
        // $flag = false;
        // foreach ($conversations as $conver) {
        //     if ($conver->sender_id != Auth()->user()->userable->id) {
        //         // dd('tt');
        //         $user = Teacher::findOrFail($conver->sender_id);
        //         // dd($user);
        //         // if( $user->userable_type == 'App\Models\Teacher'){
        //         $rating =  Rating::where('teacher_id', $conver->sender_id)->where('user_id', Auth()->user()->id)->get();
        //         // dd(sizeof($rating));
        //         $flag = false;
        //         if (sizeof($rating) > 0) {
        //             // dd('test');
        //             return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs'));
        //         } else {
        //             Toastr::warning("Please rate mentor (" . $user->user->name . ")", 'Warning');
        //             return redirect()->route('teacher.view_mentor', $conver->sender_id);
        //         }
        //         // }

        //     } else {
        //         $flag = true;
        //         //    if(sizeof($conversations)<2){
        //         //     return view('teacher.mentor_chat', compact('request', 'id', 'conversation'));
        //         //    }
        //         // dd(sizeof($conversations));
        //     }
        // }
        // if ($flag) {
        //     //dd("test");
        //     return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs'));
        // } else if (sizeof($conversations) == 0) {
        //     return view('teacher.mentor_chat', compact('request', 'id', 'conversation', 'userTransaction', 'userMentorTransaction', 'teacher', 'setting','menteeDevs','teacherSubs'));
        //     // dd("test");
        // }
    }

    public function mentor_conversation(Request $request)
    {
        $query = null;
        $select_subject = null;
        $query =  MentorConversation::query();
        $query = $query->select('mentor_conversations.*')->join('teachers', 'teachers.id', '=', 'mentor_conversations.mentor_id')->join('users', 'users.userable_id', '=', 'teachers.id')->where('mentee_id', Auth()->user()->userable->id)->where('users.userable_type','App\Models\Teacher');

        if($request->get('search_subject')!=null){
            $query->leftjoin('teacher_subjects', 'teacher_subjects.teacher_id', '=', 'teachers.id')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where('subjects.id', $request->get('search_subject'));
            $select_subject = Subject::findOrFail($request->get('search_subject'));
        }
         if($request->get('country')!=null){
            $query->where('users.country', 'like', $request->get('country').'%');
        }
         if($request->get('m_name')!=null){
            $query->where('users.name', 'like', $request->get('m_name').'%');
        }
         if($request->get('company')!=null){
            $query->leftjoin('experiences', 'experiences.teacher_id', '=', 'teachers.id')
            ->join('institutes', 'institutes.id', '=', 'experiences.institute_id')
            ->where('institutes.text', $request->get('company'));
        }
         if($request->get('city')!=null){
            $query->where('users.city', 'like', $request->get('city').'%');
        }
         if($request->get('search_industry')!=null){
            $query->where('industry', $request->get('search_industry'));

        }if($request->get('select_order') != null){
            if($request->get('select_order') == '1'){
                $query->orderBy('teachers.rating', 'DESC');
            }else{
                $query->orderBy('teachers.rating', 'ASC');
            }
        }
        else{
       // $query = $query->where('mentee_id', Auth()->user()->userable->id);
        //dd('');
        $query->orderBy('mentor_conversations.created_at', 'DESC');
        }

        $conversations= $query->paginate(20);

        // $conversations = MentorConversation::where('mentee_id', Auth()->user()->userable->id)->orderBy('created_at', 'DESC')->paginate(20);
        // dd($conversations);


        for ($i=0; $i < count($conversations); $i++) {
            $tutor_subjects = TeacherSubject::select('subjects.*')->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')->where('teacher_subjects.teacher_id', '=', $conversations[$i]['mentor_id'])->get();
            $tutor_subjects = json_decode($tutor_subjects, true);
            $conversations[$i]['subjects'] = $tutor_subjects;

            $tutor_convversation = MentorConversation::where('mentor_id', $conversations[$i]['mentor_id'])->where('mentee_id', Auth()->user()->userable->id)->first();
            $tutor_convversation = json_decode($tutor_convversation, true);
            $conversations[$i]['conversation'] = $tutor_convversation;
            $conversations[$i]['avg_time'] =rand(1,5);

        }

        $subjects = Subject::all();
        $industries = Industry::all();
        $institutes = Institute::all();

        return view('teacher.my_mentor', compact('conversations', 'request','subjects','industries','institutes','select_subject'));
    }

    public function rate_mentor(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->get('rating') != '') {
                $ratings = Rating::where('teacher_id', $request->get('teacher_id'))->where('user_id', Auth()->user()->id)->get();
                if (sizeof($ratings) > 0) {
                    $rating = $ratings->first();
                    $rating->rating = $request->get('rating');
                    $rating->save();
                } else {
                    $rating = new Rating();
                    $rating->rating = $request->get('rating');
                    $rating->teacher_id = $request->get('teacher_id');
                    $rating->user_id = Auth()->user()->id;
                    $rating->save();
                }
            }

            DB::commit();
            Toastr::success('Ratings Added successfully', 'Success');
            return redirect()->route('teacher.view_mentor', $request->get('teacher_id'));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Toastr::error($e->getMessage(), 'Success');
            return redirect()->back();
        }
    }


    public function complaint($id)
    {
        return view('teacher.complaint', compact('id'));
    }

    public function add_complaint(Request $request)
    {
        $complaints = new Complaint();
        $complaints->user_id = Auth()->user()->id;
        $complaints->mentor_id = $request->get('mentor_id');
        $complaints->description = $request->get('complaint');
        $complaints->seen = 0;
        $complaints->status =$request->get('status');
        $complaints->save();
        $id = $request->get('mentor_id');

        $teacher = Teacher::findOrFail($request->get('mentor_id'));
        Mail::to($teacher->user->email)->send(new MenteeComplaints($teacher->user->name."-".$complaints->status));

        $this->createNotification(4, 'Mentee has filed a complaint', route('admin.complaints'));
        $this->createNotification($teacher->user->id, 'Mentee has filed a complaint');

        Toastr::success('Complaint Added successfully', 'Success');
        return redirect()->route('teacher.view_mentor', compact('id'));
    }

    public function payment_history()
    {
        $user_orders = UserOrder::where('user_id', Auth()->user()->id)->get();
        return view('teacher.purchase_history', compact('user_orders'));
    }

    public function approve_request(Request $request)
    {
        DB::beginTransaction();
        try {
            $conversation = Conversation::findOrFail($request->get('conversation_id'));

            $message = new Message();
            $message->message = 'Approved Meeting Request';
            $message->sender_id = Auth()->user()->id;
            $message->conversation_id = $request->get('conversation_id');
            $message->seen = '1';
            $message->save();

            $userTransaction = UserTransaction::where('sender_id', $conversation->student->user->id)
                ->where('receiver_id', Auth()->user()->id)->where('status', 0)->first();
           if(!empty($userTransaction)){
                $userTransaction->status = 1;
                $userTransaction->save();

                $user = Auth()->user();
                $teacher = Teacher::findOrFail($user->userable->id);
                $teacher->amount = $teacher->amount + $userTransaction->amount;
                $teacher->save();
                $teacher->user()->save($user);
           }


            $this->createNotification($conversation->student->user->id, explode(' ', Auth()->user()->name)[0] . ' has Approve Your Request..!.', route('student.view_conversation', $conversation->id));

            $to = $conversation->student->user->email;
            $subject = "Approved The Meeting Request";
            $txt = "Hi, " . $conversation->teacher->user->name . "has Approve Your Request! Click Here : " . route('login') . " ";
            $headers = "From: info@you2mentor.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
            DB::commit();
            Toastr::success('Approve', 'Success');

            return  array(
                'error' => false,
                'flag' => true
            );
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            Toastr::error('Error', 'Error');
            return array(
                'error' => true,
                'flag' => false

            );
        }
    }

    public function cancel_request(Request $request)
    {
        DB::beginTransaction();
        try {
            $conversation = Conversation::findOrFail($request->get('conversation_id'));

            $message = new Message();
            $message->message = 'Canceled The Meeting Request';
            $message->sender_id = Auth()->user()->id;
            $message->conversation_id = $request->get('conversation_id');
            $message->seen = '1';
            $message->save();

            $userTransaction = UserTransaction::where('sender_id', $conversation->student->user->id)
                ->where('receiver_id', Auth()->user()->id)->where('status', 0)->first();
           if(!empty($userTransaction)){
                $userTransaction->delete();
                // $user = Auth()->user();
                // $user->userable->amount = $user->userable->amount + $userTransaction->amount;
                // $user->save();

                $student = User::findOrFail($conversation->student->user->id);
                $student->streaming_count = $student->streaming_count + 1;
                $student->save();
           }

            $this->createNotification($conversation->student->user->id, explode(' ', Auth()->user()->name)[0] . ' has Cancel Your Request..!.', route('student.view_conversation', $conversation->id));

            $to = $conversation->student->user->email;
            $subject = "Canceled The Meeting Request";
            $txt = "Hi, " . $conversation->teacher->user->name . "has Cancled Your Request..! Click Here : " . route('login') . " ";
            $headers = "From: info@you2mentor.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
            DB::commit();
            Toastr::success('Cancel', 'Success');

            return  array(
                'error' => false
            );
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            Toastr::error('Error', 'Error');
            return array(
                'error' => true
            );
        }
    }

    public function request_meeting(Request $request)
    {
        DB::beginTransaction();
        try {
            $conversation = MentorConversation::findOrFail($request->get('conversation_id'));
            $setting = Setting::first();

            $message = new MentorMessage();
            $message->message = 'Requesting a Booking (' . $request->get('start_time') . ')';
            $message->sender_id = Auth()->user()->userable->id;
            $message->conversation_id = $request->get('conversation_id');
            $message->seen = '1';
            $message->save();

            if($conversation->mentor->level>= $setting->paid_level){
                $userTransaction = new UserTransaction();
                $userTransaction->sender_id = Auth()->user()->id;
                $userTransaction->receiver_id = $conversation->mentor->user->id;
                $userTransaction->amount = $setting->streaming_amount;
                $userTransaction->notes = 'Requesting a Booking (' . $request->get('start_time') . ')';
                $userTransaction->save();

                $user = Auth()->user();
                $user->streaming_count = $user->streaming_count - 1;
                $user->save();

            }

            $this->createNotification($conversation->mentor->user->id, explode(' ', Auth()->user()->name)[0] . ' has Requested a Meeting..!.', route('teacher.view_mentor_conversation', $conversation->id));

            $to = $conversation->mentor->user->email;
            $subject = "Request a Booking";
            $txt = "Hi, " . $conversation->mentee->user->name . " Requesting a Meeting  with you. (" . $request->get('start_time') . ") Click Here : " . route('login') . " ";
            $headers = "From: info@you2mentor.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
            DB::commit();
            Toastr::success('Requested', 'Success');

            return  array(
                'error' => false
            );
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            Toastr::error('Error', 'Error');
            return array(
                'error' => true
            );
        }
    }
    public function cancel_meeting(Request $request)
    {
        DB::beginTransaction();
        try {
            $conversation = MentorConversation::findOrFail($request->get('conversation_id'));
            $setting = Setting::first();

            $message = new MentorMessage();
            $message->message = 'Canceled the Booking';
            $message->sender_id = Auth()->user()->userable->id;
            $message->conversation_id = $request->get('conversation_id');
            $message->seen = '1';
            $message->save();

           if($conversation->mentor->level>= $setting->paid_level){
                $userTransaction = UserTransaction::where('sender_id', Auth()->user()->id)
                    ->where('receiver_id', $conversation->mentor->user->id)->where('status', 0)->orderBy('created_at', 'desc')->first();
                $userTransaction->delete();

                $user = Auth()->user();
                $user->streaming_count = $user->streaming_count + 1;
                $user->save();
           }


            $this->createNotification($conversation->mentor->user->id, explode(' ', Auth()->user()->name)[0] . ' has Cancel a Meeting..!.', route('teacher.view_mentor_conversation', $conversation->id));

            $to = $conversation->mentor->user->email;
            $subject = "Canceled the Booking";
            $txt = "Hi, " . $conversation->mentee->user->name . " Canceled the Meeting request with you. Click Here : " . route('login') . " ";
            $headers = "From: info@you2mentor.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
            DB::commit();
            Toastr::success('Canceled', 'Success');

            return  array(
                'error' => false
            );
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            Toastr::error('Error', 'Error');
            return array(
                'error' => true
            );
        }
    }

    public function approve_mentor_request(Request $request)
    {
        DB::beginTransaction();
        try {
            $conversation = MentorConversation::findOrFail($request->get('conversation_id'));

            $message = new MentorMessage();
            $message->message = 'Approved Booking Request';
            $message->sender_id = Auth()->user()->userable->id;
            $message->conversation_id = $request->get('conversation_id');
            $message->seen = '1';
            $message->save();

            $userTransaction = UserTransaction::where('sender_id', $conversation->mentee->user->id)
                ->where('receiver_id', Auth()->user()->id)->where('status', 0)->first();
            if(!empty($userTransaction)){
                $userTransaction->status = 1;
                $userTransaction->save();

                $user = Auth()->user();
                $teacher = Teacher::findOrFail($user->userable->id);
                $teacher->amount = $teacher->amount + $userTransaction->amount;
                $teacher->save();
                $teacher->user()->save($user);
            }

            $this->createNotification($conversation->mentee->user->id, explode(' ', Auth()->user()->name)[0] . ' has Approve Your Request..!.', route('teacher.view_mentor_conversation', $conversation->id));

            $to = $conversation->mentee->user->email;
            $subject = "Approved Booking Request";
            $txt = "Hi, " . $conversation->mentor->user->name . "has Approved Your Booking Request! Click Here : " . route('login') . " ";
            $headers = "From: info@you2mentor.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
            DB::commit();
            Toastr::success('Approve', 'Success');

            return  array(
                'error' => false,
                'flag' => true
            );
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            Toastr::error('Error', 'Error');
            return array(
                'error' => true,
                'flag' => false

            );
        }
    }

    public function cancel_mentor_request(Request $request)
    {
        DB::beginTransaction();
        try {
            $conversation = MentorConversation::findOrFail($request->get('conversation_id'));

            $message = new MentorMessage();
            $message->message = 'Canceled The Booking Request';
            $message->sender_id = Auth()->user()->userable->id;
            $message->conversation_id = $request->get('conversation_id');
            $message->seen = '1';
            $message->save();

            $userTransaction = UserTransaction::where('sender_id', $conversation->mentee->user->id)
                ->where('receiver_id', Auth()->user()->id)->where('status', 0)->first();
            if(!empty($userTransaction)){
                $userTransaction->delete();
                // $user = Auth()->user();
                // $user->userable->amount = $user->userable->amount + $userTransaction->amount;
                // $user->save();
                $mentee = User::findOrFail($conversation->mentee->user->id);
                $mentee->streaming_count = $mentee->streaming_count + 1;
                $mentee->save();
            }

            $this->createNotification($conversation->mentee->user->id, explode(' ', Auth()->user()->name)[0] . ' has Cancel Your Request..!.', route('teacher.view_mentor_conversation', $conversation->id));

            $to = $conversation->mentee->user->email;
            $subject = "Canceled The Booking Request";
            $txt = "Hi, " . $conversation->mentor->user->name . "has Cancled Your Booking Request! Click Here : " . route('login') . " ";
            $headers = "From: info@you2mentor.com" . "\r\n";

            mail($to,$subject,$txt,$headers);
            DB::commit();
            Toastr::success('Cancel', 'Success');

            return  array(
                'error' => false
            );
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            Toastr::error('Error', 'Error');
            return array(
                'error' => true
            );
        }
    }

    public function request_payout(RequestPayoutRequest $request)
    {
        $userTransaction = new UserTransaction();
        $userTransaction->sender_id =  Auth()->user()->id;
        $userTransaction->receiver_id =  3;
        $userTransaction->amount = $request->get('payout_amount');
        $userTransaction->notes = "Payout Request : " . $request->get('paypal_email');
        $userTransaction->save();

        $this->createNotification(3, explode(' ', Auth()->user()->name)[0] . ' is  Request Payout!', route('admin.payout_requests'));

        // $to = $conversation->mentee->user->email;
        // $subject = "Cancel a Meeting";
        // $txt = "Hi, " . $conversation->mentor->user->name . "has Cancle Your Request..!.. Click Here : " . route('login') . " ";
        // $headers = "From: info@chamathkaara.com" . "\r\n";

        // mail($to,$subject,$txt,$headers);

        Toastr::success('Payout Request Sent Successfully', 'Success');
        return redirect()->route('teacher.payout_history');
    }

    public function create_payout()
    {
        $setting = Setting::first();
        $userTransaction = UserTransaction::where('sender_id', Auth()->user()->id)->where('receiver_id', 3)
            ->where('status', 0)->first();
        if (empty($userTransaction)) {
            return view('teacher.request_payout', compact('setting'));
        } else {
            Toastr::warning('Payout Request is Processing', 'Processing');
            return redirect()->route('teacher.payout_history');
        }
    }
    public function payout_history()
    {
        $setting = Setting::first();
        $userTransactions = UserTransaction::where('sender_id', Auth()->user()->id)->orderBy('updated_at', 'DESC')->paginate(20);
        return view('teacher.payout_history', compact('setting', 'userTransactions'));
    }
    public function show_payout($id)
    {
        $setting = Setting::first();
        $userTransaction = UserTransaction::findOrFail($id);
        return view('teacher.view_payout', compact('setting', 'userTransaction'));
    }

    public function get_topics(Request $request)
    {
        $subjects = Subject::where('name', 'like', '%' . $request->get('search') . '%')->get();
        $i = 0;
        $result = array();
        foreach ($subjects as $subject) {

            $result[$i] = array(
                'id' => $subject->id,
                'text' => $subject->name
            );
            $i++;
        }

        $returnData = array(
            'error' => false,
            'msg' => 'Success!',
            'results' => $result,
        );

        return json_encode($returnData);
    }

    public function get_industry(Request $request)
    {
        $industrys = Industry::where('name', 'like', '%' . $request->get('search') . '%')->get();
        $i = 0;
        $result = array();
        foreach ($industrys as $industry) {

            $result[$i] = array(
                'id' => $industry->id,
                'text' => $industry->name
            );
            $i++;
        }

        $returnData = array(
            'error' => false,
            'msg' => 'Success!',
            'results' => $result,
        );

        return json_encode($returnData);
    }

    public function view_purchase_package($id)
    {
        $user_order = UserOrder::findOrFail($id);
        return view('teacher.view_purchase_package', compact('user_order'));
    }
}
