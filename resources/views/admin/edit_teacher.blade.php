@extends('layouts.app')

@section('title')
Edit Mentor
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
            <li class="breadcrumb-item active">Edit Mentor</li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
  <!-- general form elements -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Edit Mentor</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('admin.update_teacher', $id)}}" method="POST">
      @csrf
      @method('PUT')
      <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control  @if($errors->has('name')) {{'is-invalid'}} @endif" name="name" value="{{$teacher->user->name}}" placeholder="Full Name" >
                    <input type="hidden" value="teacher"  name="type">

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">NIC</label>
                    <input type="text" name="nic" class="form-control @if($errors->has('nic')) {{'is-invalid'}} @endif"  placeholder="Enter NIC" value="{{$teacher->nic}}" >

                    @if($errors->has('nic'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nic') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input type="email" name="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif"  placeholder="Enter Email" value="{{$teacher->user->email}}" >

                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                    <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea name="address" class="form-control @if ($errors->has('address')) {{ 'is-invalid' }} @endif"
                                    rows="2">{{$teacher->user->address}}</textarea>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">City</label>
                                <input  type="text" name="city" class="form-control @if ($errors->has('city')) {{ 'is-invalid' }} @endif"
                                    value="{{ $teacher->user->city }}">

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Country</label>
                                <input  type="text" name="country" class="form-control @if ($errors->has('country')) {{ 'is-invalid' }} @endif"
                                   value="{{ $teacher->user->country }}">

                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Linkedin Profile Link or Any Professional Reference Website (Eg: IMDB) <small> (Please copy & past your Link)</small></label>
                                <input name="linkedin_link" class="form-control @if ($errors->has('linkedin_link')) {{ 'is-invalid' }} @endif" value="{{ $teacher->linkedin_link }}"/>

                                @if ($errors->has('linkedin_link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('linkedin_link') }}</strong>
                                    </span>
                                @endif
                            </div>

                {{-- <div class="form-group">
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
                </div> --}}
            </div>
            <div  class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Qualifications</label>
                    <textarea name="qualification"  class="form-control @if($errors->has('qualification')) {{'is-invalid'}} @endif" rows="3">{{$teacher->qualification}}</textarea>

                    @if($errors->has('qualification'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('qualification') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Experience</label>
                    <textarea name="experience"  class="form-control @if($errors->has('experience')) {{'is-invalid'}} @endif" rows="3">{{$teacher->experience}}</textarea>

                    @if($errors->has('experience'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('experience') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Skills</label>
                    <textarea name="skills"  class="form-control @if($errors->has('skills')) {{'is-invalid'}} @endif" rows="3">{{$teacher->skills}}</textarea>

                    @if($errors->has('skills'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('skills') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Job Title</label>
                    <input type="text" name="job" class="form-control @if ($errors->has('job')) {{ 'is-invalid' }} @endif" rows="3" value="{{ $teacher->job }}">

                    @if ($errors->has('job'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('job') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Industry</label>
                    <input type="text" name="industry" class="form-control @if ($errors->has('industry')) {{ 'is-invalid' }} @endif" rows="3" value="{{ $teacher->industry }}">

                    @if ($errors->has('industry'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('industry') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Level</label>
                    <select class="form-control  @if($errors->has('level')) {{'is-invalid'}} @endif" name="level">
                        <option value="1" @if ($teacher->level=='1') {{'selected'}} @endif>1</option>
                        <option value="2" @if ($teacher->level=='2') {{'selected'}} @endif>2</option>
                        <option value="3" @if ($teacher->level=='3') {{'selected'}} @endif>3</option>
                        <option value="4" @if ($teacher->level=='4') {{'selected'}} @endif>4</option>
                        <option value="5" @if ($teacher->level=='5') {{'selected'}} @endif>5</option>
                    </select>

                    @if($errors->has('level'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="status" {{$teacher->status==('1')? 'Checked':''}}>
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
    <form action="{{route('admin.delete_teacher', $id)}}" id="deleteform" method="POST">
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
