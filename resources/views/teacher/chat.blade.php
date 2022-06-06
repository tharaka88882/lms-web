@extends('layouts.app')

@section('title')
    Update Teacher Chat
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
                            <h3 class="box-title" style="text-transform: capitalize">Direct Chat - {{$conversation->student->user->name}}</h3>
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
                                                <span class="direct-chat-name pull-left">{{$message->sender->name}}</span>
                                                <small class="direct-chat-timestamp float-right">{{$message->created_at->format('y/m/d h:i')}}</small>
                                            </div>
                                            <!-- /.direct-chat-info -->
                                            <img class="direct-chat-img"
                                                @if ($message->sender->image != null) src="{{url('public')}}/images/profile/{{ $message->sender->image }}" @else src="" @endif
                                                onerror="this.src='https://login.you2mentor.com/public/images/def.jpg'"
                                                >
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
               <div class="col-md-5" style="margin-top: 42px">
                       <div class="card card-default">
                         <div class="card-header">
                           <h3 class="card-title">
                             <i class="fas fa-bullhorn"></i>
                             Notice.!
                            </h3>
                          </div>
                          <!-- /.card-header -->

                          <div class="card-body">
                            <div class="callout callout-danger">
                                <p>Don't share personal details etc.
                                </p>
                            </div>


                             {{-- @if (empty($userTransaction))
                             <div class="callout callout-info">
                                <h5>Follow the Instrctions</h5>

                                <p>Click the service that you want to create a meeting from following buttons. Create a meeting from
                                    that service. Then copy and paste that meeting link in the chat. Press send or Enter key
                                     to send that link for the Mentee.</p>
                              </div>
                            <div class="row">
                                <div class="col-md-4"><a target="_blank" href="https://us05web.zoom.us/meeting/schedule" class="btn btn-block btn-primary"><i class="fa fa-stream mr-2"></i>Zoom</a></div>
                                <div class="col-md-4"><a target="_blank" href="https://meet.google.com/"  class="btn btn-block btn-primary"><i class="fab fa-google mr-2"></i>Meet</a></div>
                                <div class="col-md-4"><a target="_blank" href="https://www.microsoft.com/en-us/microsoft-teams/group-chat-software"  class="btn btn-block btn-primary"><i class="fab fa-windows mr-2"></i>Teams</a></div>
                            </div>
                            @else
                            <div class="callout callout-info">
                                <h5>This Mentee has Requested a Meeting</h5>

                                <p>Mentee has requested a Video Meeting with you. You can fix everything and Approve it or
                                    simply Cancel it from here.
                                </p>
                              </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-6"><button id="approve"  class="btn btn-block btn-success">Approve Booking</button></div>
                                <div class="col-md-6"><button id="cancel"  class="btn btn-block btn-danger">Cancel Booking</button></div>
                            </div>
                            @endif --}}

                          </div>

                          <!-- /.card-body -->
                    </div>
                        <!-- /.card -->
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                  <i class="fas fa-list"></i>
                                      Mentee developments goals
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
                              <button data-toggle="modal" data-target="#modal-md" class="btn btn-s btn-warning">Note</button>
                             </div>
                          </div>

                </div>
            </div>
        </div>
    </section>

      <!-- /.modal -->
      <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-transform: capitalize">{{$conversation->student->user->name}} Notes</h4>
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
                        <input id="stikey_"  name="question3" class="form-control" required/>
                            {{-- @foreach ($conversation->mentor->stikey as $stikey)
                            @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                            {{$stikey->note}}
                            @endif
                            @endforeach --}}
                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <label>Any Comments</label> --}}
                        <button onclick="saveNote('{{$conversation->student->id}}');" class="btn btn-success">Save</button>
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
                                    <th>Stikey Note</th>
                                    <th>Date Added</th>
                                    <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                               @foreach ($conversation->student->stikey as $stikey)

                               <tr>
                                <td>{{$i}}</td>
                                <td>{{$stikey->note}}</td>
                                <td>{{$stikey->updated_at}}</td>
                                <td >

                                      {{-- <a href="" class="btn btn-sm btn-warning" id="goal">Update</a> --}}


                                      <button type="button" onclick="del_stikey('{{$stikey->id}}');" class="btn btn-sm btn-danger" id="del_">Delete</button>


                                </td>
                            </tr>
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
            $.post('{{route('chat.message_list')}}', {
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
        setInterval(updateChat, 5000);

        updateChat();

        $('#approve').click(function(){
            approveReq();
        });
        $('#cancel').click(function(){
            cancelReq();
        });
        function approveReq() {
            //alert("Update Chat");
            if (confirm("Are you sure?") == true) {
               $.post('{{route('teacher.approve_request')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    last_id: last_id
                }, function (data, status) {
                   // var jo = JSON.parse(data);
                    if (data.error == false) {
                        window.location="{{route('teacher.view_conversation',$id)}}";
                      //  alert(data.flag);
                  }
                });
            }


        }
        function cancelReq() {
            //alert("Update Chat");
            if (confirm("Are you sure?") == true) {
            $.post('{{route('teacher.cancel_request')}}', {
                    _method: "POST",
                    _token: "{{csrf_token()}}",
                    conversation_id: {{$id}},
                    last_id: last_id
                }, function (data, status) {
                   // var jo = JSON.parse(data);
                    if (data.error == false) {
                        window.location="{{route('teacher.view_conversation',$id)}}";
                    }
            });
            }
        }
function saveNote(id){

if( $('#stikey_').val()!=""){
 $.post("{{route('user.update_mentee_stikey')}}",
     {
         id: id,
         note: $('#stikey_').val(),
         user:'mentee',
         _method: "PUT",
         _token: "{{ csrf_token() }}"
     },
     function(data, status){
         if(data.success==true){
             console.log('success');
             window.location="{{route('teacher.view_conversation',$id)}}";
         }
     });
}else{
 alert("Stikey note can't be null !");
}
 //alert('test');
}

function del_stikey(id){
 //$(document).keyup(function (e) {
    //  console.log(e.keyCode);
    //alert(e.keyCode);
// if(e.keyCode==13){
 if (confirm("Are you sure?") == true) {
     $.post("{{route('user.distory_mentor_stikey')}}",
     {
         id: id,
         user: 'mentee',
         _method: "delete",
         _token: "{{ csrf_token() }}"
     },
     function(data, status){
         if(data.success==true){
             console.log('success');
             window.location="{{route('teacher.view_conversation',$id)}}";
         }
     });
 }
 //alert('saved');

// }
  // });


}

    </script>
@endpush
