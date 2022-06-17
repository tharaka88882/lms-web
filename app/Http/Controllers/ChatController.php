<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\MentorConversation;
use App\Models\MentorMessage;
use App\Models\Message;
use App\Models\Teacher;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Mail;
use App\Mail\StartConversation;

class ChatController extends Controller
{
    use UserTrait;
    public function add_conversation(Request $request){

        DB::beginTransaction();
        try{

        $conversations = Conversation::where('teacher_id', $request->get('teacher_id'))->where('student_id', Auth()->user()->userable->id)->exists();
        if($conversations){
            DB::rollBack();
            return redirect()->back();
        }else{

            $conversation = new Conversation();
            $conversation->teacher_id=$request->get('teacher_id');
            $conversation->student_id=$request->get('student_id');
            $conversation->save();



           // $conversation1 = Conversation::where('teacher_id',$request->get('teacher_id'))->where('student_id',$request->get('student_id'))->get();

            $message = new Message();
            $message->message=lcfirst(Auth()->user()->name)." has started a conversation.";
            $message->sender_id=Auth()->user()->id;
            $message->conversation_id= $conversation->id;
            $message->save();
            //DB::commit();

            $teacher = Teacher::findOrFail($request->get('teacher_id'));

            $this->createNotification($teacher->user->id,explode(' ',Auth()->user()->name)[0].' has started a conversation.',route('teacher.view_conversation',$conversation->id));

            $to = $teacher->user->email;
            $user_name = $teacher->user->name;
            // $subject = "Welcome to You2Mentor";
            // $txt = "Hi, ".$teacher->user->name." Mentee has started conversation with you. Click Here : ".route('login')." ";
            // $headers = "From: info@you2mentor.com" . "\r\n";

           // mail($to,$subject,$txt,$headers);
          // Mail::to($to)->send(new StartConversation($user_name));

            DB::commit();
            Toastr::success('Conversation Started', 'Success');
            return Redirect()->route('student.view_conversation', $conversation->id);
        }
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Danger');
            Log::error($e);
            DB::rollBack();
            return redirect()->back();
        }
    }


    public function add_message_json(MessageRequest $request){
        DB::beginTransaction();
        try{
            if($request->get('conversation_id')){
              //  if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $request->get('message'))){

                    $message = new Message();
                    $message->message = $request->get('message');
                    $message->sender_id = Auth()->user()->id;
                    $message->conversation_id = $request->get('conversation_id');
                    $message->save();
                    DB::commit();
              //  }

                $query = Conversation::findOrFail($request->get('conversation_id'));

               if($query->student->user->id == Auth()->user()->id){
                $this->createNotification($query->teacher->user->id, 'New Message',route('teacher.view_conversation',$query->id));

               }else{
                $this->createNotification($query->student->user->id, 'New Message',route('student.view_conversation',$query->id));
               }


                return array(
                    'success' => true,
                    'data'    => array(
                        'id'=>$message->id
                    ),
                    'message' => 'success'
                );
            }else{
                return array(
                    'success' => false,
                    'data'    => array(),
                    'message' => 'Error'
                );
            }
        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return array(
                'success' => false,
                'data'    => array(),
                'message' => $e->getMessage()
            );
        }
    }

    public function list_messages_json(Request $request){
        $query = Message::where('conversation_id', $request->get('conversation_id'));

        $last_id = '-1';
        $content = "";

        if ($request->get('last_id') != "-1"){
            $last_id = $request->get('last_id');
            $query->where('id','>',$request->get('last_id'));
        }else{
            $query->where('id','<','-1');
        }

        $query->orderBy('id', 'ASC');
        $query->limit(10);

        $messages = $query->get();

        foreach($messages as $message){
            if($message->sender_id==Auth()->user()->id){
                $content .= "<!-- Message to the right -->";
                $content .= "<div class=\"direct-chat-msg right\">";
                $content .= "    <div class=\"direct-chat-info clearfix text-right\">";
                $content .= "        <span class=\"direct-chat-name right\">Me</span>";
                $content .= "        <small class=\"direct-chat-timestamp float-left\">".$message->created_at->format('y/m/d h:i')."</small>";
                $content .= "    </div>";
                $content .= "    <!-- /.direct-chat-info -->";
                $content .= "    <img class=\"direct-chat-img\"";
                $content .= "        onerror=\"this.src='".url('public')."/theme/admin/dist/img/default-avatar.jpg'\"";
                if (Auth()->user()->image != null) {
                $content .= "        src=\"".url('public')."/images/profile/".Auth()->user()->image."\"";
                }else {
                $content .= "        src=\"\"";
                }
                $content .= "        alt=\"message user image\">";
                $content .= "    <!-- /.direct-chat-img -->";
                $content .= "    <div class=\"direct-chat-text\" style=\"max-width:60%; float: right\">";
                $content .= "        ".$message->message." </div>";
                $content .= "    <!-- /.direct-chat-text -->";
                $content .= "</div>";
                $content .= "<!-- /.direct-chat-msg -->";
            }else{
                $content .= "<!-- Message. Default to the left -->";
                $content .= "<div class=\"direct-chat-msg\">";
                $content .= "    <div class=\"direct-chat-info clearfix\">";
                $content .= "        <span class=\"direct-chat-name pull-left\">".$message->sender->name."</span>";
                $content .= "        <small class=\"direct-chat-timestamp float-right\">".$message->created_at->format('y/m/d h:i')."</small>";
                $content .= "    </div>";
                $content .= "    <!-- /.direct-chat-info -->";
                $content .= "    <img class=\"direct-chat-img\"";
                $content .= "        onerror=\"this.src='".url('public')."/theme/admin/dist/img/default-avatar.jpg'\"";
                if ($message->sender->image != null) {
                $content .= "        src=\"".url('public')."/images/profile/".$message->sender->image."\"";
                }else {
                $content .= "        src=\"\"";
                }
                $content .= "        alt=\"message user image\">";
                $content .= "    <!-- /.direct-chat-img -->";
                $content .= "    <div class=\"direct-chat-text\" style=\"max-width:60%; float: left\">";
                $content .= "        ".$message->message." </div>";
                $content .= "    <!-- /.direct-chat-text -->";
                $content .= "</div>";
                $content .= "<!-- /.direct-chat-msg -->";
            }
            $last_id = $message->id;
        }
        return json_encode(array(
            'success' => true,
            'data'    => array(
                'last_id'=>$last_id,
                'content'=> $content
            ),
            'message' => 'success'
        ));
    }


    //--------------------------------Mentor be Mntee-------------------------------------------
    public function add_mentor_conversation(Request $request){

        DB::beginTransaction();
        try{

        $conversations = MentorConversation::where('mentor_id', $request->get('teacher_id'))->where('mentee_id', Auth()->user()->userable->id)->exists();
        if($conversations){
            DB::rollBack();
            return redirect()->back();
        }else{

            $conversation = new MentorConversation();
            $conversation->mentor_id=$request->get('teacher_id');
            $conversation->mentee_id=$request->get('student_id');
            $conversation->save();



            $message = new MentorMessage();
            $message->message=lcfirst(Auth()->user()->name)." has started a conversation.";
            $message->sender_id=Auth()->user()->userable->id;
            $message->conversation_id= $conversation->id;
            $message->save();

            $teacher = Teacher::findOrFail($request->get('teacher_id'));

            $this->createNotification($teacher->user->id,explode(' ',Auth()->user()->name)[0].' has started a conversation.',route('teacher.view_mentor_conversation',$conversation->id));

            $to = $teacher->user->email;
            // $subject = "Welcome to You2Mentor";
            // $txt = "Hi, ".$teacher->user->name." Mentee has started conversation with you. Click Here : ".route('login')." ";
            // $headers = "From: info@you2mentor.com" . "\r\n";

            $user_name = $teacher->user->name;
            //mail($to,$subject,$txt,$headers);
           // Mail::to($to)->send(new StartConversation($user_name));

            DB::commit();
            Toastr::success('Conversation Started', 'Success');
            return Redirect()->route('teacher.view_mentor_conversation', $conversation->id);
        }
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Danger');
            Log::error($e);
            DB::rollBack();
            return redirect()->back();
        }
    }


    public function add_mentor_message_json(MessageRequest $request){
        DB::beginTransaction();
        try{
            if($request->get('conversation_id')){
                $message = new MentorMessage();
                $message->message=$request->get('message');
                $message->sender_id=Auth()->user()->userable->id;
                $message->conversation_id=$request->get('conversation_id');
                $message->save();
                DB::commit();

                return array(
                    'success' => true,
                    'data'    => array(
                        'id'=>$message->id
                    ),
                    'message' => 'success'
                );
            }else{
                return array(
                    'success' => false,
                    'data'    => array(),
                    'message' => 'Error'
                );
            }
        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return array(
                'success' => false,
                'data'    => array(),
                'message' => $e->getMessage()
            );
        }
    }


    public function list_mentor_messages_json(Request $request){
        $query = MentorMessage::where('conversation_id', $request->get('conversation_id'));

        $last_id = '-1';
        $content = "";

        if ($request->get('last_id') != "-1"){
            $last_id = $request->get('last_id');
            $query->where('id','>',$request->get('last_id'));
        }else{
            $query->where('id','<','-1');
        }

        $query->orderBy('id', 'ASC');
        $query->limit(10);

        $messages = $query->get();

        foreach($messages as $message){
            if($message->sender_id==Auth()->user()->userable->id){
                $content .= "<!-- Message to the right -->";
                $content .= "<div class=\"direct-chat-msg right\">";
                $content .= "    <div class=\"direct-chat-info clearfix text-right\">";
                $content .= "        <span class=\"direct-chat-name right\">Me</span>";
                $content .= "        <small class=\"direct-chat-timestamp float-left\">".$message->created_at->format('y/m/d h:i')."</small>";
                $content .= "    </div>";
                $content .= "    <!-- /.direct-chat-info -->";
                $content .= "    <img class=\"direct-chat-img\"";
                $content .= "        onerror=\"this.src='".url('public')."/theme/admin/dist/img/default-avatar.jpg'\"";
                if (Auth()->user()->image != null) {
                $content .= "        src=\"".url('public')."/images/profile/".Auth()->user()->image."\"";
                }else {
                $content .= "        src=\"\"";
                }
                $content .= "        alt=\"message user image\">";
                $content .= "    <!-- /.direct-chat-img -->";
                $content .= "    <div class=\"direct-chat-text\" style=\"max-width:60%; float: right\">";
                $content .= "        ".$message->message." </div>";
                $content .= "    <!-- /.direct-chat-text -->";
                $content .= "</div>";
                $content .= "<!-- /.direct-chat-msg -->";
            }else{
                $content .= "<!-- Message. Default to the left -->";
                $content .= "<div class=\"direct-chat-msg\">";
                $content .= "    <div class=\"direct-chat-info clearfix\">";
                $content .= "        <span class=\"direct-chat-name pull-left\">".$message->sender->user->name."</span>";
                $content .= "        <small class=\"direct-chat-timestamp float-right\">".$message->created_at->format('y/m/d h:i')."</small>";
                $content .= "    </div>";
                $content .= "    <!-- /.direct-chat-info -->";
                $content .= "    <img class=\"direct-chat-img\"";
                $content .= "        onerror=\"this.src='".url('public')."/theme/admin/dist/img/default-avatar.jpg'\"";
                if ($message->sender->user->image != null) {
                $content .= "        src=\"".url('public')."/images/profile/".$message->sender->user->image."\"";
                }else {
                $content .= "        src=\"\"";
                }
                $content .= "        alt=\"message user image\">";
                $content .= "    <!-- /.direct-chat-img -->";
                $content .= "    <div class=\"direct-chat-text\" style=\"max-width:60%; float: left\">";
                $content .= "        ".$message->message." </div>";
                $content .= "    <!-- /.direct-chat-text -->";
                $content .= "</div>";
                $content .= "<!-- /.direct-chat-msg -->";
            }
            $last_id = $message->id;
        }
        return json_encode(array(
            'success' => true,
            'data'    => array(
                'last_id'=>$last_id,
                'content'=> $content
            ),
            'message' => 'success'
        ));
    }
}
