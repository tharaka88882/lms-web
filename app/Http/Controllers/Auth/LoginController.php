<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Providers\RouteServiceProvider;
use App\Traits\UserTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MentorConversation;
use App\Models\MentorMessage;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use UserTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function index(){
    //     return view('login');
    // }

    // public function getLogout() {

    //     $rememberMeCookie = Auth::getRecallerName();
    //     // Tell Laravel to forget this cookie
    //     $cookie = Cookie::forget($rememberMeCookie);

    //     return Redirect::to('/')->withCookie($cookie);
    // }

    protected function authenticated(Request $request)
    {
        $user =  Auth::user();
        // // return get_class($user);
       // dd($request->get('remember'));

        if($request->get('remember')==null){
            setcookie('login_email',$request->email,100);
            setcookie('login_pass',$request->password,100);
         }
         else{
            setcookie('login_email',$request->email,time()+60*60*24*100);
            setcookie('login_pass',$request->password,time()+60*60*24*100);

         }

        // $pending_count = Teacher::where('status', '=', '0')->count();
        // //$teachers_count = $teachers->count();
        // //dd($pending_count);
        // $teachers_count = Teacher::all()->count();
        // $students_count = Student::where('status', '=', '1')->count();
        // $subject_count = Subject::Where('status', '=', '1')->count();

        // $pending_teachers_list =  Teacher::where('status', 0)->get();

        // if (get_class($user->userable) == 'App\Models\Teacher') {
        //     return view('home_teacher', compact('pending_count', 'teachers_count', 'students_count', 'subject_count', 'pending_teachers_list'));
        // } else if (get_class($user->userable) == 'App\Models\Student') {
        //     return view('home_student', compact('pending_count', 'teachers_count', 'students_count', 'subject_count', 'pending_teachers_list'));
        // } else if (get_class($user->userable) == 'App\Models\Admin') {
        //     return view('home', compact('pending_count', 'teachers_count', 'students_count', 'subject_count', 'pending_teachers_list'));
        // }

        //  $this->createNotification(Auth()->user()->id, 'Hello this is a test notification message');

        $conversations = MentorConversation::where('mentor_id',Auth()->user()->userable_id)->latest()->take(10)->orderBy('created_at', 'DESC')->get();
                $avg_times_array = array();
                 $i = 0;
                // dd($conversations);
                foreach($conversations as $conver){
                 $my_response_time = null;
                 $other_response_time = null;
                 $mentor_messages =  MentorMessage::where('conversation_id',$conver->id)->orderBy('created_at', 'DESC')->get();
                 foreach($mentor_messages as $message){
                   //  dd($mentor_messages);
                     if($message->sender_id == Auth()->user()->userable_id){
                         $my_response_time = $message->created_at;
                     }else{
                         $other_response_time = $message->created_at;
                     }
                 }
                // dd($my_response_time."-".$other_response_time);
                 if($my_response_time !=null && $other_response_time !=null){
                     $response_time = null;
                    $time1 =  Carbon::createFromDate($my_response_time);
                    $time2 =  Carbon::createFromDate($other_response_time);
                    $response_time = $time1->diffInHours($time2);
                   // dd($time1);
                     $avg_times_array[$i] = array(
                         'response_time' => $response_time
                     );
                     $i++;
                 }

                }

              //  dd($avg_times_array);
                $real_avg = 0;
                if(sizeof($avg_times_array)>0){
                if(sizeof($avg_times_array) == 1){
                    if($avg_times_array[0]['response_time'] > 0){
                        $real_avg = $avg_times_array[0]['response_time'];
                       }else{
                        $real_avg = 1;
                       }
                }else{
                 $arr_size = sizeof($avg_times_array);
                 $arr_value_total = 0;
                 foreach($avg_times_array as $value){
                     $arr_value_total += $value['response_time'];
                 }
                 $real_avg = (int)($arr_value_total / $arr_size);
                }
                }

                if( $real_avg == 0){
                    $real_avg = 0;
                   }

        Auth()->user()->avg = $real_avg;
        Auth()->user()->save();



             if( Auth()->user()->userable_type == 'App\Models\Admin'){
                return redirect('user/dashboard');
             }else{
                $empty_profile = true;
                if(sizeof(Auth()->user()->userable->experiences)>0){
                    $empty_profile = false;
                } elseif(sizeof(Auth()->user()->userable->qualifications)>0){
                    $empty_profile = false;
                }
                if($empty_profile == false){
                    return redirect('user/dashboard');
                }else{
                    return redirect()->route('user.profile_1');
                }
             }
    }

    public function logout(Request $request) {
       // dd('rr');

        \Cookie::forget('login_email');
        \Cookie::forget('login_pass');
        Auth::logout();
        // setcookie('login_email','',100);
        // setcookie('login_pass','',100);
        return redirect('/login');
      }
}
