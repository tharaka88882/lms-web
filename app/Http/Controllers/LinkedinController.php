<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Teacher;
use App\Models\MentorConversation;
use App\Models\MentorMessage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMentorMail;
use Carbon\Carbon;

class LinkedinController extends Controller
{
    public function linkedinRedirect()
    {
        if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
        {
           $login_email = $_COOKIE['login_email'];
           $login_pass  = $_COOKIE['login_pass'];
           $user = User::where('email', $login_email)->first();

           Auth::login($user);

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
            $real_avg = $avg_times_array[0];
           }else{
            $arr_size = sizeof($avg_times_array);
            $arr_value_total = 0;
            foreach($avg_times_array as $value){
                $arr_value_total += $value['response_time'];
            }
            $real_avg = (int)($arr_value_total / $arr_size);
           }
           }


           Auth()->user()->avg = $real_avg;
           Auth()->user()->save();

           if(Auth()->user()->userable->linkedin_link!=null){
            if(Auth()->user()->first_login==1){

                return redirect('user/dashboard');
            }else{
                // Auth()->user->first_login = 1;
                // Auth()->user->save();

                return redirect()->route('user.profile_1');
            }
           }else{
               return redirect()->route('auth.view_linkedin');
           }
        }
        else{
        //    $login_email ='';
        //    $login_pass = '';
        //    $is_remember = "";

           return Socialite::driver('linkedin')->redirect();
         }

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

                Auth()->user()->avg = rand(1,5);
                Auth()->user()->save();
                setcookie('login_email',Auth()->user()->email,time()+60*60*24*100);
                setcookie('login_pass',Auth()->user()->password,time()+60*60*24*100);


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
                 $real_avg = $avg_times_array[0];
                }else{
                 $arr_size = sizeof($avg_times_array);
                 $arr_value_total = 0;
                 foreach($avg_times_array as $value){
                     $arr_value_total += $value['response_time'];
                 }
                 $real_avg = (int)($arr_value_total / $arr_size);
                }
                }


                Auth()->user()->avg = $real_avg;
                Auth()->user()->save();

                if(Auth()->user()->userable->linkedin_link!=null){
                    if(Auth()->user()->first_login==1){

                        return redirect('user/dashboard');
                    }else{
                        // Auth()->user->first_login = 1;
                        // Auth()->user->save();

                        return redirect()->route('user.profile_1');
                    }
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
                setcookie('login_email',Auth()->user()->email,time()+60*60*24*100);
                setcookie('login_pass',Auth()->user()->password,time()+60*60*24*100);

                    $to = $user1->email;
                    // $subject = "Teacher Registerd";
                    // $txt = "You Successfully Registered as a Mentor. Please Wait Activates you within 24 hours..!". route('login');
                    // $headers = "From: info@you2mentor.com" . "\r\n";

                    // mail($to, $subject, $txt, $headers);
                    //Mail::to($user1->email)->send(new SignUp());
                    Mail::to($to)->send(new WelcomeMentorMail());



                if(Auth()->user()->userable->linkedin_link!=null){
                    if(Auth()->user()->first_login==1){

                        return redirect('user/dashboard');
                    }else{
                        // Auth()->user->first_login = 1;
                        // Auth()->user->save();

                        return redirect()->route('user.profile_1');
                    }

                }else{
                  return redirect()->route('auth.view_linkedin');
                }

              }else{
                  if(get_class($saved_user->userable) == 'App\Models\Student'){
                    Toastr::error("You already have a Mentee account before this Email" . $user->email. ")", 'Error');

                  }else{
                    Toastr::error("You already have a Mentor account before this Email" . $user->email. ")", 'Error');
                  }
                return redirect()->route('login');
              }
            }

        } catch (Exception $e) {
            // DB::rollBack();
           // dd($e->getMessage());
           Toastr::error("Please Relogin",'Error');
           return redirect()->route('login');
        }
    }
}
