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
    protected function authenticated(Request $request)
    {
        $user =  Auth::user();
        // // return get_class($user);

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

        return redirect()->route('dashboard');
    }
}
