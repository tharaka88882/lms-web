<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMentorMail;
use App\Mail\WelcomeMail;

class RegisterController extends Controller
{
    public function user_registration(Request $request)
    {
        //return $request;
        $user = null;
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' =>  $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);

            if ($request->get('type') == 'student') {
                $student = new Student();
                $student->status = true;
                $student->save();

                $student->user()->save($user);

                // $user->userable_id = $student->id;
                // $user->userable_type = Student::class;
            } else if ($request->get('type') == 'teacher') {
                $teacher = new Teacher();
                $teacher->status = true;
                $teacher->save();
                $teacher->user()->save($user);

                $to = $user->email;
                // $subject = "Teacher Registerd";
                // $txt = "".$user->name." Registered as a Mentor. Please approve mentor  <a = \"".route('admin.teachers')."\">".route('admin.teachers')."</a> ";
                // $headers = "From: info@you2mentor.com" . "\r\n";

                // mail($to,$subject,$txt,$headers);

                Mail::to($to)->send(new WelcomeMentorMail());
            }

            // $to2 = $user->email;
            // $subject2 = "Welcome to You2Mentor";
            // $txt2 = "Hi, ".$user->name." welcome to You2Mentor.com. Thank you";
            // $headers2 = "From: info@you2mentor.com" . "\r\n";

            // mail($to2,$subject2,$txt2,$headers2);

            $username = $user->name;
            $user_mail = $user->email;
            Mail::to($user_mail)->send(new WelcomeMail($username));
//d
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        return $user;
    }

    protected function authenticated(Request $request)
    {
        if(Auth()->user()->first_login==1){
            return redirect()->route('dashboard');
        }else{
            Auth()->user()->first_login = 1;
            Auth()->user()->save();
            return redirect()->route('user.profile_1');
        }
    }
}
