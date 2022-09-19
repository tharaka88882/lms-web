<?php



namespace App\Http\Controllers;



use App\Http\Requests\AddStudentRequest;

use App\Http\Requests\UpdateProfileRequest;

use App\Http\Requests\UpdateStudentRequest;

use App\Models\Complaint;

use App\Models\Conversation;
use App\Models\Industry;
use App\Models\Message;

use App\Models\Rating;
use App\Models\Institute;

use App\Models\Schedule;

use App\Models\Setting;

use App\Models\Student;

use App\Models\Subject;
use App\Models\RatingView;

use App\Models\Teacher;

use App\Models\TeacherSubject;

//use App\Models\Teacher;

use App\Models\User;

use App\Models\UserOrder;

use App\Models\UserTransaction;

use App\Traits\UserTrait;

use Brian2694\Toastr\Facades\Toastr;

use DateTime;

use Exception;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

use League\CommonMark\Converter;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Mail;
use App\Mail\MenteeComplaints;

class StudentController extends Controller

{

    use UserTrait;

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $students = Student::paginate(10);
        // $students = Student::get();

        $new_array = array();
        $y = 0;

    foreach ($students as $student){

        $new_array[$y] = array(
            'student_id' =>$student->id,
             'student_name' =>$student->user->name??  null ,
             'student_email' =>$student->user->email??  null ,
            'student_grade' =>$student->grade,
            'student_status' =>$student->status
);
        $y++;
}
        //dd($new_array);

        return view('admin.students_list', compact('students','new_array'));

    }

    // public function addStudents()

    // {

    //     //$students = Student::all();

    //   return view('admin.add_student');

    // }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('admin.add_student');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(AddStudentRequest $request)

    {

        $user = null;

        DB::beginTransaction();

        try {

            $user = User::create([

                'name' => $request->get('name'),

                'email' =>  $request->get('email'),

                'password' => bcrypt($request->get('password')),

            ]);



            $student = new Student();

            $student->grade = $request->get('grade');

            $student->save();



            $student->user()->save($user);



            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            return $e->getMessage();

        }



        return redirect()->route('admin.add_students');

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

        $user = Student::findOrFail($id);





        return view('admin.edit_student', compact('user', 'id'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(UpdateStudentRequest $request, $id)

    {

        //dd($id);



        $student = Student::findOrFail($id);

        $student->user->name = $request->get('name');

        $student->grade = $request->get('grade');

        if (!empty($request->get('password'))) {

            $student->user->password = $request->get('password');

        }

        if ($request->get('status') == 'on') {

            $student->status = true;

        } else {

            $student->status = false;

        }

        $student->save();

        $student->user->save();



        return redirect()->route('admin.edit_student', $id);

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $student = Student::findOrFail($id);

        $student->delete();



        return redirect()->route('admin.students');

    }



    public function tutors(Request $request)

    {
        $query = null;
        $select_subject = null;
        $query = Teacher::query();
        $query = $query->select('teachers.*')->join('users','users.userable_id','=','teachers.id')->where('users.userable_type','App\Models\Teacher');

        if ($request->get('search_industry') !=null) {
            $query->where('teachers.industry', $request->get('search_industry'));
        }
        if ($request->get('program') !=null) {
            $query->where('users.program', 'like', $request->get('program').'%');
        }
         if ($request->get('m_name')!=null) {
           // dd($request->get('m_name'));

            $query->where('users.name', 'like', $request->get('m_name').'%');

        }
         if ($request->get('company')!=null) {
            $query->leftjoin('experiences', 'experiences.teacher_id', '=', 'teachers.id')
            ->join('institutes', 'institutes.id', '=', 'experiences.institute_id')
            ->where('institutes.text', $request->get('company'));

        } if ($request->get('search_subject') != null) {
            $query->leftjoin('teacher_subjects', 'teacher_subjects.teacher_id', '=', 'teachers.id')
                    ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
                    ->where('subjects.id', $request->get('search_subject'));
                     $select_subject = Subject::findOrFail($request->get('search_subject'));
        } if ($request->get('city') !=null) {

            $query->where('users.city', 'like', $request->get('city').'%');

        } if ($request->get('country') != null) {


            $query->where('users.country', 'like', $request->get('country').'%');

        }if($request->get('select_order') != null){
            if($request->get('select_order') == '1'){
                $query->orderBy('rating', 'DESC');
            }else{
                $query->orderBy('rating', 'ASC');
            }
        }
         else {

            $query->orderBy('rating', 'DESC');

        }


        $tutors = $query->get();

        for ($i=0; $i < count($tutors); $i++) {
            $tutor_subjects = TeacherSubject::select('subjects.*')->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')->where('teacher_subjects.teacher_id', '=', $tutors[$i]['id'])->get();
            $tutor_subjects = json_decode($tutor_subjects, true);
            $tutors[$i]['subjects'] = $tutor_subjects;

            $tutor_convversation = Conversation::where('teacher_id', $tutors[$i]['id'])->where('student_id', Auth()->user()->userable->id)->first();
            $tutor_convversation = json_decode($tutor_convversation, true);
            $tutors[$i]['conversation'] = $tutor_convversation;
            $tutors[$i]['avg_time'] =rand(1,5);
        }


        $subjects = Subject::all();
        $industries = Industry::all();
        $institutes = Institute::all();

        //$avg_time = round(1,5);

        return view('student.tutors', compact('tutors', 'subjects', 'industries', 'request','institutes','select_subject'));

    }





    public function view_tutor(Request $request, $id) {
        // dd($request);

        $teacher = Teacher::findOrFail($id);

        $schedules = Schedule::where('teacher_id', $id)->get();

        //$ava_conversations = Conversation::where('teacher_id',$teacher->id)->skip(0)->take(5)->last();

        $ava_conversations = DB::table('conversations')->select('messages.created_at', 'messages.sender_id')->join('messages', 'messages.conversation_id', '=', 'conversations.id')

            ->where(['teacher_id' =>$id, 'student_id' => 1])->skip(0)->take(5)->get();

        //dd($ava_conversations);

       // $time_total_array =explode(",",$id)[1];

        $query = Conversation::where('teacher_id', $id)->where('student_id', Auth()->user()->userable->id)->first();

        // dd($query);

        $conversations = array();


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
      // dd($mediation);

        if ($query != null) {
            $conversations = Message::where('conversation_id', $query->id)->where('sender_id', $teacher->user->id)->get();
        }

        // dd($teacher->user->id);

       // $rating = Rating::where('teacher_id',  $id)->where('user_id', Auth()->user()->id)->get();


        $subjects = TeacherSubject::select('name')
            ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
            ->where('teacher_subjects.teacher_id', $id)
            ->get();

        //return $rating;

        $old_ratings = Rating::where('teacher_id',$id)->where('user_id',Auth()->user()->id)->get();

        return view('student.view_teacher', compact('request', 'teacher', 'conversations', 'mediation', 'schedules', 'query', 'subjects','old_ratings'));
    }



    public function chat(Request $request, $id)

    {

        $setting = Setting::first();

        $conversation = Conversation::findOrFail($id);

        $teacher = Teacher::findOrFail($conversation->teacher_id);
        $teacherSubs = TeacherSubject::select('*')->join('subjects','teacher_subjects.subject_id','=','subjects.id')->where('teacher_id', $conversation->teacher_id)->get();
        $userTransaction = UserTransaction::where('sender_id', Auth()->user()->id)->where('receiver_id', $conversation->teacher->user->id)->where('status', 0)->first();

       // $conversations = Conversation::where('student_id', Auth()->user()->userable->id)->where('teacher_id',$conversation->teacher_id)->first();

       $rating_view =null;
       $rating_view = RatingView::where('r_count','<=',6)->where('status',0)->where('user_id',Auth()->user()->id)->first();
       if($rating_view == null){
           $rating_view = RatingView::where('r_count',6)->where('status',0)->where('user_id',Auth()->user()->id)->first();
       }

       $conversations = Conversation::where('student_id', Auth()->user()->userable->id)->orderBy('created_at', 'DESC')->latest()->take(1000)->get();
       $flag = false;
       foreach($conversations as $conver){
        $rating = Rating::where('teacher_id', $conver->teacher_id)->where('user_id', Auth()->user()->id)->first();
        $metor_reply_count = 0;
        if($rating == null){
            $m_messages =  Message::where('conversation_id',$conver->id)->get();
            foreach($m_messages as $m_message){
               if($m_message->sender_id != Auth()->user()->id){
                   $metor_reply_count++;
               }
            }
        }

        if($metor_reply_count>=3){
            //dd('in');
            $flag = false;

           // dd('in');
            if($rating_view == null){
                $rating_view = new RatingView();
                $rating_view->r_count = 1;
                $rating_view->status = 0;
                $rating_view->mentor_id = $m_message->sender_id;
                $rating_view->user_id =Auth()->user()->id;
                $rating_view->save();
                return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting','teacherSubs','rating_view'));            }else{
               // dd('in');
            if($rating_view->r_count<6){
                $rating_view->r_count = $rating_view->r_count +1;
                $rating_view->save();
                return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting','teacherSubs','rating_view'));            }else{
          if($rating_view->status == 0){
            Toastr::warning("Please rate mentor (" . $rating_view->mentor->user->name . ")", 'Attention');
            return redirect()->route('student.view_tutor',$rating_view->mentor->id);
          }
            }
            }
            break;
         }else{
            $flag = true;
         }

       }
       if($flag){
        return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting','teacherSubs','rating_view'));
    }

       //-------------------------------------------------------------------------------------------------------------------------------

        // $conversations = Conversation::select('messages.sender_id')->join('messages', 'messages.conversation_id', '=', 'conversations.id')
        //     ->where('conversations.student_id', Auth()->user()->userable->id)->get();

        //     $conver_count =Conversation::select('messages.sender_id')->join('messages', 'messages.conversation_id', '=', 'conversations.id')
        //     ->where('conversations.student_id', Auth()->user()->userable->id)->count();
        //     $flag = false;
        //     $looping_count =0;
        //     foreach($conversations as $conver){
        //         $looping_count ++;
        //         if($conver->sender_id != Auth()->user()->id){
        //             $flag = false;
        //             $user = User::findOrFail($conver->sender_id);
        //             $rating = Rating::where('teacher_id',$user->userable_id)->where('user_id', Auth()->user()->id)->first();

        //             if($rating == null){
        //                 if($rating_view == null){
        //                     $rating_view = new RatingView();
        //                     $rating_view->r_count = 1;
        //                     $rating_view->status = 0;
        //                     $rating_view->mentor_id = $user->userable_id;
        //                     $rating_view->user_id =Auth()->user()->id;
        //                     $rating_view->save();
        //                     return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting','teacherSubs','rating_view'));
        //                 }else{
        //                 if($rating_view->r_count<6){
        //                     $rating_view->r_count = $rating_view->r_count +1;
        //                     $rating_view->save();
        //                     return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting','teacherSubs','rating_view'));
        //                 }else{
        //               if($rating_view->status == 0){
        //                 Toastr::warning("Please rate mentor (" . $rating_view->mentor->user->name . ")", 'Attention');
        //                 return redirect()->route('student.view_tutor',$rating_view->mentor->id);
        //               }
        //                 }
        //                 }
        //             }else{
        //                 $flag = true;
        //             }
        //         }else{
        //             $flag = true;
        //         }
        //     }

        //     if($flag && $looping_count == $conver_count){
        //         return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting','teacherSubs','rating_view'));
        //     }

    }



    public function rate_teacher(Request $request)

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

            return redirect()->route('student.view_tutor', $request->get('teacher_id'));

        } catch (Exception $e) {

            DB::rollBack();

            Log::error($e->getMessage());

            Toastr::error($e->getMessage(), 'Error');

            return redirect()->back();

        }

    }

    public function conversations(Request $request)

    {
        $select_subject = null;
        $query =  Conversation::query();
        $query = $query->select('conversations.*')->join('teachers', 'teachers.id', '=', 'conversations.teacher_id')->join('users', 'users.userable_id', '=', 'teachers.id')->where('student_id', Auth()->user()->userable->id)->where('users.userable_type','App\Models\Teacher');

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
            $query->where('users.company', 'like', $request->get('company').'%');
        }
         if($request->get('city')!=null){
            $query->where('users.city', 'like', $request->get('city').'%');
        }
         if($request->get('search_industry')!= null){
            $query->where('teachers.industry', $request->get('search_industry'));

        }
         if($request->get('program')!= null){
            $query->where('users.program','like', $request->get('program').'%');

        }
        if($request->get('select_order') != null){
            if($request->get('select_order') == '1'){
                $query->orderBy('teachers.rating', 'DESC');
            }else{
                $query->orderBy('teachers.rating', 'ASC');
            }
        }
        else{
            $query->orderBy('conversations.created_at', 'DESC');
        }

        $conversations= $query->paginate(20);

        for ($i=0; $i < count($conversations); $i++) {
            $tutor_subjects = TeacherSubject::select('subjects.*')->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')->where('teacher_subjects.teacher_id', '=', $conversations[$i]['teacher_id'])->get();
            $tutor_subjects = json_decode($tutor_subjects, true);
            $conversations[$i]['subjects'] = $tutor_subjects;

            $tutor_convversation = Conversation::where('teacher_id', $conversations[$i]['teacher_id'])->where('student_id', Auth()->user()->userable->id)->first();
            $tutor_convversation = json_decode($tutor_convversation, true);
            $conversations[$i]['conversation'] = $tutor_convversation;
            $conversations[$i]['avg_time'] =rand(1,5);

        }

        $subjects = Subject::all();
        $industries = Industry::all();
        $institutes = Institute::all();

        return view('student.my_teachers', compact('conversations','request','subjects','industries','institutes','select_subject'));

    }

    public function complaint($id)

    {

        return view('student.complaint', compact('id'));

    }

    public function add_complaint(Request $request)
    {





        try {

            $complaints = new Complaint();

            $complaints->user_id = Auth()->user()->id;

            $complaints->mentor_id = $request->get('mentor_id');

            $complaints->description = $request->get('complaint');

            $complaints->seen = 0;
            $complaints->status =$request->get('status');

            $complaints->save();

            $id = $request->get('mentor_id');
            $teacher = Teacher::findOrFail($id);

            Toastr::success('Complaint Added successfully', 'Success');

            //$mentorEmail = Teacher::findOrFail($id)->email;
            // To do email send code hear....
            Mail::to($teacher->user->email)->send(new MenteeComplaints($teacher->user->name."-".$complaints->status));

            $this->createNotification(4, 'Mentee has filed a complaint', route('admin.complaints'));
            $this->createNotification($teacher->user->id, 'Mentee has filed a complaint');

            return redirect()->route('student.view_tutor', compact('id'));

        } catch (Exception $e) {

            return $e->getMessage();

        }

    }



    public function payment_history()

    {

        $user_orders = UserOrder::where('user_id', Auth()->user()->id)->get();

        return view('student.purchase_history', compact('user_orders'));

    }



    public function request_meeting(Request $request)

    {

        DB::beginTransaction();

        try {

            $conversation = Conversation::findOrFail($request->get('conversation_id'));

            $setting = Setting::first();



            $message = new Message();

            $message->message = 'Requesting a Booking ('.$request->get('start_time').')';

            $message->sender_id = Auth()->user()->id;

            $message->conversation_id = $request->get('conversation_id');

            $message->seen = '1';

            $message->save();



            if ($conversation->teacher->level>= $setting->paid_level){

                $userTransaction = new UserTransaction();

                $userTransaction->sender_id = Auth()->user()->id;

                $userTransaction->receiver_id = $conversation->teacher->user->id;

                $userTransaction->amount = $setting->streaming_amount;

                $userTransaction->notes = 'Requesting a Booking (' . $request->get('start_time') . ')';

                $userTransaction->save();



                $user = Auth()->user();

                $user->streaming_count = $user->streaming_count - 1;

                $user->save();

            }



            $this->createNotification($conversation->teacher->user->id, explode(' ', Auth()->user()->name)[0] . ' has Requested a Meeting..!.', route('teacher.view_conversation', $conversation->id));



            $to = $conversation->teacher->user->email;

            $subject = "Requesting a Booking";

            $txt = "Hi, " . $conversation->student->user->name . " Requesting a Meeting  with you.(". $request->get('start_time').")  Click Here : " . route('login') . " ";

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

            $conversation = Conversation::findOrFail($request->get('conversation_id'));

            $setting = Setting::first();



            $message = new Message();

            $message->message = 'Canceled the Booking Request';

            $message->sender_id = Auth()->user()->id;

            $message->conversation_id = $request->get('conversation_id');

            $message->seen = '1';

            $message->save();



            if($conversation->teacher->level >= $setting->paid_level){

                $userTransaction = UserTransaction::where('sender_id', Auth()->user()->id)

                    ->where('receiver_id', $conversation->teacher->user->id)->where('status', 0)->orderBy('created_at', 'desc')->first();

                $userTransaction->delete();



                $user = Auth()->user();

                $user->streaming_count = $user->streaming_count + 1;

                $user->save();



            }



            $this->createNotification($conversation->teacher->user->id, explode(' ', Auth()->user()->name)[0] . ' has Cancel a Meeting..!.', route('teacher.view_conversation', $conversation->id));



            $to = $conversation->teacher->user->email;

            $subject = "Canceled the Booking";

            $txt = "Hi, " . $conversation->student->user->name . " Canceled the Booking request with you. Click Here : " . route('login') . " ";

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



    public function view_purchase_package($id){

        $user_order= UserOrder::findOrFail($id);

        return view('student.view_purchase_packege',compact('user_order'));

    }

}

