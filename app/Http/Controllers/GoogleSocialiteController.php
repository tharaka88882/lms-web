<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMentorMail;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Student;
use App\Models\Teacher;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\WelcomeMail;
use App\Models\MentorConversation;
use App\Models\MentorMessage;
use Carbon\Carbon;

class GoogleSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('social_id', $user->id)->first();
            $users = User::all();

            //dd($user);

            if($finduser){
               // dd($user->id);
                    Auth::login($finduser);

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
                   if($avg_times_array[0]['response_time'] > 0){
                    $real_avg = $avg_times_array[0]['response_time'];
                   }else{
                    $real_avg = 1;
                   }
                    }else{
                    $arr_size = sizeof($avg_times_array);
                    $arr_value_total = 0;
                    foreach($avg_times_array as $value){
                        $arr_value_total += $value['response_time'];
                    }
                    $real_avg = (int)($arr_value_total / $arr_size);
                    }
                    }

                    if( $real_avg == 0){
                        $real_avg =0;
                       }

                    Auth()->user()->avg = $real_avg;
                    Auth()->user()->save();

                    $empty_profile = true;
                    if(sizeof(Auth()->user()->userable->experiences)>0){
                        $empty_profile = false;
                    } elseif(sizeof(Auth()->user()->userable->qualifications)>0){
                        $empty_profile = false;
                    }
                    if($empty_profile == false){
                        return redirect('user/dashboard');
                    }else{
                        return redirect()->route('user.profile_1');
                    }


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

                    // $student = new Student();
                    // $student->status = true;
                    // $student->save();
                    // $student->user()->save($newUser);
                    $teacher = new Teacher();
                    $teacher->status = false;
                    $teacher->save();
                    $teacher->user()->save($newUser);

                    Auth::login($newUser);

                    Mail::to($user->email)->send(new WelcomeMail($user->name));


                    // if(Auth()->user()->userable->linkedin_link!=null){

                 if(Auth()->user()->first_login==1){
                  //  dd('test');
                    return redirect('user/dashboard');
                 }else{
                     Auth()->user()->first_login = 1;
                     Auth()->user()->save();
                    return redirect()->route('user.profile_1');
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
