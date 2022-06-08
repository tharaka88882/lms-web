@extends('layouts.app')



@section('title')
    Mentor Profile
@endsection



@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush



@section('content')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-7">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-olive"
                            @if ($teacher->user->cover_image != null) style="background-image: url('{{ url('public') }}/images/profile/{{ $teacher->user->cover_image }}') !important;" @endif>
                            <h3 class="widget-user-username" style="text-transform: uppercase">{{ $teacher->user->name }}
                            </h3>
                            {{-- <a href="{{route('user.view_rating')}}"> --}}
                            @php
                                $i = 0;
                                //$r = intval(Auth()->user()->userable->level);
                                $r = (int) $mediation;
                            @endphp
                            @while ($i < 5)
                                @if ($r > 0)
                                    <span class="fa fa-star checked"></span>
                                @else
                                    <span class="fa fa-star"></span>
                                @endif
                                @php
                                    $i += 1;
                                    $r -= 1;
                                @endphp
                            @endwhile
                            {{-- </a> --}}
                        </div>

                        <div class="widget-user-image">
                            <img class="img-circle elevation-2"
                                onerror="this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                @if ($teacher->user->image != null) src="{{ url('public') }}/images/profile/{{ $teacher->user->image }}" @else src="" @endif
                                alt="User Avatar">
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        {{-- <h5 class="description-header">3,200</h5>
                                        <span class="description-text">SALES</span> --}}
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"></h5>
                                        <span class="description-text"></span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>

                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        {{-- <h5 class="description-header">35</h5>
                                        <span class="description-text">PRODUCTS</span> --}}
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                @if (sizeof($conversations) > 0)
                                    <div class="col-sm-4" style="text-align: left">
                                        <a class="btn btn-success"
                                            href="{{ route('teacher.view_mentor_conversation', $query->id) }}">Connect</a>
                                    </div>

                                    <div class="col-sm-4" style="text-align: center">
                                        <button {{ sizeof($old_ratings) > 0 ? 'disabled' : '' }} data-toggle="modal"
                                            data-target="#modal-md" class="btn btn-warning"><i
                                                class="fa fa-star"></i>Rate Now</button>
                                    </div>

                                    <div class="col-sm-4" style="text-align: right">
                                        {{-- <a class="btn btn-warning" href="{{route('teacher.complaint',$teacher->id)}}">Complaint Mentor</a> --}}
                                    </div>
                                @elseif ($query != null)
                                    <div class="col-sm-12" style="text-align: center">
                                        <a class="btn btn-success"
                                            href="{{ route('teacher.view_mentor_conversation', $query->id) }}">Connect</a>
                                    </div>
                                @else
                                    <div class="col-sm-12" style="text-align: center">
                                        <form action="{{ route('teacher.store_mentor_conversation') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id"
                                                value="{{ Auth()->user()->userable->id }}">
                                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                            <button class="btn btn-success" type="submit">Connect</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-angle-double-down"></i>
                                About me
                            </h3>
                            <br>

                            @if ($teacher->linkedin_link != null)
                                <a href="{{ $teacher->linkedin_link }}" target="_blank">View Linkedin Profile
                                    <i class="fas fa-angle-double-right"></i></a>
                            @endif
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <dl>
                                <dt>Qualifications</dt>
                                <dd>
                                    <ul>
                                    @foreach ($teacher->qualifications as $qualification)
                                    <li><strong>{{$qualification->text}}</strong>
                                        <ul>
                                            <span>{{$qualification->institute->text}}
                                                <br>
                                                <small>Issued {{explode("-",$qualification->start_date)[1]}}-{{explode("-",$qualification->start_date)[0]}}</small>
                                            </span>
                                        </ul>
                                    </li>
                                    @endforeach
                                    </ul>
                                    {{-- {{$teacher->qualification}} --}}
                                </dd>
                                <dt>Experience</dt>
                                <dd>
                                    <ul>
                                     @foreach ($teacher->experiences as $experience)
                                     <li><strong>{{$experience->position->text}}</strong>
                                        <ul>
                                            <span>{{$experience->institute->text}}
                                                <br>
                                                <small>{{explode("-",$experience->start_date)[1]}}/{{explode("-",$experience->start_date)[0]}} @if ($experience->end_date!=null) - {{explode("-",$experience->end_date)[1]}}/{{explode("-",$experience->end_date)[0]}} @endif</small>
                                            </span>
                                        </ul>
                                    </li>
                                     @endforeach
                                    </ul>
                                </dd>
                                <dt>Skills</dt>
                                <dd>{{ $teacher->skills }}</dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="float-right">
                                <b>Average Responce time: </b> {{ $time_total_array }}hrs
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                {{-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-tasks"></i>
                              Schedule
                            </h3>
                          </div>
                        <div class="card-body p-2">
                          <!-- THE CALENDAR -->
                          <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div> --}}
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-book-open"></i>
                            Mentoring Topics
                        </h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <ul>
                            @foreach ($subjects as $subject)
                                <li>{{ $subject->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->

    </section>


    <!-- /.modal -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new Rating</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @csrf
                <input type="hidden" name="milestone_id" value="" />
                <div class="modal-body">
                    <div class="form-group">
                        <label>How would you rate your overall experience with the mentor</label>
                        <!-- <input type="text" name="text" class="form-control" placeholder="Type Here"> -->
                        <div>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st1"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st2"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st3"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st4"></span>
                            <span class="fa fa-star" style="cursor: pointer" aria-hidden="true" id="st5"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Was your quection answered?</label>
                        <div class="form-check">
                            <input id="radio1" class="form-check-input" type="radio" name="radio1" value="1" checked="">
                            <label class="form-check-label">Yes</label><br>
                            <input id="radio2" class="form-check-input" type="radio" value="0" name="radio1">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Any Comments</label>
                        <textarea id="question3" name="question3" class="form-control" column="3" rows="2" required></textarea>
                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                    </div>
                    <div class="modal-footer justify-content-between btn-group">
                        <button onclick="store_rating('{{ $teacher->id }}');" type="submit"
                            class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            $(function() {



                /* initialize the external events

                 -----------------------------------------------------------------*/

                function ini_events(ele) {

                    ele.each(function() {



                        // create an Event Object (https://fullcalendar.io/docs/event-object)

                        // it doesn't need to have a start or end

                        var eventObject = {

                            title: $.trim($(this).text()) // use the element's text as the event title

                        }



                        // store the Event Object in the DOM element so we can get to it later

                        $(this).data('eventObject', eventObject)



                        // // make the event draggable using jQuery UI

                        // $(this).draggable({

                        //   zIndex        : 1070,

                        //   revert        : true, // will cause the event to go back to its

                        //   revertDuration: 0  //  original position after the drag

                        // })



                    })

                }



                ini_events($('#external-events div.external-event'))



                /* initialize the calendar

                 -----------------------------------------------------------------*/

                //Date for the calendar events (dummy data)

                var date = new Date()

                var d = date.getDate(),

                    m = date.getMonth(),

                    y = date.getFullYear()



                var Calendar = FullCalendar.Calendar;

                //  var Draggable = FullCalendar.Draggable;



                var containerEl = document.getElementById('external-events');

                var checkbox = document.getElementById('drop-remove');

                var calendarEl = document.getElementById('calendar');

                // initialize the external events

                // -----------------------------------------------------------------



                // new Draggable(containerEl, {

                //   itemSelector: '.external-event',

                //   eventData: function(eventEl) {

                //     return {

                //       title: eventEl.innerText,

                //       backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),

                //       borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),

                //       textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),

                //     };

                //   }

                // });



                var calendar = new Calendar(calendarEl, {

                    headerToolbar: {

                        left: 'prev,next today',

                        center: 'title',

                        right: 'dayGridMonth,timeGridWeek,timeGridDay'

                    },

                    themeSystem: 'bootstrap',

                    //Random default events

                    events: [

                        @foreach ($schedules as $schedule)

                            @php

                                $date_s = explode('-', $schedule->schedule_date);

                                $time_s = explode(':', $schedule->start_time);

                                $time_e = explode(':', $schedule->end_time);

                            @endphp

                            {

                                title: '{{ $schedule->name }}',

                                start: new Date(
                                    '{{ $date_s[0] . '-' . $date_s[1] . '-' . $date_s[2] . ' ' . $time_s[0] . ':' . $time_s[1] . ':' . $time_s[2] }}'
                                ), //{{ $date_s[0] . ' ' . $date_s[1] . ' ' . $date_s[2] }}

                                end: new Date(
                                    '{{ $date_s[0] . '-' . $date_s[1] . '-' . $date_s[2] . ' ' . $time_e[0] . ':' . $time_e[1] . ':' . $time_e[2] }}'
                                ), //{{ $date_s[0] . ' ' . $date_s[1] . ' ' . $date_s[2] }}                backgroundColor: '#00a65a', //green

                                borderColor: '#00a65a', //green

                                url: "#",

                                allDay: false

                            },
                        @endforeach

                        // ,{

                        //   title          : 'Long Event',

                        //   start          : new Date(y, m, d - 5),

                        //   end            : new Date(y, m, d - 2),

                        //   backgroundColor: '#f39c12', //yellow

                        //   borderColor    : '#f39c12' //yellow

                        // },

                        // {

                        //   title          : 'Meeting',

                        //   start          : new Date(y, m, d, 10, 30),

                        //   allDay         : false,

                        //   backgroundColor: '#0073b7', //Blue

                        //   borderColor    : '#0073b7' //Blue

                        // },

                        // {

                        //   title          : 'Lunch',

                        //   start          : new Date(y, m, d, 12, 0),

                        //   end            : new Date(y, m, d, 14, 0),

                        //   allDay         : false,

                        //   backgroundColor: '#00c0ef', //Info (aqua)

                        //   borderColor    : '#00c0ef' //Info (aqua)

                        // },

                        // {

                        //   title          : 'Birthday Party',

                        //   start          : new Date(y, m, d + 1, 19, 0),

                        //   end            : new Date(y, m, d + 1, 22, 30),

                        //   allDay         : false,

                        //   backgroundColor: '#00a65a', //Success (green)

                        //   borderColor    : '#00a65a' //Success (green)

                        // },

                        // {

                        //   title          : 'Click for Google',

                        //   start          : new Date(y, m, 28),

                        //   end            : new Date(y, m, 29),

                        //   url            : 'https://www.google.com/',

                        //   backgroundColor: '#3c8dbc', //Primary (light-blue)

                        //   borderColor    : '#3c8dbc' //Primary (light-blue)

                        // }

                    ],

                    editable: false,

                    droppable: false, // this allows things to be dropped onto the calendar !!!

                    drop: function(info) {

                        // is the "remove after drop" checkbox checked?

                        if (checkbox.checked) {

                            // if so, remove the element from the "Draggable Events" list

                            info.draggedEl.parentNode.removeChild(info.draggedEl);

                        }

                    }

                });

                calendar.render();

                // $('#calendar').fullCalendar()



                /* ADDING EVENTS */

                var currColor = '#3c8dbc' //Red by default

                // Color chooser button

                $('#color-chooser > li > a').click(function(e) {

                    e.preventDefault()

                    // Save color

                    currColor = $(this).css('color')

                    // Add color effect to button

                    $('#add-new-event').css({

                        'background-color': currColor,

                        'border-color': currColor

                    })

                })

                $('#add-new-event').click(function(e) {

                    e.preventDefault()

                    // Get value and make sure it is not null

                    var val = $('#new-event').val()

                    if (val.length == 0) {

                        return

                    }



                    // Create events

                    var event = $('<div />')

                    event.css({

                        'background-color': currColor,

                        'border-color': currColor,

                        'color': '#fff'

                    }).addClass('external-event')

                    event.text(val)

                    $('#external-events').prepend(event)



                    // Add draggable funtionality

                    ini_events(event)



                    // Remove event from text input

                    $('#new-event').val('')

                })

            })















            var loadImage = function(event) {

                var reader = new FileReader();

                reader.onload = function() {

                    var output = document.getElementById('image-output');

                    output.src = reader.result;

                    output.style.display = "block";

                }

                reader.readAsDataURL(event.target.files[0]);

            }



            $('#ratingInp').change(function() {

                $('#changeRatings').submit();

            });




            // Star Ratings
            var rating_count = 0;

            $(document).ready(function() {
                var st1 = true;
                $("#st1").click(function() {
                    if (st1) {
                        $("#st1").css("color", "rgb(255, 153, 0)");
                        rating_count = 1;
                        st1 = false;
                    } else {
                        $(".fa-star").css("color", "black");
                        rating_count = 0;
                        st1 = true;
                    }


                    //console.log(rating_count);

                });
                var st2 = true;
                $("#st2").click(function() {
                    if (st2) {
                        $("#st1, #st2").css("color", "rgb(255, 153, 0)");
                        rating_count = 2;
                        st2 = false;
                    } else {
                        $(".fa-star").css("color", "black");
                        rating_count = 0;
                        st2 = true;
                    }


                    // console.log(rating_count);

                });
                var st3 = true;
                $("#st3").click(function() {
                    if (st3) {
                        $("#st1, #st2, #st3").css("color", "rgb(255, 153, 0)");
                        rating_count = 3;
                        st3 = false;
                    } else {
                        $(".fa-star").css("color", "black")
                        rating_count = 0;
                        st3 = true;
                    }


                    // console.log(rating_count);

                });

                var st4 = true;
                $("#st4").click(function() {
                    if (st4) {
                        $("#st1, #st2, #st3, #st4").css("color", "rgb(255, 153, 0)");
                        rating_count = 4;
                        st4 = false;
                    } else {
                        $(".fa-star").css("color", "black");
                        rating_count = 0;
                        st4 = true;
                    }
                    // console.log(rating_count);

                });


                var st5 = true;
                $("#st5").click(function() {
                    if (st5) {
                        $("#st1, #st2, #st3, #st4, #st5").css("color", "rgb(255, 153, 0)");
                        rating_count = 5;
                        st5 = false;
                    } else {
                        $(".fa-star").css("color", "black");
                        rating_count = 0;
                        st5 = true;
                    }


                    //  console.log(rating_count);

                });




            });

            function store_rating(id) {
                // console.log("test");
                var q2 = 1;
                if ($('#radio1').is(":checked")) {
                    q2 = 1;

                } else {
                    q2 = 0;
                }

                $.post("{{ route('user.store_rates') }}", {
                        rating: rating_count,
                        question_2: q2,
                        question_3: $('#question3').val(),
                        teacher_id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            window.location = "{{ route('teacher.view_mentor', $teacher->id) }}";
                        }
                    });

            }
        </script>
    @endpush
