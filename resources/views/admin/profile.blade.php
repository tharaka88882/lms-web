
@extends('layouts.app')

@section('title')
Update Admin Profile
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
    <form action="{{route('user.update_profile')}}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" class="form-control  @if($errors->has('name')) {{'is-invalid'}} @endif" name="name" placeholder="Full Name" value="{{$user->name}}">
                        <input type="hidden" value="Student"  name="type">

                        @if($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email Address</label>
                        <input type="email" name="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif"  placeholder="Enter Email" value="{{$user->email}}">

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
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success pull-right">Save</button>
        </div>
    </form>
  </div>
  <!-- /.card -->
  </section>
@endsection
