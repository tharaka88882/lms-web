<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateTeacherProfileRequest;
use App\Models\Complaint;
use App\Models\Industry;
use App\Models\StikeyNote;
use App\Models\StikeyNoteMentee;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{


    public function profile()
    {
        $user =  Auth::user();
        $industries = Industry::all();
        // return get_class($user);
        if (get_class($user->userable) == 'App\Models\Teacher') {
            if (Auth()->user()->userable->status == 1) {
                return view('teacher.profile', compact('user', 'industries'));
            } else {
                return abort(403, 'You not approved yet');
            }
        } else if (get_class($user->userable) == 'App\Models\Student') {
            return view('student.profile', compact('user'));
        } else if (get_class($user->userable) == 'App\Models\Admin') {
            return view('admin.profile', compact('user'));
        }
    }


    public function update_profile(UpdateProfileRequest $request)
    {
        //return $request;
        DB::beginTransaction();

        try {

            $imageName = null;

            if ($request->has('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/profile/'), $imageName);
                //return back()->with('success','You have successfully upload image.')->with('image',$imageName);
            }

            $user =  Auth::user();

            if (get_class($user->userable) == 'App\Models\Student') {
                $user->name = $request->get('name');
                $user->image = $imageName;
                $user->userable->grade = $request->get('grade');
                $user->userable->save();
                $user->save();
                Toastr::success('Profile Updated successfully :)', 'Success');
            } else if (get_class($user->userable) == 'App\Models\Admin') {
                $user->name = $request->get('name');
                if( $imageName!=null){
                    $user->image = $imageName;
                }

                $user->save();
                Toastr::success('Profile Updated successfully :)', 'Success');
            }
            DB::commit();
        } catch (Exception $e) {
            return $e;
            Log::error($e);
            DB::rollback();
            Toastr::error($e->getMessage(), 'Error');
        }

        return redirect()->route('user.profile');
    }

    public function update_teacher_profile(UpdateTeacherProfileRequest $request)
    {
        //return $request;
        DB::beginTransaction();

        try {

            $imageName = null;

            if ($request->has('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/profile/'), $imageName);
                //return back()->with('success','You have successfully upload image.')->with('image',$imageName);
            }

            $user =  Auth::user();

            if (get_class($user->userable) == 'App\Models\Teacher') {
                $user->name = $request->get('name');
               if($imageName!=null){
                $user->image = $imageName;
               }
                $user->address = $request->get('address');
                $user->city = $request->get('city');
                $user->country = $request->get('country');
              //  $user->userable->nic = $request->get('nic');
                $user->userable->qualification = $request->get('qualification');
                $user->userable->experience = $request->get('experience');
               // $user->userable->skills = $request->get('skills');
                $user->userable->job = $request->get('job');
                $user->userable->industry = $request->get('industry');
                $user->userable->linkedin_link = $request->get('linkedin_link');
                $user->userable->save();
                $user->save();
                Toastr::success('Profile Updated successfully :)', 'Success');
            } else {
                Toastr::success('Profile Update Unsuccessful :)', 'Error');
            }
            DB::commit();
        } catch (Exception $e) {
            return $e;
            Log::error($e);
            DB::rollback();
            Toastr::error($e->getMessage(), 'Error');
        }

        return redirect()->route('user.profile');
    }


    public function notifications_json()
    {
        $notifications = Notification::where('user_id', Auth()->user()->id)->where('seen', 0)->orderBy('created_at', 'desc')->limit(7)->get();
        $na = array();
        foreach ($notifications as $notification) {
            $na[] = array(
                'id' => $notification->id,
                'message' => $notification->message,
                'user_id' => $notification->user_id,
                'url' => $notification->url,
                'seen' => $notification->seen,
                'created_at' => $notification->created_at->diffForHumans()
            );
        }
        // dd($notifications);
        return json_encode(array(
            'success' => true,
            'data' => $na
        ));
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth()->user()->id)->orderBy('created_at', 'desc')->paginate(20);
        // dd($notifications);
        $newns = Notification::where('user_id', Auth()->user()->id)->where('seen', 0)->get();
        foreach ($newns as $newn) {
            $newn->seen = 1;
            $newn->save();
        }
        return view('notifications', compact('notifications'));
    }

    public function mentee_complaints()
    {
        $complaints = Complaint::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.mentee_complaints', compact('complaints'));
    }

    public function view_complaint($id)
    {
        return view('admin.view_complaint', compact('id'));
    }
    public function update_complaint(Request $request)
    {
        $complaints = Complaint::findOrFail($request->get('id'));
        $complaints->seen = 1;
        $complaints->save();

        return array(
            "success" => true
        );
    }
    public function stikey(Request $request)
    {
       $stikey = StikeyNote::where('user_id',Auth()->user()->id)->where('teacher_id',$request->get('id'))->get();

       if(sizeof($stikey)>0){
        $stikey->note = $request->get('note');

       }else{
        $stikey = new StikeyNote();
        $stikey->note = $request->get('note');
        $stikey->user_id = Auth()->user()->id;
        $stikey->teacher_id = $request->get('id');
        $stikey->save();
       }
       $stikey->save();
       return array(
           'success'=>true
       );
    }
    public function stikey_mentee(Request $request)
    {
       $stikey = StikeyNoteMentee::where('user_id',Auth()->user()->id)->where('student_id',$request->get('id'))->get();

       if(sizeof($stikey)>0){
        $stikey->note = $request->get('note');

       }else{
        $stikey = new StikeyNoteMentee();
        $stikey->note = $request->get('note');
        $stikey->user_id = Auth()->user()->id;
        $stikey->student_id = $request->get('id');
        $stikey->save();
       }
       $stikey->save();
       return array(
           'success'=>true
       );
    }

}
