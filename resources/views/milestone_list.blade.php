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
  <div class="col-sm-6">
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
  <!-- /.card -->
  </section>
    <!-- Main content -->
    <section class="content">

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
                          <th>Note</th>
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
                          <td>
                              <div class="col-md-6 p-1">
                            <a href="{{route('user.notes',$milestone->id)}}" class="btn btn-success float-right" id="goal">Goals</a>
                </div>
                <div class="col-md-6 p-1">
                            <button type="button" class="btn btn-danger pull-left" id="deleteBtn-{{$milestone->id}}">Delete</button>
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
