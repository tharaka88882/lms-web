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
                            <h3 class="box-title" style="text-transform: capitalize">Direct Chat -<a @if ($conversation->mentee->user->id==Auth()->user()->id) href="{{route('teacher.view_mentor',$conversation->mentor_id)}}" @endif> {{($conversation->mentor->user->id==Auth()->user()->id)?$conversation->mentee->user->name:$conversation->mentor->user->name}}</a></h3>
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
                                @if ( $message->seen == 1)
                                @if ($message->sender_id==Auth()->user()->userable->id)

                                <!-- Message to the right -->
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix text-right">
                                        <span class="direct-chat-name right">Me</span>
                                        <small class="direct-chat-timestamp float-left">{{$message->created_at->format('y/m/d h:i')}}</small>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img"
                                        onerror="this.src='{{url('public')}}/theme/admin/dist/img/default-avatar.jpg'"
                                        @if (Auth()->user()->image != null) src="{{url('public')}}/images/profile/{{ Auth()->user()->image }}" @else src="" @endif
                                        >
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
                                        <span class="direct-chat-name pull-left">{{$message->sender->user->name}}</span>
                                        <small class="direct-chat-timestamp float-right">{{$message->created_at->format('y/m/d h:i')}}</small>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    <img class="direct-chat-img"
                                        @if ($message->sender->user->image != null) src="{{url('public')}}/images/profile/{{ $message->sender->user->image }}" @else src="" @endif
                                        onerror="this.src='https://login.you2mentor.com/public/images/def.jpg'"
                                        >
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" style="max-width:60%; float: left">
                                        {{$message->message}} </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                                <!-- /.direct-chat-msg -->
                            @endif
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
                                    class="form-control">
                                <span class="input-group-btn">
                                    <button id="btnSend" type="button" class="btn btn-warning btn-flat">Send</button>
                                </span>
                            </div>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                @if ($conversation->mentor->user->id == Auth()->user()->id)
                <!-- /.card -->
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
                       </div>
                    </div>
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                          <i class="fas fa-list"></i>
                              Mentee development goals
                       </h3>
                       <div class="card-body">
                    <div class="p-2 mt-2 bg-light d-flex justify-content rounded text-white stats" style="font-size: 18px;">
                        @foreach ($menteeDevs as $development)
                            <span class="badge bg-gray mr-1">{{$development->note}}</span>
                        @endforeach
                    </div>

                       </div>
                     </div>
                  </div>

                  <div class="card card-default">
                    <div class="card-header">
                      <button data-toggle="modal" data-target="#modal-md2" class="btn btn-s btn-warning">Note</button>
                     </div>
                  </div>
                @else
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
                        </div>
                    </div>


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
                @endif
                    {{-- @if ($conversation->mentor->user->id == Auth()->user()->id)

                    <div class="col-md-5" style="margin-top: 42px">
                        <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-bullhorn"></i>
                              Important
                            </h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="callout callout-info">
                              <h5>Follow the Instrctions</h5>

                              <p>Click the service that you want to create a meeting from following buttons. Create a meeting from
                                  that service. Then copy and paste that meeting link in the chat. Press send or Enter key
                                   to send that link for the Mentee.</p>
                            </div>
                             @if (empty($userMentorTransaction))
                            <div class="row">
                                <div class="col-md-4"><a target="_blank" href="https://us05web.zoom.us/meeting/schedule" class="btn btn-block btn-primary"><i class="fa fa-stream mr-2"></i>Zoom</a></div>
                                <div class="col-md-4"><a target="_blank" href="https://meet.google.com/"  class="btn btn-block btn-primary"><i class="fab fa-google mr-2"></i>Meet</a></div>
                                <div class="col-md-4"><a target="_blank" href="https://www.microsoft.com/en-us/microsoft-teams/group-chat-software"  class="btn btn-block btn-primary"><i class="fab fa-windows mr-2"></i>Teams</a></div>
                            </div>
                            @else
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-6"><button id="approve"  class="btn btn-block btn-success">Approve Booking</button></div>
                                <div class="col-md-6"><button id="cancel"  class="btn btn-block btn-danger">Cancel Booking</button></div>
                            </div>
                            @endif
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    @else
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
                              <div class="callout callout-info">

                                <p>Mentor will send the link to your meetings for this chat.</p>

                              </div>
                              <div class="row">
                                    @if (Auth()->user()->streaming_count>0 && empty($userTransaction)|| $teacher->level < $setting->paid_level)
                               <div class="col-md-6"> <button class="btn btn-success" id="request_link">Booking</button></div>

                                <div class="col-md-6">
                                    <select id="start_time" class="form-control">
                                        @foreach ($teacher->shadules as $shadule)
                                            <option>{{$shadule->schedule_date}} {{  $shadule->start_time}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @elseif(!empty($userTransaction))
                                       <div class="col-md-6"> <button class="btn btn-danger" id="cancel_request">Cancel Booking</button></div>
                                @endif
                              </div>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                    </div>

                @endif --}}

            </div>
        </div>
    </section>


      <!-- /.modal -->
      <div class="modal fade" id="modal-md1">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="text-transform: capitalize">{{$conversation->mentor->user->name}} Notes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-sm-9">
                                {{-- <label>Any Comments</label> --}}
                                <input id="stikey_1"  name="question3" class="form-control" required/>
                                    {{-- @foreach ($conversation->mentor->stikey as $stikey)
                                    @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                                    {{$stikey->note}}
                                    @endif
                                    @endforeach --}}
                                <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                            </div>
                            <div class="form-group col-sm-3">
                                {{-- <label>Any Comments</label> --}}
                                <button onclick="saveNote1('{{$conversation->mentor->id}}');" class="btn btn-success">Save</button>
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                       @foreach ($conversation->mentor->stikey as $stikey)
                                     @if ($stikey->user_id == Auth()->user()->id)
                                     <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$stikey->note}}</td>
                                        <td>@displayDate($stikey->updated_at)</td>
                                        <td >
                                              {{-- <a href="" class="btn btn-sm btn-warning" id="goal">Update</a> --}}
                                              <button type="button" onclick="del_stikey1('{{$stikey->id}}');" class="btn btn-sm btn-danger" id="del_{{$stikey->id}}">Delete</button>
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

            {{-- <div class="modal-footer justify-content-between btn-group">
            <button  type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

      <!-- /.modal -->
      <div class="modal fade" id="modal-md2">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="text-transform: capitalize">{{$conversation->mentee->user->name}} Notes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-sm-9">
                                {{-- <label>Any Comments</label> --}}
                                <input id="stikey_2"  name="question3" class="form-control" required/>
                                    {{-- @foreach ($conversation->mentor->stikey as $stikey)
                                    @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                                    {{$stikey->note}}
                                    @endif
                                    @endforeach --}}
                                <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                            </div>
                            <div class="form-group col-sm-3">
                                {{-- <label>Any Comments</label> --}}
                                <button onclick="saveNote2('{{$conversation->mentee->id}}');" class="btn btn-success">Save</button>
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                       @foreach ($conversation->mentee->stikey as $stikey)
                                     @if ($stikey->user_id == Auth()->user()->id)
                                     <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$stikey->note}}</td>
                                        <td>@displayDate($stikey->updated_at)</td>
                                        <td >
                                              {{-- <a href="" class="btn btn-sm btn-warning" id="goal">Update</a> --}}
                                              <button type="button" onclick="del_stikey2('{{$stikey->id}}');" class="btn btn-sm btn-danger" id="del_{{$stikey->id}}">Delete</button>
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

            {{-- <div class="modal-footer justify-content-between btn-group">
            <button  type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
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
                url: "{{route('chat.store_mentor_message')}}" ,
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
            })
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
            $.post('{{route('chat.mentor_message_list')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    last_id: last_id
                }, function (data, status) {
                    var jo = JSON.parse(data);
                    if (jo.error == true) {
                        alert("Failed Load Message");
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
            $.post('{{route('teacher.request_meeting')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    start_time:$('#start_time option:selected').val()
                }, function (data, status) {
                      if(data.error==false){
                    window.location="{{route('teacher.view_mentor_conversation',$id)}}";
                }
            });
             }
        }
        function cancelLink(){
             //alert("Update Chat");
             if (confirm("Are you sure?") == true) {
            $.post('{{route('teacher.cancel_meeting')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}}
                }, function (data, status) {
                      if(data.error==false){
                    window.location="{{route('teacher.view_mentor_conversation',$id)}}";
                }
            });
             }
        }

         $('#approve').click(function(){
            approveReq();
        });
        $('#cancel').click(function(){
            cancelReq();
        });
        function approveReq() {
            //alert("Update Chat");
            if (confirm("Are you sure?") == true) {
               $.post('{{route('teacher.approve_mentor_request')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    last_id: last_id
                }, function (data, status) {
                   // var jo = JSON.parse(data);
                    if (data.error == false) {
                        window.location="{{route('teacher.view_mentor_conversation',$id)}}";
                       //alert(data.flag);
                  }
                });
            }


        }
        function cancelReq() {
            //alert("Update Chat");
            if (confirm("Are you sure?") == true) {
            $.post('{{route('teacher.cancel_mentor_request')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    last_id: last_id
                }, function (data, status) {
                   // var jo = JSON.parse(data);
                    if (data.error == false) {
                        window.location="{{route('teacher.view_mentor_conversation',$id)}}";
                    }
            });
            }
        }


        //---------------------------------------------------------------------------------------
function saveNote1(id){

if( $('#stikey_1').val()!=""){
 $.post("{{route('user.update_stikey')}}",
     {
         id: id,
         note: $('#stikey_1').val(),
         _method: "PUT",
         _token: "{{ csrf_token() }}"
     },
     function(data, status){
         if(data.success==true){
             console.log('success');
             window.location="{{route('teacher.view_mentor_conversation',$id)}}";
         }
     });
}else{
 alert("Note can't be null !");
}
 //alert('test');
}

function saveNote2(id){

if( $('#stikey_2').val()!=""){
 $.post("{{route('user.update_stikey')}}",
     {
         id: id,
         note: $('#stikey_2').val(),
         _method: "PUT",
         _token: "{{ csrf_token() }}"
     },
     function(data, status){
         if(data.success==true){
             console.log('success');
             window.location="{{route('teacher.view_mentor_conversation',$id)}}";
         }
     });
}else{
 alert("Note can't be null !");
}
 //alert('test');
}

function del_stikey1(id){

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
             window.location="{{route('teacher.view_mentor_conversation',$id)}}";
         }
     });
 }

}
function del_stikey2(id){

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
             window.location="{{route('teacher.view_mentor_conversation',$id)}}";
         }
     });
 }

}
    </script>
@endpush
