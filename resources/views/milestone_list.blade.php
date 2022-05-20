@extends('layouts.app')

@section('title')
    Milestones
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@endpush

@section('content')

  <section class="content-header">
  <!-- general form elements -->
  <div class="container-fluid">

    <div class="row">
        <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Milestone Timeline</h3>
            </div>
            <div class="card-body">
                {{-- black arrow --}}
            <ul id="progress">
                <li style="cursor: pointer" title="Due Date: 17/05/2022" class="active"><i class="fa fa-check"></i> Task 2</li>
                <li style="cursor: pointer" title="Due Date: 18/05/2022" class="active"><i class="fa fa-check"></i> Task 1</li>
                <li style="cursor: pointer" title="Due Date: 19/05/2022">Task 3</li>
                <li style="cursor: pointer" title="Due Date: 21/05/2022">Task 4</li>
                <li style="cursor: pointer" title="Due Date: 25/05/2022">Task 5</li>
                <li style="cursor: pointer" title="Due Date: 27/05/2022">Task 6</li>
                <li style="cursor: pointer" title="Due Date: 27/05/2022">Task 7</li>
                <li style="cursor: pointer" title="Due Date: 27/05/2022">Task 8</li>
                <li style="cursor: pointer" title="Due Date: 27/05/2022">Task 9</li>
                <li style="cursor: pointer" title="Due Date: 27/05/2022">Task 10</li>
            </ul>
            {{-- End of black arrow --}}
            {{-- Green Balls --}}


            {{-- End of Green Balls --}}

        </div>
        </div>
    </div>

    </div>


  <div class="row">
    <div class="col-md-6">
        <!-- small box -->
        <div class="small-box bg-light">
            <div class="inner">
            <p style="margin-bottom: 3px; font-size: 14px;">My Development</p>
              <div class="row">
                <div class="col-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$completed_milestones_count}}</h5>
                    <p style="color:green; font-size: 11px;">Completed</p>
                    <!-- <span class="description-text">Completed</span> -->
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$inprogress_milestones_count}}</h5>
                    <p style="color:rgb(255, 153, 0); font-size: 11px;">In Progress</p>
                    <!-- <span class="description-text">In Progress</span> -->
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <div class="description-block">
                    <h5 class="description-header">{{$overdue_milestones_count}}</h5>
                    <p style="color:red; font-size: 11px;">Overdue</p>
                    <!-- <span class="description-text">Overdue</span> -->
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
            </div>
            {{-- <a href="{{route('user.milestone')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
          </div>
    </div>
    <div class="col-md-6">
        <div class="callout callout-warning">
            <p>Please note development goals are appeared in your profile and, however actions within goals are private.</p>
          </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Add Milestone</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('user.milestone_create')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="Milestone">Milestone Note</label>
                        <input type="text" class="form-control @if($errors->has('note')) {{'is-invalid'}} @endif" id="note" name="note" placeholder="Milestone Note">

                        @if($errors->has('note'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('note') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Milestone">Due Date</label>
                        <input type="date" class="form-control @if($errors->has('due_date')) {{'is-invalid'}} @endif" id="due_date" name="due_date" placeholder="Milestone Due Date">

                        @if($errors->has('due_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('due_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success pull-right">Add</button>
                </div>
            </form>
        </div>
  </div>
  <div class="col-md-6">

  </div>

  <!-- /.card -->
  </div>
  </div>
  </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
      <!-- Default box -->
      <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Milestone List</h3>
        </div>
        <div class="card-body">
            <div class="container col-md-12">
                {{-- <h2>Stacked Progress Bars</h2>
                <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> --}}
                <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" style="width:{{$completed}}%">
                    Completed
                  </div>
                  <div class="progress-bar progress-bar-warning" role="progressbar" style="width:{{$in_progress}}%">
                    In Progress
                  </div>
                  <div class="progress-bar progress-bar-danger" role="progressbar" style="width:{{$overdue}}%">
                    Overdue
                  </div>
                </div>
              </div>

            <div class="table-responsive">
              <table class="table ">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Goals</th>
                          <th>Created On</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($milestones as $milestone)
                      <tr>
                          <td>{{$i}}</td>
                          <td>{{$milestone->note}}</td>
                          <td>{{ \Carbon\Carbon::parse($milestone->created_at)->format('d-m-Y')}}</td>
                          <td>
                                @php
                                    ($date_facturation = \Carbon\Carbon::parse($milestone->due_date))
                                @endphp
                                @if ($date_facturation->isPast())
                                    <span class="badge" style="background-color: red;">
                                @else
                                    <span class="badge" style="background-color: green;">
                                @endif
                                {{ \Carbon\Carbon::parse($milestone->due_date)->format('d-m-Y')}}</span>

                          </td>
                          <td>
                             <select onchange="update_milestone('{{ $milestone->id}}')" id='status-{{ $milestone->id}}' class="form-control">
                                 <option {{$milestone->status==1?'selected="true"':''}}  value="1">Completed</option>
                                 <option {{$milestone->status==2?'selected="true"':''}} value="2">In progress</option>
                                 <option disabled="" {{$milestone->status==3?'selected="true"':''}} value="3">Overdue</option>
                                 <option {{$milestone->status==0?'selected="true"':''}} value="0">Cancelled</option>
                             </select>
                          </td>
                          <td style="float: left;">
                            <div class="col-xs-6 p-1">
                                <a href="{{route('user.notes',$milestone->id)}}" class="btn btn-sm btn-success float-right" id="goal">Tasks</a>
                            </div>
                            <div class="col-xs-6 p-1">
                                <button type="button" class="btn btn-sm btn-danger pull-left" id="deleteBtn-{{$milestone->id}}">Delete</button>
                                <form action="{{route('user.milestone_delete', $milestone->id)}}" id="deleteform-{{$milestone->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
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
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      </div>
        </div>
      </section>
@endsection

@push('scripts')
  <script>
        $(document).on('click','[id^=deleteBtn-]', function() {
            var num = this.id.split('-')[1];
            if (confirm("Are you sure?") == true) {
                $('#deleteform-'+num).submit();
            }
        });


function update_milestone(id){

    if (confirm("Are you sure?") == true) {
        $.post("{{route('user.update_milestone')}}",
        {
            id: id,
            status: $('#status-'+id+' option:selected').val(),
            _method: "put",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                window.location="{{route('user.milestone')}}";
            }
        });
}
}
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
