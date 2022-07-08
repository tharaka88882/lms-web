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

        if(Auth()->user()->first_login==1){
            return redirect()->route('dashboard');
        }else{
            Auth()->user()->first_login = 1;
            Auth()->user()->save();
            return redirect()->route('user.profile');
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
