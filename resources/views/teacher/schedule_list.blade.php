<!-- Content Wrapper. Contains page content -->
@extends('layouts.app')

@section('title')
    Schedule List
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
@endpush

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Schedule List</li>
            </ol>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- <div class="card-tools">
            <a class="btn btn-block btn-primary" href="{{route('teacher.create_schedule')}}">Add New</a>

          </div> --}}
        <div class="row">


          <!-- /.col -->
          <div class="col-md-10">
            <div class="card card-primary">
              <div class="card-body p-2">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-3">

        </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="content">
        <div class="card-body">
            <div class="table-responsive">
              <table class="table ">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Date</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($schedules as $schedule)
                      <tr>
                          <td>{{$schedule->id}}</td>
                          <td>{{$schedule->name}}</td>
                          <td>{{$schedule->description}}</td>
                          <td>{{$schedule->schedule_date}}</td>
                          <td>{{$schedule->start_time}}</td>
                          <td>{{$schedule->end_time}}</td>
                          <td><h5><span class="badge badge-secondary">{{$schedule->status==('1')? 'Active':'Inactive'}}</span><h5></td>
                          <td><a href="{{route('teacher.edit_schedule',$schedule->id)}}" id="removeBtn" class="btn btn-sm btn-warning">Edit</a></td>
                      </tr>

                      @endforeach
                  </tbody>
              </table>

            </div>
        </div>
        <!-- /.card-body -->

    </section>

    @endsection
@push('scripts')

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
                $date_s = explode('-', $schedule -> schedule_date);
                $time_s = explode(':', $schedule -> start_time);
                $time_e = explode(':', $schedule -> end_time);
        @endphp
        {
                title          : '{{$schedule->name}}',
                //start          : new Date('{{$date_s[0].'-'.$date_s[1].'-'.$date_s[2]}}'), //{{$date_s[0].' '.$date_s[1].' '.$date_s[2]}}
                start          : new Date('{{$date_s[0].'-'.$date_s[1].'-'.$date_s[2].' '.$time_s[0].':'.$time_s[1].':'.$time_s[2]}}'), //{{$date_s[0].' '.$date_s[1].' '.$date_s[2]}}
                end            : new Date('{{$date_s[0].'-'.$date_s[1].'-'.$date_s[2].' '.$time_e[0].':'.$time_e[1].':'.$time_e[2]}}'), //{{$date_s[0].' '.$date_s[1].' '.$date_s[2]}}
                backgroundColor: '#00a65a', //green
                borderColor    : '#00a65a', //green
                url            :  "#",
                allDay         : false
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
