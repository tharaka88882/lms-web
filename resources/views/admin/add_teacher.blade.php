@extends('layouts.app')

@section('title')
Add Mentor
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
            <li class="breadcrumb-item active">Add Mentor</li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
  <!-- general form elements -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Add Mentor</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('admin.add_teachers')}}" method="POST">
      @csrf
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control  @if($errors->has('name')) {{'is-invalid'}} @endif" name="name" placeholder="Full Name" >
                    <input type="hidden" value="teacher"  name="type">

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">NIC</label>
                    <input type="text" name="nic" class="form-control @if($errors->has('nic')) {{'is-invalid'}} @endif"  placeholder="Enter NIC" >

                    @if($errors->has('nic'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nic') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input type="email" name="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif"  placeholder="Enter Email" >

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
                    <label for="exampleInputEmail1">Qualifications</label>
                    <textarea name="qualification"  class="form-control @if($errors->has('qualification')) {{'is-invalid'}} @endif" rows="2"></textarea>

                    @if($errors->has('qualification'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('qualification') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Experience</label>
                    <textarea name="experience"  class="form-control @if($errors->has('experience')) {{'is-invalid'}} @endif" rows="3"></textarea>

                    @if($errors->has('experience'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('experience') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Skills</label>
                    <textarea name="skills"  class="form-control @if($errors->has('skills')) {{'is-invalid'}} @endif" rows="2"></textarea>

                    @if($errors->has('skills'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('skills') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="status" checked>
                      <label class="form-check-label">Approve</label>
                    </div>
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
