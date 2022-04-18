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
                                                onerror="this.src='http://test105.nawalokacare.com/assets/client/images/default-picture.png'"
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
               {{-- <div class="col-md-5" style="margin-top: 42px">
                       <div class="card card-default">
                         <div class="card-header">
                           <h3 class="card-title">
                             <i class="fas fa-bullhorn"></i>
                             Notice.!
                            </h3>
                          </div>
                          <!-- /.card-header -->

                          <div class="card-body">
                             @if (empty($userTransaction))
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
                            @endif

                          </div>

                          <!-- /.card-body -->
                    </div>
                        <!-- /.card -->

                </div> --}}
            </div>
        </div>
    </section>
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

    </script>
@endpush
