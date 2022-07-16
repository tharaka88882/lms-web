<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateTeacherProfileRequest;
use App\Http\Requests\AddQualificationRequest;
use App\Http\Requests\AddExperienceRequest;
use App\Models\Complaint;
use App\Models\Industry;
use App\Models\Position;
use App\Models\Institute;
use App\Models\Experience;
use App\Models\Qualification;
use App\Models\Rating;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\ReferMail;
use App\Mail\CheckedComplaint;
use App\Traits\UserTrait;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    use UserTrait;
    public function profile()
    {
        $user =  Auth::user();
        $industries = Industry::all();
        $institutes = Institute::all();
        $position = Position::all();



        $ratings = Rating::where('teacher_id',Auth()->user()->userable_id)->get();
        $rator_count = count(json_decode( $ratings,true));
        $rating_count = 0;
        $mediation = 0;
            foreach($ratings as $rating){
                $rating_count+=$rating->rating;
            }
       if($rator_count!=0){
        $mediation = $rating_count/$rator_count;
       }

        $round_mediation =(int)$mediation;

        // return get_class($user);
        if (get_class($user->userable) == 'App\Models\Teacher') {
            if (Auth()->user()->userable->status == 1) {
                return view('teacher.profile', compact('user', 'industries','round_mediation','institutes','position'));
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
                Toastr::success('Profile Updated successfully', 'Success');
            } else if (get_class($user->userable) == 'App\Models\Admin') {
                $user->name = $request->get('name');
                if( $imageName!=null){
                    $user->image = $imageName;
                }

                $user->save();
                Toastr::success('Profile Updated successfully', 'Success');
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
            $coverImageName = null;

             if ($request->has('image')) {
                // $image = new Image();
                // $imageName = time() . '.' . $request->image->extension();
                // // $image_resize = ImageManagerStatic::make($request->image);
                // $image->load($_FILES['image']['tmp_name']);
                // // $image_resize->resize(300, 300);
                // $image->resize(300,300);
                // $image->save(public_path('images/profile/'), $imageName);

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/profile/'), $imageName);
                //return back()->with('success','You have successfully upload image.')->with('image',$imageName);
            }
             if ($request->has('cover_image')) {
                $coverImageName = time() . '.' . $request->cover_image->extension();
                $request->cover_image->move(public_path('images/profile/'), $coverImageName);
                //return back()->with('success','You have successfully upload image.')->with('image',$imageName);
            }

            $user =  Auth::user();

            if (get_class($user->userable) == 'App\Models\Teacher') {
                $user->name = $request->get('name');
               if($imageName!=null){
                $user->image = $imageName;
               }
               if($coverImageName!=null){
                $user->cover_image = $coverImageName;
               }
                $user->address = $request->get('address');
                $user->city = $request->get('city');
                $user->country = $request->get('country');
                $user->about = $request->get('about');
                if($request->get('from_leave')!=null && $request->get('to_leave')!=null){
                    $user->from_leave = $request->get('from_leave');
                    $user->to_leave = $request->get('to_leave');
                }

                //dd($request->get('leave_status'));
                if($request->get('leave_status')=='on'){
                    $user->leave_status = 1;
                }else{
                    $user->leave_status = 0;
                }

              //  $user->userable->nic = $request->get('nic');
                $user->userable->qualification = $request->get('qualification');
                $user->userable->experience = $request->get('experience');
               // $user->userable->skills = $request->get('skills');
                $user->userable->job = $request->get('job');
                $user->userable->industry = $request->get('industry');
                $user->userable->linkedin_link = $request->get('linkedin_link');
                $user->userable->save();
                $user->save();
                Toastr::success('Profile Updated successfully', 'Success');
            } else {
                Toastr::success('Profile Updated Unsuccessful', 'Error');
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

       // $mentee = Student::findOrFail($complaints->user->userable_id);
        $this->createNotification($complaints->user->id, 'We received your complaint. We will check into it.');
        Mail::to($complaints->user->email)->send(new CheckedComplaint());
        return array(
            "success" => true
        );
    }
    public function stikey(Request $request)
    {
        $stikey = new StikeyNote();
        $stikey->note =$request->get('note');
        $stikey->user_id = Auth()->user()->id;
        $stikey->teacher_id = $request->get('id');
        $stikey->save();
    //    $stikey_note = StikeyNote::where('user_id',Auth()->user()->id)->where('teacher_id',$request->get('id'))->first();

    //    if(!empty($stikey_note)){
    //     $stikey_note->note =$request->get('note');
    //     $stikey_note->save();
    //    }else{

    //    }

       return array(
           'success'=>true
       );
    }

    public function stikey_distory(Request $request)
    {

       $stikey_note = StikeyNote::findOrFail($request->get('id'));

       $stikey_note->delete();

       return array(
           'success'=>true
       );
    }
    public function stikey_distory_mentee(Request $request)
    {

       $stikey_note = StikeyNote::findOrFail($request->get('id'));

       $stikey_note->delete();

       return array(
           'success'=>true
       );
    }
    public function stikey_distory_mentor(Request $request)
    {

       if($request->get('user')=='mentee'){
        $stikey_note = StikeyNoteMentee::findOrFail($request->get('id'));

        $stikey_note->delete();
       }else{
        $stikey_note = StikeyNote::findOrFail($request->get('id'));

        $stikey_note->delete();
       }

       return array(
           'success'=>true
       );
    }

    public function stikey_mentee(Request $request)
    {
      if($request->get('user')=='mentee'){
       // $stikey = StikeyNoteMentee::where('user_id',Auth()->user()->id)->where('student_id',$request->get('id'))->first();

         $stikey = new StikeyNoteMentee();
         $stikey->note = $request->get('note');
         $stikey->user_id = Auth()->user()->id;
         $stikey->student_id = $request->get('id');
         $stikey->save();

      }else{
      //  $stikey = StikeyNote::where('user_id',Auth()->user()->id)->where('teacher_id',$request->get('id'))->first();

         $stikey = new StikeyNote();
         $stikey->note = $request->get('note');
         $stikey->user_id = Auth()->user()->id;
         $stikey->teacher_id = $request->get('id');
         $stikey->save();

      }

       return array(

           'success'=>true
       );
    }
    public function refer(Request $request)
    {
        $email = $request->get('email');
        $username = $request->get('username');
        // To do email send code hear....
        Mail::to($email)->send(new ReferMail($username));

        Toastr::success('Refered Successfully', 'Success');
        return  redirect()->back();
    }

    public function store_experience(AddExperienceRequest $request)
    {
        $position =Position::where('text',$request->get('position'))->first();
        $institute =Institute::where('text',$request->get('company'))->first();
        //dd("");
        if($position==null){
            $position = new Position();
            $position->text = $request->get('position');
            $position->save();
        }
        if($institute == null){
            $institute = new Institute();
            $institute->text = $request->get('company');
            $institute->save();
        }

        $experience = new Experience();
        $experience->text = '';
        $experience->location = $request->get('location');
        $experience->start_date = $request->get('start_date');
        $experience->end_date = $request->get('end_date');
        $experience->teacher_id = Auth()->user()->userable->id;
        $experience->institute_id = $institute->id;
        $experience->position_id =$position->id;
        $experience->save();


        Toastr::success('New Experience Added', 'Success');
        return  redirect()->route('user.profile');
    }

    public function store_qualification(AddQualificationRequest $request)
    {
        $institute = Institute::where('text',$request->get('company'))->first();
       // dd( $institute );
        if($institute == null){
            $institute = new Institute();
            $institute->text = $request->get('company');
            $institute->save();
        }

        $qualification = new Qualification();
        $qualification->text = $request->get('qualification');
        $qualification->field = $request->get('field');
        // $qualification->location = $request->get('location');
        $qualification->start_date = $request->get('start_date');
        $qualification->end_date = $request->get('end_date');
        $qualification->grade = $request->get('grade');
        $qualification->teacher_id = Auth()->user()->userable->id;
        $qualification->institute_id = $institute->id;
        $qualification->save();


        Toastr::success('New Qualification Added', 'Success');
        return  redirect()->route('user.profile');
    }

    public function edit_qualification($id)

    {

        $qualification =  Qualification::findOrFail($id);
        $institutes = Institute::all();
        $position = Position::all();

        return view('teacher.edit_qualification', compact('id', 'qualification','institutes','position'));

    }

    public function edit_experience($id)

    {

        $experiences =  Experience::findOrFail($id);
        $institutes = Institute::all();
        $position = Position::all();
        return view('teacher.edit_experience', compact('id', 'experiences','institutes','position'));

    }

    public function update_qualification(AddQualificationRequest $request,$id)
    {
        $institute = Institute::where('text',$request->get('company'))->first();
       // dd( $institute );
        if($institute == null){
            $institute = new Institute();
            $institute->text = $request->get('company');
            $institute->save();
        }

        $qualification = Qualification::findOrFail($id);
        $qualification->text = $request->get('qualification');
        $qualification->field = $request->get('field');
        // $qualification->location = $request->get('location');
        $qualification->start_date = $request->get('start_date');
        $qualification->end_date = $request->get('end_date');
        $qualification->grade = $request->get('grade');
        $qualification->teacher_id = Auth()->user()->userable->id;
        $qualification->institute_id = $institute->id;
        $qualification->save();


        Toastr::success('Qualification Updated', 'Success');
        return  redirect()->route('user.profile');
    }

    public function update_experience(AddExperienceRequest $request,$id)
    {
        $position =Position::where('text',$request->get('position'))->first();
        $institute =Institute::where('text',$request->get('company'))->first();
        //dd("");
        if($position==null){
            $position = new Position();
            $position->text = $request->get('position');
            $position->save();
        }
        if($institute == null){
            $institute = new Institute();
            $institute->text = $request->get('company');
            $institute->save();
        }

        $experience = Experience::findOrFail($id);
        $experience->text = '';
        $experience->location = $request->get('location');
        $experience->start_date = $request->get('start_date');
        $experience->end_date = $request->get('end_date');
        $experience->teacher_id = Auth()->user()->userable->id;
        $experience->institute_id = $institute->id;
        $experience->position_id =$position->id;
        $experience->save();


        Toastr::success('Experience Updated', 'Success');
        return  redirect()->route('user.profile');
    }

    public function delete_qualification(Request $request)
    {

        $qualification = Qualification::findOrFail($request->get('id'));
        $qualification->delete();

        Toastr::success('Deleted', 'Success');
        return array(
            'success'=>true
        );
    }

    public function delete_experience(Request $request)
    {
        $qualification = Experience::findOrFail($request->get('id'));
        $qualification->delete();

        Toastr::success('Deleted', 'Success');
        return array(
            'success'=>true
        );
    }

    public function view_my_profile()
    {
        return view('teacher.view_my_profile');
    }

}
