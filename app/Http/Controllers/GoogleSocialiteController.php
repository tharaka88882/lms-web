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
use App\Models\User;
use App\Mail\WelcomeMail;

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
            $users = User::all();

            //dd($user);

            if($finduser){

                    Auth::login($finduser);
                    Auth()->user()->avg = rand(1,5);
                    Auth()->user()->save();
                    return redirect('user/dashboard');

            }else{
                $flag = false;
                foreach($users as $us){
                    if($us->email==$user->email){
                        $flag=true;
                    }
                }

                if($flag){
                    Toastr::error('Email already used', 'Error');
                    return redirect()->route('login');
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
                    // $newUser = User::create([
                    //     'name' => $user->name,
                    //     'email' => $user->email,
                    //     'image'=>$imageName,
                    //     'social_id'=> $user->id,
                    //     'social_type'=> 'google',
                    //     'password' => encrypt('my-google')
                    // ]);
                    $newUser = new User();
                    $newUser->name=  $user->name;
                    $newUser->email=  $user->email;
                    $newUser->image=  $imageName;
                    $newUser->social_id=  $user->id;
                    $newUser->social_type= 'google';
                    $newUser->password=encrypt('my-google');
                    $newUser->save();

                    $student = new Student();
                    $student->status = true;
                    $student->save();
                    $student->user()->save($newUser);

                    Auth::login($newUser);

                    Mail::to($user->email)->send(new WelcomeMail($user->name));


                    // if(Auth()->user()->userable->linkedin_link!=null){
                 if(Auth()->user()->first_login==1){
                    return redirect('user/dashboard');
                 }else{
                     Auth()->user()->first_login = 1;
                     Auth()->user()->save();
                    return redirect()->route('user.profile');
                 }
                     // }else{
                     //   return redirect()->route('auth.view_linkedin');
                     // }
                }



            }

        } catch (Exception $e) {
            //dd($e->getMessage());
            Toastr::error('Something went wrong', 'Error');
            return redirect()->route('login');
        }
    }
}
