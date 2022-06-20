@extends('layouts.app')

@section('title')
    Mentor Conversation
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <!-- DIRECT CHAT -->
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="text-transform: capitalize">Direct Chat -<a href="{{route('student.view_tutor',$conversation->teacher_id)}}">{{$conversation->teacher->user->name}}</a></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" id="chat_container" style="min-height: 360px; border: 1px solid rgb(218, 216, 216); background-color:white">

                                @php
                                    $i=0;
                                    $first_id='-1';
                                    $last_id='-1';
                                @endphp

                                @foreach ($conversation->messages as $message)
                                    @php
                                    if($i==0){
                                        $first_id=$message->id;
                                    }
                                    $last_id=$message->id;
                                    $i++;
                                    @endphp
                                    @if ($message->sender_id==Auth()->user()->id)

                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix text-right">
                                                <span class="direct-chat-name right">Me</span>
                                                <small class="direct-chat-timestamp float-left">{{$message->created_at->format('y/m/d h:i')}}</small>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img"  onerror="this.src='{{url('public')}}/theme/admin/dist/img/default-avatar.jpg'"
                                            @if (Auth()->user()->image != null) src="{{url('public')}}/images/profile/{{ Auth()->user()->image }}" @else src="" @endif onerror="this.src='https://login.you2mentor.com/public/images/def.jpg'"/>

                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text" style="max-width:60%; float: right">
                                                {{$message->message}} </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    @else
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">{{$message->sender->name}}</span>
                                                <small class="direct-chat-timestamp float-right">{{$message->created_at->format('y/m/d h:i')}}</small>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img"
                                                @if ($message->sender->image != null) src="{{url('public')}}/images/profile/{{ $message->sender->image }}" @else src="" @endif onerror="this.src='https://login.you2mentor.com/public/images/def.jpg'"/>
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text" style="max-width:60%; float: left">
                                                {{$message->message}} </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    @endif



                                @endforeach


                            </div>
                            <!--/.direct-chat-messages-->

                            <!-- Contacts are loaded here -->

                            <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="input-group">
                                <input id="inpMessage" type="text" name="message" placeholder="Type Message ..."
                                    class="form-control @if($errors->has('message')) {{'is-invalid'}} @endif">
                                     @if($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="errorMsg">{{ $errors->first('message') }}</strong>
                                        </span>
                                     @endif
                                <span class="input-group-btn">
                                    <button id="btnSend" type="button" class="btn btn-warning btn-flat">Send</button>
                                </span>
                            </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                <div class="col-md-5" style="margin-top: 42px">
                    <div class="card card-default">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fas fa-bullhorn"></i>
                             Notice!
                         </h3>
                       </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="callout callout-danger">

                                <p>Please do not share personal identifiable information such as credit card details, phone numbers and email addresses through chat for your online safety.
                                    </p>
                            </div>

                          {{-- <div class="callout callout-info">

                            <p>Once you request a meeting Mentor will check and Approve it.
                                Then mentor will send a link to your meeting from this chat.
                                <br>
                                <strong>Important:</strong> After mentor approve your request, you can not reverse back the transaction.
                            </p>
                          </div> --}}

                          {{-- <div class="row" style="margin-top: 20px;">
                          @if ((Auth()->user()->streaming_count>0 && empty($userTransaction)) || ($teacher->level < $setting->paid_level))
                          <div class="col-md-6"><button id="request_link" class="btn btn-block btn-success">Booking</button></div>
                            <div class="col-md-6">
                                <select id="start_time" class="form-control">
                                        @foreach ($teacher->shadules as $shadule)
                                            <option>{{$shadule->schedule_date}} {{  $shadule->start_time}}</option>
                                        @endforeach
                                </select>


                            </div>

                          @elseif(!empty($userTransaction))
                          <div class="col-md-6"><button id="cancel_request" class="btn btn-block btn-danger">Cancel Booking</button></div>
                          @endif
                        </div> --}}
                        </div>
                        <!-- /.card-body -->
                   </div>
                      <!-- /.card -->

                      <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-list"></i>
                                  Mentor Skills
                           </h3>
                           <div class="card-body">
                        @if (count($teacherSubs)>0)
                        <div class="p-2 mt-2 bg-light d-flex justify-content rounded text-white stats" style="font-size: 18px;">
                            @foreach ($teacherSubs as $subject)
                                <span class="badge bg-gray mr-1">{{$subject->name}}</span>
                            @endforeach
                        </div>
                        @endif

                           </div>
                         </div>
                      </div>
                      <div class="card card-default">
                        <div class="card-header">
                          <button data-toggle="modal" data-target="#modal-md1" class="btn btn-s btn-warning">Note</button>
                         </div>
                      </div>
                </div>
            </div>
        </div>
    </section>



      <!-- /.modal -->
      <div class="modal fade" id="modal-md1">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="text-transform: capitalize">{{$conversation->teacher->user->name}} Notes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @csrf
            <div class="modal-body">
              <div class="container">
                <div class="row">
                    <div class="form-group col-md-9">
                        {{-- <label>Any Comments</label> --}}
                        <input id="stikey_{{$conversation->teacher->id}}"  name="question3" class="form-control" required/>
                            {{-- @foreach ($conversation->mentor->stikey as $stikey)
                            @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                            {{$stikey->note}}
                            @endif
                            @endforeach --}}
                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label>Any Comments</label> --}}
                        <button onclick="saveNote1('{{$conversation->teacher->id}}');" class="btn btn-success">Save</button>
                            {{-- @foreach ($conversation->mentor->stikey as $stikey)
                            @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                            {{$stikey->note}}
                            @endif
                            @endforeach --}}
                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                    </div>
                </div>
                <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Note</th>
                                    <th>Date Added</th>
                                    <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                               @foreach ($conversation->teacher->stikey as $stikey)

                             @if ($stikey->user_id == Auth()->user()->id)
                             <tr>
                                <td>{{$i}}</td>
                                <td>{{$stikey->note}}</td>
                                <td>@displayDate($stikey->updated_at)</td>
                                <td >
                                      <button type="button" onclick="del_stikey('{{$stikey->id}}');" class="btn btn-sm btn-danger" id="del_{{$stikey->id}}">Delete</button>
                                </td>
                            </tr>
                             @endif
                            @php
                                $i++;
                            @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script>

        var last_id = "{{$last_id}}";

        function sendMessage() {
            var message = $('#inpMessage').val();
            $.ajax({
                method: 'POST',
                url: "{{route('chat.store_message')}}" ,
                data: {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    message: message,
                    conversation_id: "{{$id}}"
                    //more params
                },
                success: function (data) {

                    if (data == 1)
                        toastr.error('Request failed!');
                    else {
                        //success
                        $('#inpMessage').val('');
                    }

                }
            });
            // console.log({{$errors}});
        }

        $('#btnSend').click(function(){
            sendMessage();
        });

        $('#inpMessage').keypress(function (e) {
            if (e.which == 13) {
                sendMessage();
            }
        });

        function scrollDown() {
            var topPos = document.getElementById("chat_container").scrollHeight;
            document.getElementById("chat_container").scrollTop = topPos;
        }

        function displayMessages(chatdata) {
            $("#chat_container").append(chatdata);
            if(chatdata!=''){
                scrollDown();
            }
        }

        function updateChat() {

            //alert("Update Chat");
            $.post('{{route('chat.message_list')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    last_id: last_id
                }, function (data, status) {
                    var jo = JSON.parse(data);
                    if (jo.error == true) {

                    } else {
                        last_id = jo.data.last_id;
                        displayMessages(jo.data.content);
                    }
            });
        }
            // updateChat();
        setInterval(updateChat, 5000);
        updateChat();


        $('#request_link').click(function(){
            requestLink();
        });
        $('#cancel_request').click(function(){
            cancelLink();
        });
        function requestLink(){
             //alert("Update Chat");
             if (confirm("Are you sure?") == true) {
            $.post('{{route('student.request_meeting')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    start_time:$('#start_time option:selected').val()
                }, function (data, status) {
                      if(data.error==false){
                    window.location="{{route('student.view_conversation',$id)}}";
                }
            });
             }
        }
        function cancelLink(){
             //alert("Update Chat");
             if (confirm("Are you sure?") == true) {
            $.post('{{route('student.cancel_meeting')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}}
                }, function (data, status) {
                      if(data.error==false){
                    window.location="{{route('student.view_conversation',$id)}}";
                }
            });
             }
        }


        function del_stikey(id){
    //$(document).keyup(function (e) {
       //  console.log(e.keyCode);
       //alert(e.keyCode);
   // if(e.keyCode==13){
    if (confirm("Are you sure?") == true) {
        $.post("{{route('user.distory_stikey')}}",
        {
            id: id,
            _method: "delete",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                window.location="{{route('student.view_conversation',$id)}}";
            }
        });
    }
    //alert('saved');

  // }
     // });


}

function saveNote1(id){
   // alert($('#stikey_'+id).val());

   if($('#stikey_'+id).val()!=""){
    $.post("{{route('user.update_stikey')}}",
        {
            id: id,
            note: $('#stikey_'+id).val(),
            _method: "PUT",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                window.location="{{route('student.view_conversation',$id)}}";
            }
        });
   }else{
  alert("Note can't be null !");
   }

}
    </script>
@endpush
