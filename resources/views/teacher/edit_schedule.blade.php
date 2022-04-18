@extends('layouts.app')

@section('title')
    Edit Schedule
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
          {{-- <h1>YOU2MENTOR</h1> --}}
        </div>
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Edit Schedule </li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
  <!-- general form elements -->
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Edit Schedule</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('teacher.update_schedule',$id)}}" method="POST">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="SubjectName">Schedule Mentoring Topics</label>
                    <!--<input type="text" class="form-control @if($errors->has('name')) {{'is-invalid'}} @endif" id="name" name="name" value="{{$schedule->name}}" placeholder="Schedule Name">-->
                    <select  class="form-control" name="name">
                        @foreach ($subjects as $subject)
                        <option @if ($schedule->name == $subject->name) {{ 'selected' }} @endif>{{$subject->name}}</option>
                        @endforeach

                    </select>
                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="SubjectName">Description</label>
                    <textarea  class="form-control @if($errors->has('description')) {{'is-invalid'}} @endif" name="description" rows="3">{{$schedule->description}}</textarea>

                    @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="SubjectName">Schedule date*</label>
                    <input type="date" class="form-control @if($errors->has('schedule_date')) {{'is-invalid'}} @endif" id="name" name="schedule_date" value="{{$schedule->schedule_date}}" placeholder="Schedule Date">

                    @if($errors->has('schedule_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('schedule_date') }}</strong>
                        </span>
                    @endif
                </div>
                  <div class="form-group">
                 <div class="row">
                        <div class="col-md-6">
                            <label for="SubjectName">Start Time</label>
                            <input type="time" class="form-control @if($errors->has('start_time')) {{'is-invalid'}} @endif" id="name" value="{{$schedule->start_time}}" name="start_time">

                            @if($errors->has('start_time'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('start_time') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="SubjectName">End Time</label>
                            <input type="time" class="form-control @if($errors->has('end_time')) {{'is-invalid'}} @endif" id="name" value="{{$schedule->end_time}}" name="end_time">

                            @if($errors->has('end_time'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('end_time') }}</strong>
                                </span>
                            @endif
                        </div>
                 </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success pull-right">Save</button>
                <button type="button" id="deleteBtn" class="btn btn-danger pull-right">Delete</button>
            </div>
        </form>
        <form action="{{route('teacher.delete_schedule', $id)}}" id="deleteform" method="POST">
            @csrf
            @method('delete')
        </form>
    </div>
  </div>
  <!-- /.card -->
  </section>
@endsection
@push('scripts')
  <script>
      $('#deleteBtn').click(function(){
        if (confirm("Are you sure?") == true) {
          $('#deleteform').submit();
        }
      });
  </script>
@endpush
