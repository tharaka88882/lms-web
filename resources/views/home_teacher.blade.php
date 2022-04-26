@extends('layouts.app')

@section('title')
    Dashboard | YOU2MENTOR
@endsection



@section('content')

    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard </li>
              </ol>
            </div>
          </div>
        </div>
      </section> --}}

      {{-- <!-- Main content -->
      <section class="content"> --}}

         <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div style="font-size:15px; text-align:center;" class="alert alert-warning">
              Thanks for signing up. We will be launching officially soon and will notify you once we are live. In the meantime our pilot is running, so update your profile, explore and check out the RSS feed curated for your development.
              <br/>
              We would love to hear feedback on how we can improve your experience, <a href="https://you2mentor.com/contact/" target="_blank">so drop us a note through here</a>
              <br/>
              <span style="color:black; font-size:larger;">
                You can follow us on &nbsp;&nbsp;<a href="https://www.linkedin.com/company/you2mentor/" target="_blank"><i class="bi bi-linkedin"></i></a> &nbsp;&nbsp; <a href="https://www.twitter.com/You2Mentor" target="_blank" ><i class="bi bi-twitter"></i></a> &nbsp;&nbsp; <a href="https://www.instagram.com/You2Mentor/" target="_blank"><i class="bi bi-instagram"></i></a>
              </span>
            </div>
          </div>
          <div class="col-sm-6">
            <h1 class="m-0">My Dashboard</h1>
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Teacher Dashboard</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        @if ((Auth::user()->userable->status)=='0')
            <div class="row">
                <div class="col-md-7" style="margin-top: 42px">
                        <div class="card card-default">
                          <div class="card-header">
                            <h3 class="card-title">
                              <i class="fas fa-bullhorn"></i>
                              Notice
                            </h3>
                          </div>
                          <!-- /.card-header -->

                          <div class="card-body">
                            <div class="callout callout-info">
                              <h5>Mentor is not Active</h5>

                              <p>At the moment your Mentor request either pending or Banned.<br>
                                  If you just registed for <strong> YOU2MENTOR</strong> please wait for a moment.
                                  Your request is currently reviewing by the Admin.</p>
                           </div>
                         </div>

                          <!-- /.card-body -->
                </div>
                        <!-- /.card -->

               </div>
            </div>
        @else
            <div class="row">
                  <!-- ./col -->
                {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{Auth()->user()->streaming_count}}</h3>

                      <p>Available Streams</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-chatbox"></i>
                    </div>
                    <a href="{{ route('teacher.payment_history') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div> --}}
                {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{$schedule_count}}</h3>

                      <p>My Schdule</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-list"></i>
                    </div>
                    <a href="{{route('teacher.schedule_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div> --}}

                <!-- ./col -->
                 <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner">
                      <h3>{{$my_students_count}}</h3>

                      <p>My Mentees</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-people-outline"></i>
                    </div>
                    <a href="{{route('teacher.conversation_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>


                <!-- ./col -->
                 <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner">
                      <h3>{{$my_teachers_count}}</h3>

                      <p>My Mentors</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-people-outline"></i>
                    </div>
                    <a href="{{route('teacher.mentor_conversation_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
            {{--    <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner">
                      <h3>{{$subject_count}}</h3>

                      <p>Mentoring Topics/Professions</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-book"></i>
                    </div>
                    <a href="{{route('teacher.my_subject')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>--}}
                <!-- ./col -->
                <!-- ./col -->
               {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner">
                      <h3>{{$convo_count}}</h3>

                      <p>Conversations</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-chatbubbles"></i>
                    </div>
                    <a href="{{route('teacher.mentor_conversation_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>--}}
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner">
                      <h3>{{$teachers_count}}</h3>

                      <p>Find Mentors</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-people"></i>
                    </div>
                    <a href="{{route('teacher.mentors')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner">
                      <h3>{{$my_subject_count}}</h3>

                      <p>My Skills</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-graduation-cap"></i>
                    </div>
                    <a href="{{route('teacher.my_subject')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light">

                      <div class="inner">
                      <p style="margin-bottom: 3px;">My Development</p>
                        <div class="row">
                          <div class="col-4 border-right">
                            <div class="description-block">
                              <h5 class="description-header">{{$completed_milestones_count}}</h5>
                              <p style="color:green; font-size: 9px;">Completed</p>
                              <!-- <span class="description-text">Completed</span> -->
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-4 border-right">
                            <div class="description-block">
                              <h5 class="description-header">{{$inprogress_milestones_count}}</h5>
                              <p style="color:rgb(255, 153, 0); font-size: 8px;">In Progress</p>
                              <!-- <span class="description-text">In Progress</span> -->
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-4">
                            <div class="description-block">
                              <h5 class="description-header">{{$overdue_milestones_count}}</h5>
                              <p style="color:red; font-size: 9px;">Overdue</p>
                              <!-- <span class="description-text">Overdue</span> -->
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                        </div>
                      </div>

                    <!-- <div class="row">
                    <div class="small-box bg-light">
                      <div class="inner">
                        <h3>{{$my_milestones_count}}</h3>

                        <p>Completed</p>
                      </div>
                  </div>
                  <div class="small-box bg-light">
                      <div class="inner">
                        <h3>{{$my_milestones_count}}</h3>

                        <p>In Progess</p>
                      </div>
                  </div>
                  <div class="small-box bg-light">
                      <div class="inner">
                        <h3>{{$my_milestones_count}}</h3>

                        <p>Overdue</p>
                      </div>
                  </div>
                  </div> -->
                      <!-- <div class="icon">
                        <i class="fas fa-flag"></i>
                      </div> -->
                      <a href="{{route('user.milestone')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-light">
                    <div class="inner" style="margin-bottom: 27px;">
                      <p>My Rating</p>
                      @php
                          $i = 0;
                          //$r = intval(Auth()->user()->userable->level);
                          $r = $round_mediation;
                      @endphp
                        @while ($i<5)
                            @if ($r>0)
                            <span class="fa fa-star checked"></span>
                            @else
                            <span class="fa fa-star"></span>

                            @endif
                           @php
                            $i += 1;
                            $r -=1;
                            @endphp
                        @endwhile

                    {{-- <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> --}}
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-star-half"></i>
                    </div>
                    <a href="{{route('user.view_rating')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
              </div>

      <div class="row">
          <!--<div class="col-md-8">-->
                 <!-- Main content -->
          <!--       <div class="card card-primary">-->
          <!--        <div class="card-body p-2">-->
                    <!-- THE CALENDAR -->
          <!--          <div id="calendar"></div>-->
          <!--        </div>-->
                  <!-- /.card-body -->
          <!--      </div>-->
          <!--</div>-->
          <div class="col-lg-8">
                {{-- <div class="info-box shadow">
                  <span class="info-box-icon bg-success"><i class="fa fa-dollar-sign"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Available Balance</span>
                    <span class="info-box-number">${{Auth()->user()->userable->amount}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box --> --}}

                {{-- <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-book-open"></i>
                       My Expertise
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <ul>
                      @foreach($subjects as $subject)
                      <li>{{$subject->name}}</li>
                      @endforeach
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div> --}}
          </div>

      <!--    <div class="col-md-6">-->
              <!-- Default box -->
      <!--        <div class="card-primary">-->
      <!--          <div class="card-header">-->
      <!--            <h3 class="card-title">Booked Schedule List</h3>-->

      <!--            <div class="card-tools">-->

      <!--            </div>-->
      <!--          </div>-->
      <!--          <div class="card-body">-->
      <!--              <div class="table-responsive">-->
      <!--                <table class="table ">-->
      <!--                    <thead>-->
      <!--                        <tr>-->
      <!--                            <th>ID</th>-->
      <!--                            <th>Name</th>-->
      <!--                            <th>NIC</th>-->
      <!--                            <th>Status</th>-->
      <!--                            <th>Action</th>-->
      <!--                        </tr>-->
      <!--                    </thead>-->
      <!--                    <tbody>-->
      <!--                        @foreach($pending_teachers_list as $teacher)-->
      <!--                        <tr>-->
      <!--                            <td>{{$teacher->id}}</td>-->
      <!--                            <td>{{$teacher->user->name}}</td>-->
      <!--                            <td>{{$teacher->nic}}</td>-->
      <!--                            <td><h5><span class="badge badge-secondary">{{$teacher->status==('1')? 'Approved':'Pending'}}</span><h5></td>-->
      <!--                            <td>-->
      <!--                                <a class="btn btn-sm btn-warning" href="{{route('admin.edit_teacher', $teacher->id)}}"><i class="far fa-edit"></i> Approve</a>-->
      <!--                          </td>-->
      <!--                        </tr>-->
      <!--                        @endforeach-->
      <!--                    </tbody>-->
      <!--                </table>-->

      <!--              </div>-->
      <!--          </div>-->
                <!-- /.card-body -->
      <!--          <div class="card-footer">-->
      <!--          </div>-->
                <!-- /.card-footer-->
      <!--        </div>-->
              <!-- /.card -->
      <!--</div>-->
      </div>

        @endif


        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

@endsection

@push('scripts')

<!-- Page specific script -->
<script>
 $(function () {

/* initialize the external events
 -----------------------------------------------------------------*/
function ini_events(ele) {
  ele.each(function () {

    // create an Event Object (https://fullcalendar.io/docs/event-object)
    // it doesn't need to have a start or end
    var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
    }

    // store the Event Object in the DOM element so we can get to it later
    $(this).data('eventObject', eventObject)

    // make the event draggable using jQuery UI
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
var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()

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
    left  : 'prev,next today',
    center: 'title',
    right : 'dayGridMonth,timeGridWeek,timeGridDay'
  },
  themeSystem: 'bootstrap',
  //Random default events
  events: [
    @foreach ($schedules as $schedule)
    @php
        $date_s = explode('-',$schedule->schedule_date);
         $time_s = explode(':', $schedule -> start_time);
         $time_e = explode(':', $schedule -> end_time);
    @endphp
        {
        title          : '{{$schedule->name}}',
        start          : new Date('{{$date_s[0].'-'.$date_s[1].'-'.$date_s[2].' '.$time_s[0].':'.$time_s[1].':'.$time_s[2]}}'), //{{$date_s[0].' '.$date_s[1].' '.$date_s[2]}}
        end            : new Date('{{$date_s[0].'-'.$date_s[1].'-'.$date_s[2].' '.$time_e[0].':'.$time_e[1].':'.$time_e[2]}}'), //{{$date_s[0].' '.$date_s[1].' '.$date_s[2]}}        backgroundColor: '#00a65a', //green
        borderColor    : '#00a65a', //green
        url            :  "#",
        allDay         : false
        },
        @endforeach

  ],
  editable  : false,
  droppable : false, // this allows things to be dropped onto the calendar !!!
  drop      : function(info) {
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
$('#color-chooser > li > a').click(function (e) {
  e.preventDefault()
  // Save color
  currColor = $(this).css('color')
  // Add color effect to button
  $('#add-new-event').css({
    'background-color': currColor,
    'border-color'    : currColor
  })
})
$('#add-new-event').click(function (e) {
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
    'border-color'    : currColor,
    'color'           : '#fff'
  }).addClass('external-event')
  event.text(val)
  $('#external-events').prepend(event)

  // Add draggable funtionality
  ini_events(event)

  // Remove event from text input
  $('#new-event').val('')
})
})
</script>
@endpush
