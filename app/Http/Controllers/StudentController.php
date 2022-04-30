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

use App\Models\Schedule;

use App\Models\Setting;

use App\Models\Student;

use App\Models\Subject;

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

        return view('admin.students_list', compact('students'));

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

        $query = Teacher::query();

        if ($request->get('search_industry') != 'Any' && $request->get('search_industry')) {
            $query->where('industry', $request->get('search_industry'));
        }
        else if ($request->get('search_subject') != 'Any' && $request->get('search_subject')) {
            $query->select('teachers.*')
                    ->leftjoin('teacher_subjects', 'teacher_subjects.teacher_id', '=', 'teachers.id')
                    ->join('subjects', 'subjects.id', '=', 'teacher_subjects.subject_id')
                    ->where('subjects.id', $request->get('search_subject'));
        } else if ($request->get('city')) {

            // dd('test2');

            // dd($request->get('city'));

            $query->select('teachers.*')->join('users', 'users.userable_id', '=', 'teachers.id')->where('users.city', 'like', $request->get('city'))->where('status', 1);

        } else if ($request->get('country') != null) {

            // dd('test3');

            // dd($request->get('country'));

            $query->select('teachers.*')->join('users', 'users.userable_id', '=', 'teachers.id')->where('users.country', 'like', $request->get('country'))->where('status', 1);

        } else {

            //dd('test4');

            $query = Teacher::where('status', 1);

        }


        $tutors = $query->get();

        for ($i=0; $i < count($tutors); $i++) {
            $tutor_subjects = TeacherSubject::select('subjects.*')->join('subjects', 'teacher_subjects.subject_id', '=', 'subjects.id')->where('teacher_subjects.teacher_id', '=', $tutors[$i]['id'])->get();
            $tutor_subjects = json_decode($tutor_subjects, true);
            $tutors[$i]['subjects'] = $tutor_subjects;

            $tutor_convversation = Conversation::where('teacher_id', $tutors[$i]['id'])->where('student_id', Auth()->user()->userable->id)->first();
            $tutor_convversation = json_decode($tutor_convversation, true);
            $tutors[$i]['conversation'] = $tutor_convversation;
        }


        $subjects = Subject::all();
        $industries = Industry::all();

        return view('student.tutors', compact('tutors', 'subjects', 'industries', 'request'));

    }





    public function view_tutor(Request $request, $id) {
        // dd($request);

        $teacher = Teacher::findOrFail($id);

        $schedules = Schedule::where('teacher_id', $id)->get();

        //$ava_conversations = Conversation::where('teacher_id',$teacher->id)->skip(0)->take(5)->last();

        $ava_conversations = DB::table('conversations')->select('messages.created_at', 'messages.sender_id')->join('messages', 'messages.conversation_id', '=', 'conversations.id')

            ->where(['teacher_id' => $id, 'student_id' => 1])->skip(0)->take(5)->get();

        //dd($ava_conversations);

        $time_total_array = rand(1, 5);

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

        return view('student.view_teacher', compact('request', 'teacher', 'conversations', 'mediation', 'schedules', 'query', 'subjects', 'time_total_array','old_ratings'));
    }



    public function chat(Request $request, $id)

    {

        $setting = Setting::first();

        $conversation = Conversation::findOrFail($id);

        $teacher = Teacher::findOrFail($conversation->teacher_id);

        $userTransaction = UserTransaction::where('sender_id', Auth()->user()->id)->where('receiver_id', $conversation->teacher->user->id)->where('status', 0)->first();

        $conversations = Conversation::select('messages.sender_id')->join('messages', 'messages.conversation_id', '=', 'conversations.id')

            ->where('conversations.student_id', Auth()->user()->userable->id)->get();

        //dd();

        $flag = false;

        foreach ($conversations as $conver) {

            if ($conver->sender_id != Auth()->user()->id) {

                // dd('tt');

                $user = User::findOrFail($conver->sender_id);

                // dd($user);

                if ($user->userable_type == 'App\Models\Teacher') {

                    $flag = false;

                    $rating =  Rating::where('teacher_id', $user->userable->id)->where('user_id', Auth()->user()->id)->get();

                    // dd(sizeof($rating));

                    if (sizeof($rating) > 0) {

                        return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting'));

                    } else {

                        Toastr::warning("Please rate Mentor..! (" . $user->name . ")", 'Warning');

                        return redirect()->route('student.view_tutor', $user->userable->id);

                    }

                }

            } else {

                $flag = true;

                //    if(sizeof($conversations)<2){

                //     return view('student.chat', compact('request', 'id', 'conversation'));

                //    }

                //dd(sizeof($conver));

            }

        }

        if ($flag) {

            return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting'));

        } elseif (sizeof($conversations) == 0) {

            return view('student.chat', compact('request', 'id', 'conversation', 'userTransaction', 'teacher', 'setting'));

        }

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

            Toastr::success('Ratings Added successfully :)', 'Success');

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

        $conversations = Conversation::where('student_id', Auth()->user()->userable->id)->orderBy('created_at', 'DESC')->paginate(20);

        $subjects = Subject::all();
        $industries = Industry::all();

        return view('student.my_teachers', compact('conversations','request','subjects','industries'));

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

            $complaints->save();

            $id = $request->get('mentor_id');

            Toastr::success('Complaint Added successfully :)', 'Success');

            $this->createNotification('3', 'Mentee has filed a complaint', route('admin.complaints'));

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

            Toastr::success('Requested :)', 'Success');



            return  array(

                'error' => false

            );

        } catch (Exception $e) {

            DB::rollBack();

            // dd($e);

            Toastr::error('Error :(', 'Error');

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

            Toastr::success('Canceled :)', 'Success');



            return  array(

                'error' => false

            );

        } catch (Exception $e) {

            DB::rollBack();

            // dd($e);

            Toastr::error('Error :(', 'Error');

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

