<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Teacher;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class LinkedinController extends Controller
{
    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function linkedinCallback()
    {
        try {

            $user = Socialite::driver('linkedin')->user();
            //dd($user->avatar);

            $linkedinUser = User::where('oauth_id', $user->id)->first();

            if($linkedinUser){
                //Log::error($linkedinUser);
                //dd($linkedinUser);

                Auth::login($linkedinUser);

                if(Auth()->user()->userable->linkedin_link!=null){
                    return redirect('user/dashboard');
                }else{
                    return redirect()->route('auth.view_linkedin');
                }



            }else{
                $saved_user = User::where('email', $user->email)->first();

                $imageName = null;

                //dd($user->avatar);

                if ($user->avatar != null) {
                    // $imageName = time() . '.' . $user->avatar;
                    // $user->avatar->move(public_path('images/profile/'), $imageName);
                    try{
                        $url = $user->avatar;
                        $imageName = time()."linkedin.png";
                        file_put_contents(public_path('images/profile/').$imageName, file_get_contents($url));
                        //return back()->with('success','You have successfully upload image.')->with('image',$imageName);
                        //dd($imageName);
                    }catch(Exception $e){
                        //dd($e);
                    }
                }

              if($saved_user==null){
                $user1 = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $imageName,
                   // 'two_factor_secret' => $user->two_factor_secret,
                    //'two_factor_recovery_codes' => $user->two_factor_recovery_codes,
                    'oauth_id' => $user->id,
                    'oauth_type' => 'linkedin',
                    'password' => encrypt('admin12345')
                ]);
                $teacher = new Teacher();
                $teacher->status = true;
                $teacher->save();
                $teacher->user()->save($user1);

                Auth::login($user1);

                    $to = $user1->email;
                    $subject = "Teacher Registerd";
                    $txt = "You Successfully Registered as a Mentor. Please Wait Activates you within 24 hours..!". route('login');
                    $headers = "From: info@you2mentor.com" . "\r\n";

                    mail($to, $subject, $txt, $headers);


                if(Auth()->user()->userable->linkedin_link!=null){
                    return redirect('user/dashboard');
                }else{
                  return redirect()->route('auth.view_linkedin');
                }

              }else{
                  if(get_class($saved_user->userable) == 'App\Models\Student'){
                    Toastr::error("You already have a Mentee account before this Email..! (" . $user->email. ")", 'Error..!');

                  }else{
                    Toastr::error("You already have a Mentor account before this Email..! (" . $user->email. ")", 'Error..!');
                  }
                return redirect()->route('login');
              }
            }

        } catch (Exception $e) {
            // DB::rollBack();
           // dd($e->getMessage());
           Toastr::error("Please Relogin..!",'Error..!');
           return redirect()->route('login');
        }
    }
}
