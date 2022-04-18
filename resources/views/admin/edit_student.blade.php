
@extends('layouts.app')

@section('title')
Update Student
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
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
  <!-- general form elements -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Profile</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('admin.update_student', $id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" class="form-control  @if($errors->has('name')) {{'is-invalid'}} @endif" name="name" placeholder="Full Name" value="{{$user->user->name}}">
                        <input type="hidden" value="Student"  name="type">

                        @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email Address</label>
                        <input type="email" name="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif"  placeholder="Enter Email" value="{{$user->user->email}}">

                        @if($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control @if($errors->has('password')) {{'is-invalid'}} @endif"  placeholder="Password">

                        @if($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password Confirmation</label>
                        <input type="password" name="confirm_password" class="form-control @if($errors->has('confirm_password')) {{'is-invalid'}} @endif" placeholder="Password Confirmation">

                        @if($errors->has('confirm_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div  class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Grade</label>
                        <select class="form-control  @if($errors->has('grade')) {{'is-invalid'}} @endif" name="grade">
                            <option value="1" @if ($user->grade=='1') {{'selected'}} @endif>1</option>
                            <option value="2" @if ($user->grade=='2') {{'selected'}} @endif>2</option>
                            <option value="3" @if ($user->grade=='3') {{'selected'}} @endif>3</option>
                            <option value="4" @if ($user->grade=='4') {{'selected'}} @endif>4</option>
                            <option value="5" @if ($user->grade=='5') {{'selected'}} @endif>5</option>
                            <option value="6" @if ($user->grade=='6') {{'selected'}} @endif>6</option>
                            <option value="7" @if ($user->grade=='7') {{'selected'}} @endif>7</option>
                            <option value="8" @if ($user->grade=='8') {{'selected'}} @endif>8</option>
                            <option value="9" @if ($user->grade=='9') {{'selected'}} @endif>9</option>
                            <option value="10" @if ($user->grade=='10') {{'selected'}} @endif>10</option>
                            <option value="11" @if ($user->grade=='11') {{'selected'}} @endif>11</option>
                            <option value="12" @if ($user->grade=='12') {{'selected'}} @endif>12</option>
                            <option value="13" @if ($user->grade=='13') {{'selected'}} @endif>13</option>
                        </select>

                        @if($errors->has('grade'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('grade') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- checkbox -->
                  <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" name='status' type="checkbox" {{$user->status==('1')? 'Checked':''}}>
                      <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success pull-right">Save</button>
            <button type="button" class="btn btn-danger pull-right" id="deleteBtn">Delete</button>
        </div>
    </form>
    <form action="{{route('admin.delete_student', $id)}}" id="deleteform" method="POST">
        @csrf
        @method('delete')
    </form>
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

