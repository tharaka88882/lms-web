@extends('layouts.app')

@section('title')
    Update Mentee Profile
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
            <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text"
                                    class="form-control  @if ($errors->has('name')) {{ 'is-invalid' }} @endif"
                                    name="name" placeholder="Full Name" value="{{ $user->name }}">
                                <input type="hidden" value="Student" name="type">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email Address</label>
                                <input disabled="" type="email" name="email"
                                    class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif"
                                    placeholder="Enter Email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" name="password"
                                    class="form-control @if ($errors->has('password')) {{ 'is-invalid' }} @endif"
                                    placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password Confirmation</label>
                                <input type="password" name="confirm_password"
                                    class="form-control @if ($errors->has('confirm_password')) {{ 'is-invalid' }} @endif"
                                    placeholder="Password Confirmation">

                                @if ($errors->has('confirm_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="profileImageInput">Profile Image</label>
                                <div style="padding: 10px;">
                                    <img id="image-output"
                                        style="max-width: 120px; max-height:120px; border: 1px solid rgb(187, 187, 187)"
                                        class="img-fluid"
                                        onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                        @if ($user->image != null) src="{{ url('public') }}/images/profile/{{ $user->image }}" @else src="" @endif />
                                </div>
                                <input type="file" name="image"
                                    class="form-control @if ($errors->has('image')) {{ 'is-invalid' }} @endif"
                                    id="profileImageInput" onchange="loadImage(event)">


                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Grade</label>
                                <select
                                    class="form-control  @if ($errors->has('grade')) {{ 'is-invalid' }} @endif"
                                    name="grade">
                                    <option value="1" @if ($user->userable->grade == '1') {{ 'selected' }} @endif>1
                                    </option>
                                    <option value="2" @if ($user->userable->grade == '2') {{ 'selected' }} @endif>2
                                    </option>
                                    <option value="3" @if ($user->userable->grade == '3') {{ 'selected' }} @endif>3
                                    </option>
                                    <option value="4" @if ($user->userable->grade == '4') {{ 'selected' }} @endif>4
                                    </option>
                                    <option value="5" @if ($user->userable->grade == '5') {{ 'selected' }} @endif>5
                                    </option>
                                    <option value="6" @if ($user->userable->grade == '6') {{ 'selected' }} @endif>6
                                    </option>
                                    <option value="7" @if ($user->userable->grade == '7') {{ 'selected' }} @endif>7
                                    </option>
                                    <option value="8" @if ($user->userable->grade == '8') {{ 'selected' }} @endif>8
                                    </option>
                                    <option value="9" @if ($user->userable->grade == '9') {{ 'selected' }} @endif>9
                                    </option>
                                    <option value="10" @if ($user->userable->grade == '10') {{ 'selected' }} @endif>10
                                    </option>
                                    <option value="11" @if ($user->userable->grade == '11') {{ 'selected' }} @endif>11
                                    </option>
                                    <option value="12" @if ($user->userable->grade == '12') {{ 'selected' }} @endif>12
                                    </option>
                                    <option value="13" @if ($user->userable->grade == '13') {{ 'selected' }} @endif>13
                                    </option>
                                </select>

                                @if ($errors->has('grade'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>
            </form>
        </div><!-- /.card -->
    </section>
@endsection

@push('scripts')
    <script>
        var loadImage = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-output');
                output.src = reader.result;
                output.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
