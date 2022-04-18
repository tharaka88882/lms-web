@extends('layouts.app')



@section('title')

Update Teacher Profile

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

        <form action="{{ route('user.update_teacher_profile') }}" method="POST" enctype="multipart/form-data">

            @csrf

            @method('PUT')

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="exampleInputEmail1">Full Name</label>

                            <input type="text" class="form-control  @if ($errors->has('name')) {{ 'is-invalid' }} @endif" name="name" placeholder="Full Name" value="{{ $user->name }}">

                            <input type="hidden" value="teacher" name="type">



                            @if ($errors->has('name'))

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $errors->first('name') }}</strong>

                            </span>

                            @endif

                        </div>

                        {{-- <div class="form-group">

                                <label for="exampleInputPassword1">NIC</label>

                                <input type="text" name="nic" class="form-control @if ($errors->has('nic')) {{ 'is-invalid' }} @endif"

                        placeholder="Enter NIC" value="{{ $user->userable->nic }}">



                        @if ($errors->has('nic'))

                        <span class="invalid-feedback" role="alert">

                            <strong>{{ $errors->first('nic') }}</strong>

                        </span>

                        @endif

                    </div> --}}

                    <div class="form-group">

                        <label for="exampleInputPassword1">Email Address</label>

                        <input disabled="" type="email" name="email" class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif" placeholder="Enter Email" value="{{ $user->email }}">



                        @if ($errors->has('email'))

                        <span class="invalid-feedback" role="alert">

                            <strong>{{ $errors->first('email') }}</strong>

                        </span>

                        @endif

                    </div>

                    {{-- <div class="form-group">

                                <label for="exampleInputEmail1">Address</label>

                                <textarea name="address" class="form-control @if ($errors->has('address')) {{ 'is-invalid' }} @endif"

                    rows="2">{{$user->address}}</textarea>



                    @if ($errors->has('address'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('address') }}</strong>

                    </span>

                    @endif

                </div> --}}

                <div class="form-group">

                    <label for="exampleInputPassword1">City</label>

                    <input type="text" name="city" class="form-control @if ($errors->has('city')) {{ 'is-invalid' }} @endif" value="{{ $user->city }}">



                    @if ($errors->has('city'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('city') }}</strong>

                    </span>

                    @endif

                </div>

                <div class="form-group">

                    <label for="exampleInputPassword1">Country</label>

                    <input type="text" name="country" class="form-control @if ($errors->has('country')) {{ 'is-invalid' }} @endif" value="{{ $user->country }}">



                    @if ($errors->has('country'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('country') }}</strong>

                    </span>

                    @endif

                </div>

                <div class="form-group">

                    <label for="exampleInputEmail1">Qualifications</label>

                    <textarea name="qualification" class="form-control @if ($errors->has('qualification')) {{ 'is-invalid' }} @endif" rows="3">{{ $user->userable->qualification }}</textarea>



                    @if ($errors->has('qualification'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('qualification') }}</strong>

                    </span>

                    @endif

                </div>

                <div class="form-group">

                    <label for="exampleInputEmail1">Linkedin Profile Link <small> (Please copy & past your Link)</small></label>

                    <input name="linkedin_link" class="form-control @if ($errors->has('linkedin_link')) {{ 'is-invalid' }} @endif" value="{{ $user->userable->linkedin_link }}" />



                    @if ($errors->has('linkedin_link'))

                    <span class="invalid-feedback" role="alert">

                        <strong>{{ $errors->first('linkedin_link') }}</strong>

                    </span>

                    @endif

                </div>

                <div class="form-group">

                    <label for="exampleInputPassword1">My Rating</label>

                    <input disabled type="text" name="country" class="form-control" value="{{ $user->userable->level }}">

                </div>

                {{-- <div class="form-group">

                                <label for="exampleInputEmail1">Password</label>

                                <input type="password" name="password" class="form-control @if ($errors->has('password')) {{ 'is-invalid' }} @endif"

                placeholder="Password">



                @if ($errors->has('password'))

                <span class="invalid-feedback" role="alert">

                    <strong>{{ $errors->first('password') }}</strong>

                </span>

                @endif

            </div>

            <div class="form-group">

                <label for="exampleInputPassword1">Password Confirmation</label>

                <input type="password" name="confirm_password" class="form-control @if ($errors->has('confirm_password')) {{ 'is-invalid' }} @endif" placeholder="Password Confirmation">



                @if ($errors->has('confirm_password'))

                <span class="invalid-feedback" role="alert">

                    <strong>{{ $errors->first('confirm_password') }}</strong>

                </span>

                @endif

            </div> --}}

    </div>

    <div class="col-md-6">



        <div class="form-group">

            <label for="profileImageInput">Profile Image</label>

            <div style="padding: 10px;">

                <img id="image-output" style="max-width: 120px; max-height:120px; border: 1px solid rgb(187, 187, 187)" class="img-fluid" onerror="this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'" @if ($user->image != null) src="{{ url('public') }}/images/profile/{{ $user->image }}" @else src="" @endif />

            </div>

            <input type="file" name="image" class="form-control @if ($errors->has('image')) {{ 'is-invalid' }} @endif" id="profileImageInput" onchange="loadImage(event)">





            @if ($errors->has('image'))

            <span class="invalid-feedback" role="alert">

                <strong>{{ $errors->first('image') }}</strong>

            </span>

            @endif

        </div>

        <div class="form-group">







            <div class="col-sm-12">

                <div class="card">

                    {{-- <div class="card-header">

                                            <h3 class="card-title">Add My  Mentoring Topics</h3>

                                        </div> --}}

                    <!-- /.card-header -->

                    <!-- form start -->

                    {{-- <form action="{{route('teacher.stor_subject')}}" method="POST"> --}}

                    @csrf

                    <div class="card-body">

                        <div class="form-group">

                            <label for="exampleInputEmail1"> Mentoring Topics</label>

                            {{-- <select class="form-control" name="subject_id">

                                                    @foreach ($subjects as $subject)

                                                    <option value="{{$subject->id}}">{{$subject->name}}</option>

                            @endforeach





                            </select> --}}

                            <select id="select2-echannel-doctor" style="width: 100% !important;padding: 12px 20px !important;margin: 8px 0 !important;display: inline-block !important;border: 1px solid #ccc !important;box-sizing: border-box !important;" name="subject" class="select2 @if($errors->has('subject')) {{'is-invalid'}} @endif">



                            </select>

                            @if($errors->has('subject'))

                            <span class="invalid-feedback" role="alert">

                                <strong>{{ $errors->first('subject') }}</strong>

                            </span>

                            @endif

                        </div>



                    </div>

                    <!-- /.card-body -->



                    <div class="card-footer">

                        <button id="add_btn" type="button" class="btn btn-success pull-right">Add</button>

                    </div>

                    {{-- </form> --}}

                </div>

            </div>

            <!-- /.card -->



            <label for="exampleInputEmail1">Skills</label>

            <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif" rows="3">{{ $user->userable->skills }}</textarea>



            @if ($errors->has('skills'))

            <span class="invalid-feedback" role="alert">

                <strong>{{ $errors->first('skills') }}</strong>

            </span>

            @endif

        </div>





        <div class="form-group">

            <label for="exampleInputEmail1">Experience</label>

            <textarea name="experience" class="form-control @if ($errors->has('experience')) {{ 'is-invalid' }} @endif" rows="3">{{ $user->userable->experience }}</textarea>



            @if ($errors->has('experience'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('experience') }}</strong>
            </span>
            @endif

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Job Title</label>
            <input type="text" name="job" class="form-control @if ($errors->has('job')) {{ 'is-invalid' }} @endif" rows="3" value="{{ $user->userable->job }}">

            @if ($errors->has('job'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('job') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Working Industry</label>
            <select class="select2 form-control" data-placeholder="Any" style="width: 100%;" name="industry">
                @foreach ($industries as $industry)
                    <option value="{{ $industry->id }}">
                        {{ $industry->name }}
                    </option>
                @endforeach
            </select>

            @if ($errors->has('industry'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('industry') }}</strong>
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



    $(function() {

        //Initialize Select2 Elements

        // $('.select2').select2({

        //     dropdownParent: $('#currentModal')

        // });



        $('#select2-echannel-doctor').select2({

            ajax: {

                method: 'GET',

                url: '{{route('teacher.get_topics')}}',

                contentType: "application/json; charset=utf-8",

                dataType: 'json',

                data: function(params) {

                    var query = {

                        search: params.term,

                        _method: "GET",

                        // _token: "{{csrf_token()}}",

                        type: 'public'

                    };

                    // Query parameters will be ?search=[term]&type=public

                    return query;

                },

                processResults: function(data) {

                    // Transforms the top-level key of the response object from 'items' to 'results'

                    return {

                        results: data.results

                    };

                }

            },

            // dropdownParent: $('#currentModal')

        });

    });





    $('#add_btn').click(function() {

        addTopics();

    });



    function addTopics() {

        //alert("Update Chat");



        $.post('{{route('teacher.stor_subject1')}}', {

                _method: "POST",

                _token: "{{csrf_token()}}",

                subject: $('#select2-echannel-doctor option:selected').val()

            },
            function(data, status) {

                // var jo = JSON.parse(data);

                if (data.error == false) {

                    window.location = "{{route('user.profile') }}";

                    //  alert(data.flag);

                } else {

                    window.location = "{{route('user.profile') }}";

                }

            });







    }
</script>



@endpush