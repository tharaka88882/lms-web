<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');


        // $user =  Auth::user();
        // // return get_class($user);
        // if (get_class($user->userable) == 'App\Models\Teacher') {
        //     return view('home_teacher');
        // } else if (get_class($user->userable) == 'App\Models\Student') {
        //     return view('home_student');
        // } else if (get_class($user->userable) == 'App\Models\Admin') {
        //     return view('home');
        // }
    }
}
