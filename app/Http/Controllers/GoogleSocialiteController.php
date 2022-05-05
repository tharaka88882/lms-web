<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMentorMail;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Student;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;

class GoogleSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('social_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('user/dashboard');
            }else{


                if ($user->avatar != null) {

                    try{
                        $url = $user->avatar;
                        $imageName = time()."google.png";
                        file_put_contents(public_path('images/profile/').$imageName, file_get_contents($url));

                    }catch(Exception $e){
                        //dd($e);
                    }
                }
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image'=>$imageName,
                    'social_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => encrypt('my-google')
                ]);

                $student = new Student();
                $student->status = true;
                $student->save();
                $student->user()->save($newUser);

                Auth::login($newUser);

                Mail::to($user->email)->send(new WelcomeMail($user->name));


                // if(Auth()->user()->userable->linkedin_link!=null){
                return redirect('user/dashboard');
                 // }else{
                 //   return redirect()->route('auth.view_linkedin');
                 // }

            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
