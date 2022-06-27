<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;

class VerifyEmailController extends Controller
{
    protected function create_verify(RegisterRequest $request){
        $code = rand(100000,500000);
        $en_code = sha1($code);
        $email = $request->get('email');
        $name = $request->get('name');
        $password = $request->get('password');
        $type = $request->get('type');

        $user_mail = $request->get('email');
        // $subject = "Verify Email";
        // $txt = "Welcome to You2Mentor.

        // To verify your email, please use the code below.

        // ".$code."

        // Please note, this link expires in 28 days


        // Need help? (Link to contact us page)
        // If you didn't register an account with us, please ignore this email";

        // $headers = "From: info@you2mentor.com" . "\r\n";

        // mail($to,$subject,$txt,$headers);

        Mail::to($user_mail)->send(new VerifyMail($code));

        return view('student.verify_mentee_email',compact('email','en_code','name','password','type'));
    }
    protected function verify(Request $request){
        $email = $request->get('email');
        $name = $request->get('name');
        $type = $request->get('type');
        $password = bcrypt($request->get('password'));
        $en_code = $request->get('encripted_code');

      if(sha1($request->get('veri_code')) == $en_code){


            return view('auth.verifi_register',compact('email','name','password','type'));

        }else{
            Toastr::error('Invalid Code', 'Error');
            return view('student.verify_mentee_email',compact('email','en_code','name','password','type'));
        }
    }


    protected function register(Request $request)
    {
        //dd('test');

        $user = null;
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' =>  $request->get('email'),
                'password'=> $request->get('password')
            ]);

            if ($request->get('type') == 'student') {
                $student = new Student();
                $student->save();
                $student->user()->save($user);


                $to = $request->get('email');
                $subject = "You2Mentor";
                $txt = "Welcome to You2Mentor..!";
                $headers = "From: info@chamathkaara.com" . "\r\n";

                mail($to,$subject,$txt,$headers);

                 $user->userable_id = $student->id;
                $user->userable_type = Student::class;
            } else if ($request->get('type') == 'teacher') {
                $teacher = new Teacher();
                $teacher->save();

                $teacher->user()->save($user);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

         return redirect()->route('login');
    }

}
