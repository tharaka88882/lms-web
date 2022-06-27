<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Student;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use FFI\Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $student = Student::findOrFail($request->get('teacher_id'));
        // $to = $teacher->user->email;
        // $subject = "Welcome to You2Mentor";
        // $txt = "Hi, ".$teacher->user->name." Mentee has started conversation with you. <a = \"".route('teacher.view_conversation',$conversation->id)."\">".route('teacher.view_conversation',$conversation->id)."</a> ";
        // $headers = "From: info@chamathkaara.com" . "\r\n";

        // mail($to,$subject,$txt,$headers);



        return view('auth.find-account');
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


    public function verify(Request $request)
    {

        $query = Student::query();

        if ($request->get('email')) {
            $query->whereHas('user', function (Builder $query) use ($request) {
                return $query->where('email', $request->get('email'));
            });
        }
        $student = $query->get();
         //return  dd($user);
        try{

         if(!empty($student[0])){
            $code = rand(1000, 99999);


        $user_mail = $request->get('email');
        // $subject = "You2Mentor Verification Code";
        // $txt = "Hi,  Your Code is :- ".$code;
        // $headers = "From: info@you2mentor.com" . "\r\n";

        // mail($to,$subject,$txt,$headers);
        Mail::to($user_mail)->send(new VerifyMail($code));

           // dd($student);
         // Toastr::success("Can't Find Your Account  :(", "Can't Find");
        //  $data=  array(
        //      'code'=>sha1($code),
        //      'email'=>$request->get('email')
        //  );
         return Redirect()->route('auth.verify_view',sha1($code)."-".$request->get('email'));
         }else{
            Toastr::error("Can't Find Your Account", "Can't Find");
            return Redirect()->route('auth.find_account');
         }
        }catch(Exception $ex){
            Toastr::error($ex->getMessage(), 'Danger');
            return redirect()->back();
        }

    }

    public function verify_view($code){
       // dd($code);
       // dd(explode('-',$code)[0]);
        //dd(explode('-',$code)[1]);
        $en_code =explode('-',$code)[0];
        $email = explode('-',$code)[1];
        return view('auth.verify-code',compact('en_code','email'));
    }
    public function verify_code(Request $request){
        //dd($code);
        if($request->get('encrited_code')==sha1($request->get('veri_code'))){
            return redirect()->route('auth.edit_pass',$request->get('email'));
        }else{
            Toastr::error("Invalid Code", "Invalid");
            return Redirect()->route('auth.verify_view',$request->get('encrited_code')."-".$request->get('email'));
        }

    }

    public function edit_password($email){
        return view('auth.edit-password',compact('email'));
    }

    public function update_password(UpdatePasswordRequest $request,$email){
       $user = User::where('email',$email)->first();
      // dd($user);
       if($user!=null){
        $user->password = bcrypt($request->get('password'));
        $user->save();
        Toastr::success('Password Reset Successfull', 'Success');
        return Redirect()->route('login');
       }else{
        Toastr::error('Error :)', 'Error');
        return redirect()->route('auth.edit_pass',$email);
       }

    //    return redirect()->route('login');

    }
}
