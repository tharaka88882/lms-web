@extends('layouts.app')



@section('title')
    Update Mentor Profile
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            $("#dpic").datepicker({
                dateFormat: 'yy'
            });
        });
    </script>
@endpush

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}

    <style>
        /* * {
                                                                                                                                                                                                                        box-sizing: border-box;
                                                                                                                                                                                                                    }

                                                                                                                                                                                                                    body {
                                                                                                                                                                                                                        font: 16px Arial;
                                                                                                                                                                                                                    } */

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')
    <!-- Content Header (Page header) -->

    <section class="content">
        <div class="container-fluid">

            {{-- <div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"> --}}
            {{-- <h1>YOU2MENTOR</h1> --}}
            {{-- </div> --}}
            {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a>Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div> --}}
            {{-- </div>
    </div><!-- /.container-fluid -->
</div> --}}

            <div class="row">
                <div class="col-md-12 mt-2">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                            <button type="button" data-target="#modal-md" data-toggle="modal"
                                class="btn btn-warning pull-right">View Profile</button>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{ route('user.update_teacher_profile') }}" method="POST"
                            enctype="multipart/form-data">
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
                                            <input disabled="" type="email" name="email"
                                                class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif"
                                                placeholder="Enter Email" value="{{ $user->email }}">

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
                                            <input type="text" name="city"
                                                class="form-control @if ($errors->has('city')) {{ 'is-invalid' }} @endif"
                                                value="{{ $user->city }}">

                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Country</label>
                                            <input type="text" name="country"
                                                class="form-control @if ($errors->has('country')) {{ 'is-invalid' }} @endif"
                                                value="{{ $user->country }}">

                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">About Me</label>
                                            <textarea  name="about" class="form-control" rows="3">
                                                {{ $user->about}}
                                            </textarea>

                                            @if ($errors->has('country'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Qualifications</label>
                                            <textarea name="qualification" class="form-control @if ($errors->has('qualification')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->qualification }}</textarea>

                                            @if ($errors->has('qualification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Linkedin Profile Link <small> (Please copy &
                                                    past your link)</small></label>
                                            <input name="linkedin_link"
                                                class="form-control @if ($errors->has('linkedin_link')) {{ 'is-invalid' }} @endif"
                                                value="{{ $user->userable->linkedin_link }}" />

                                            @if ($errors->has('linkedin_link'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('linkedin_link') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">My Rating</label><br>
                                            {{-- <input disabled type="text" name="country" class="form-control" value="{{ $user->userable->level }}"> --}}

                                            @php
                                                $i = 0;
                                                //$r = intval(Auth()->user()->userable->level);
                                                $r = $round_mediation;
                                            @endphp
                                            @while ($i < 5)
                                                @if ($r > 0)
                                                    <span class="fa fa-star checked"></span>
                                                @else
                                                    <span class="fa fa-star"></span>
                                                @endif
                                                @php
                                                    $i += 1;
                                                    $r -= 1;
                                                @endphp
                                            @endwhile
                                        </div>

                                        <div class="form-group">
                                            <label for="profileImageInput">Cover Image <small>(120PX *
                                                    480PX)</small></label>
                                            <div style="padding: 10px;">
                                                <img id="cover-image-output"
                                                    style="max-width: 100%; max-height:120px; border: 1px solid rgb(187, 187, 187)"
                                                    class="img-fluid"
                                                    onerror="this.src='{{ url('public') }}/images/download.jpg'"
                                                    @if ($user->cover_image != null) src="{{ url('public') }}/images/profile/{{ $user->cover_image }}" @else src="" @endif />
                                            </div>
                                            <input type="file" name="cover_image"
                                                class="form-control @if ($errors->has('image')) {{ 'is-invalid' }} @endif"
                                                id="coverImageInput" onchange="loadCoverImage(event)">

                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
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
                                                <img id="image-output"
                                                    style="max-width: 120px; max-height:120px; border: 1px solid rgb(187, 187, 187)"
                                                    class="img-fluid"
                                                    onerror="this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
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
                                                            <label for="exampleInputEmail1">Skills</label>

                                                            {{-- <select class="form-control" name="subject_id">
                                                                @foreach ($subjects as $subject)
                                                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                        </select> --}}

                                                            <select id="select2-echannel-doctor"
                                                                style="width: 100% !important;padding: 12px 20px !important;margin: 8px 0 !important;display: inline-block !important;border: 1px solid #ccc !important;box-sizing: border-box !important;"
                                                                name="subject"
                                                                class="select2 @if ($errors->has('subject')) {{ 'is-invalid' }} @endif">

                                                            </select>

                                                            @if ($errors->has('subject'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="card-footer">
                                                        <button id="add_btn" type="button"
                                                            class="btn btn-success pull-right">Add</button>
                                                    </div>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                            <!-- /.card -->

                                            <label for="exampleInputEmail1">Skills</label>
                                            <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->skills }}</textarea>

                                            @if ($errors->has('skills'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('skills') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Experience</label>
                                            <textarea name="experience" class="form-control @if ($errors->has('experience')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->experience }}</textarea>

                                            @if ($errors->has('experience'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('experience') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Job Title</label>
                                            <input type="text" name="job"
                                                class="form-control @if ($errors->has('job')) {{ 'is-invalid' }} @endif"
                                                rows="3" value="{{ $user->userable->job }}">

                                            @if ($errors->has('job'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('job') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Working Industry</label>
                                            <select class="select2 form-control" data-placeholder="Any" style="width: 100%;"
                                                name="industry">
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
                                {{-- <button type="button" data-target="#modal-md" data-toggle="modal"
                                    class="btn btn-warning pull-right  mr-2">View Profile</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="row">
                {{-- Qualifications Card --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Qualifications</h3>
                        </div>
                        <!--Make sure the form has the autocomplete function switched off:-->
                        <form autocomplete="off" action="{{ route('user.add_qualification') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="autocomplete" style="width:100%;">
                                                <label for="exampleInputEmail1">Institute</label>
                                                <input id="myInput" type="text" name="company" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Degree/Certificate</label>
                                            <input name="qualification"
                                                class="form-control @if ($errors->has('qualification')) {{ 'is-invalid' }} @endif"
                                                type="text" />

                                            @if ($errors->has('qualification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qualification') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Field of study</label>
                                            <input name="field"
                                                class="form-control @if ($errors->has('field')) {{ 'is-invalid' }} @endif"
                                                type="text" />

                                            @if ($errors->has('field'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('field') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input id="undergrad" class="form-check-input" type="checkbox">
                                                <label class="form-check-label">Still studying</label>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Sr</label>
                                            <input id="dpic" name="date"
                                                class="form-control @if ($errors->has('date')) {{ 'is-invalid' }} @endif"
                                                type="date" />

                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}

                                        <div class="row">
                                            {{-- <label for="exampleInputEmail1">Time of work</label> --}}
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start</label>
                                                    <input name="start_date" placeholder="Start Year"
                                                        class="form-control @if ($errors->has('start_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End</label>
                                                    <input id="dpic" name="end_date" placeholder="End Year"
                                                        class="form-control @if ($errors->has('end_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('end_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('end_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Grade (Optional)</label>
                                            <input name="grade"
                                                class="form-control @if ($errors->has('grade')) {{ 'is-invalid' }} @endif"
                                                type="text" />

                                            @if ($errors->has('grade'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('grade') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Your Qualifications</label>
                                            <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->skills }}</textarea>

                                            @if ($errors->has('skills'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('skills') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Qualifications</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Institute</th>
                                            <th>Degree/Certificate</th>
                                            <th>Field of study</th>
                                            <th style="width: 40px">Study Period</th>
                                            <th>Grade</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach (Auth()->user()->userable->qualifications as $qualification)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $qualification->institute->text }}</td>
                                                <td>{{ $qualification->text }}</td>
                                                <td>{{ $qualification->field }}</td>
                                                <td><span
                                                    class="badge">{{ explode('-', $qualification->start_date)[0] }}/{{ explode('-', $qualification->start_date)[1] }}
                                                    @if ($qualification->end_date != null)
                                                        -
                                                        {{ explode('-', $qualification->end_date)[0] }}/{{ explode('-', $qualification->end_date)[1] }}
                                                    @else
                                                        - Present
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $qualification->grade }}</td>

                                                <td>
                                                    <button type="button" class="btn btn-block btn-outline-danger btn-xs"
                                                        onclick="removeQua('{{ $qualification->id }}');">Remove</button>
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
                    </div>
                </div>
                {{-- End of Qualifications Card --}}

                {{-- Qualifications Card --}}
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Experience</h3>
                        </div>
                        <!--Make sure the form has the autocomplete function switched off:-->
                        <form autocomplete="off" action="{{ route('user.add_experience') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="autocomplete" style="width:100%;">
                                                <label for="exampleInputEmail1">Position</label>
                                                <input id="position" type="text" name="position" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="autocomplete @if ($errors->has('company')) {{ 'is-invalid' }} @endif"
                                                style="width:100%;">
                                                <label for="exampleInputEmail1">Company</label>
                                                <input id="ins" type="text" name="company" placeholder="">
                                            </div>

                                            @if ($errors->has('company'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="autocomplete" style="width:100%;">
                                                <label for="exampleInputEmail1">Location</label>
                                                <input  type="text" name="location" class="@if ($errors->has('location')) {{ 'is-invalid' }} @endif">
                                            </div>

                                            @if ($errors->has('location'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('location') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input id="present" class="form-check-input" type="checkbox">
                                                <label class="form-check-label">I am currently working in this role</label>
                                            </div>
                                        </div>



                                        <div class="row">
                                            {{-- <label for="exampleInputEmail1">Time of work</label> --}}
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Start</label>
                                                    <input name="start_date" placeholder="Start Year"
                                                        class="form-control @if ($errors->has('start_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End</label>
                                                    <input id="end_y" name="end_date" placeholder="End Year"
                                                        class="form-control @if ($errors->has('end_date')) {{ 'is-invalid' }} @endif"
                                                        type="date" />

                                                    @if ($errors->has('end_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('end_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Your Experiences</label>
                                            <textarea disabled name="skills" class="form-control @if ($errors->has('skills')) {{ 'is-invalid' }} @endif"
                                                rows="3">{{ $user->userable->skills }}</textarea>

                                            @if ($errors->has('skills'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('skills') }}</strong>
                                                </span>
                                            @endif
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Experience</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Position</th>
                                            <th>Company</th>
                                            <th>Location</th>
                                            <th style="width: 40px">Work Period</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach (Auth()->user()->userable->experiences as $experiences)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $experiences->position->text }}</td>
                                                <td>{{ $experiences->institute->text }}</td>
                                                <td>{{ $experiences->location }}</td>
                                                <td><span
                                                        class="badge">{{ explode('-', $experiences->start_date)[0] }}/{{ explode('-', $experiences->start_date)[1] }}
                                                        @if ($experiences->end_date != null)
                                                            -
                                                            {{ explode('-', $experiences->end_date)[0] }}/{{ explode('-', $experiences->end_date)[1] }}
                                                        @else
                                                            - Present
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-block btn-outline-danger btn-xs"
                                                        onclick="removeEx({{ $experiences->id }});">Remove</button>
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
                    </div>
                </div>
                {{-- End of Qualifications Card --}}
            </div>
        </div>
    </section>





    <!-- /.view profile modal -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="text-transform: capitalize">My Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-sm-7">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-olive"
                                    @if ($user->cover_image != null) style="background-image: url('{{ url('public') }}/images/profile/{{ $user->cover_image }}') !important;" @endif>
                                    <h3 class="widget-user-username" style="text-transform: uppercase">{{ $user->name }}
                                    </h3>
                                    {{-- <a href="{{route('user.view_rating')}}"> --}}
                                    @php
                                        $i = 0;
                                        //$r = intval(Auth()->user()->userable->level);
                                        $r = (int) $round_mediation;
                                    @endphp
                                    @while ($i < 5)
                                        @if ($r > 0)
                                            <span class="fa fa-star checked"></span>
                                        @else
                                            <span class="fa fa-star"></span>
                                        @endif
                                        @php
                                            $i += 1;
                                            $r -= 1;
                                        @endphp
                                    @endwhile
                                    {{-- </a> --}}
                                </div>

                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2"
                                        onerror="this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                        @if (Auth()->user()->image != null) src="{{ url('public') }}/images/profile/{{ Auth()->user()->image }}" @else src="" @endif
                                        alt="User Avatar">
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                {{-- <h5 class="description-header">3,200</h5>
                                        <span class="description-text">SALES</span> --}}
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"></h5>
                                                <span class="description-text"></span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>

                                        <!-- /.col -->

                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                {{-- <h5 class="description-header">35</h5>
                                        <span class="description-text">PRODUCTS</span> --}}
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row ml-5">

                                        {{-- <div class="col-sm-2">
                                    <a class="btn btn-success" href="{{ route('student.view_conversation', $query->id) }}">Complaint</a>
                                </div> --}}
                                        <div class="col-xs-2">
                                            {{-- <a class="btn btn-warning" href="{{route('student.complaint',$teacher->id)}}">Complaint Mentor</a> --}}
                                        </div>
                                        <div class="col-xs-4 mr-2" style="text-align: left">
                                            <a class="btn btn-success">Connect</a>
                                        </div>
                                        <div class="col-xs-4 ml-6" style="text-align: center">
                                            <button class="btn btn-warning"><i class="fa fa-star"></i>Rate
                                                Now</button>
                                            {{-- <form action="{{ route('student.rate_teacher') }}" method="POST" class="form-inline" style="float: right" id="changeRatings">
                                        @csrf
                                        <label data-toggle="modal" data-target="#modal-md"><i class="fa fa-star"></i> Ratings:
                                            <select name="rating" class="form-control" style="max-width: 120px; margin-left: 5px;" id="ratingInp">
                                                <option value="">No Ratings Given</option>
                                                <option value="1" @if (sizeof($rating) > 0 && $rating->first()->rating == 1) {{'selected'}} @endif>1</option>
                                                <option value="2" @if (sizeof($rating) > 0 && $rating->first()->rating == 2) {{'selected'}} @endif>2</option>
                                                <option value="3" @if (sizeof($rating) > 0 && $rating->first()->rating == 3) {{'selected'}} @endif>3</option>
                                                <option value="4" @if (sizeof($rating) > 0 && $rating->first()->rating == 4) {{'selected'}} @endif>4</option>
                                                <option value="5" @if (sizeof($rating) > 0 && $rating->first()->rating == 5) {{'selected'}} @endif>5</option>
                                            </select>
                                        </label>
                                        <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
                                    </form> --}}
                                        </div>

                                        <div class="col-x-2">
                                            {{-- <a class="btn btn-warning" href="{{route('student.complaint',$teacher->id)}}">Complaint Mentor</a> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-angle-double-down"></i>
                                        About me
                                    </h3>
                                    <br>

                                    @if (Auth()->user()->userable->linkedin_link != null)
                                        {{-- <a href="{{ Auth()->user()->userable->linkedin_link }}" target="_blank">View
                                            Linkedin Profile
                                            <i class="fas fa-angle-double-right"></i></a> --}}
                                    @endif
                                    @if (Auth()->user()->about != null)
                                    <span>{{Auth()->user()->about}}
                                        <i class="fas fa-angle-double-right"></i></span>
                                @endif
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <dl>
                                        <dt>Qualifications</dt>
                                        <dd>
                                            <ul>

                                                @foreach (Auth()->user()->userable->qualifications as $qualification)
                                                    <li><strong>{{ $qualification->text }}</strong><br>
                                                        {{-- <ul> --}}
                                                        <span>{{ $qualification->institute->text }}
                                                            <br>
                                                            {{ $qualification->field }}<br>
                                                            <small>@if ($qualification->end_date!= null)Completed
                                                                {{ explode('-', $qualification->start_date)[1] }}/{{ explode('-', $qualification->start_date)[0] }}  -
                                                                {{ explode('-', $qualification->end_date)[1] }}/{{ explode('-', $qualification->end_date)[0] }} @else {{ explode('-', $qualification->start_date)[1] }}/{{ explode('-', $qualification->start_date)[0] }} - Present <br> Grade-{{$qualification->grade}} @endif

                                                            </small>
                                                        </span>
                                                        {{-- </ul> --}}
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </dd>
                                        <dt>Experience</dt>
                                        <dd>
                                            <ul>

                                                @foreach (Auth()->user()->userable->experiences as $experience)
                                                    <li><strong>{{ $experience->position->text }}</strong><br>
                                                        {{-- <ul> --}}
                                                        <span>{{ $experience->institute->text }}
                                                            <br>
                                                            <small>{{ explode('-', $experience->start_date)[1] }}/{{ explode('-', $experience->start_date)[0] }}
                                                                @if ($experience->end_date != null)
                                                                    -
                                                                    {{ explode('-', $experience->end_date)[1] }}/{{ explode('-', $experience->end_date)[0] }}
                                                                @else
                                                                    - Present
                                                                @endif
                                                                <br>
                                                                Location : {{$experience->location}}
                                                            </small>
                                                        </span>
                                                        {{-- </ul> --}}
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </dd>
                                        {{-- <dt>Skills</dt>
                                        <dd>
                                            {{ Auth()->user()->userable->skills }}
                                        </dd> --}}
                                        <dt>Industry</dt>
                                        <dd>
                                            {{ Auth()->user()->userable->industry }}
                                        </dd>
                                        <dt>Job Title</dt>
                                        <dd>
                                            {{ Auth()->user()->userable->job }}
                                        </dd>
                                    </dl>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="float-right">
                                        <b>Average Responce time: </b> {{ round(1, 5) }}hrs
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="row">
                        <div class="col-sm-7">
                            {{-- <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">
                                <i class="fas fa-tasks"></i>
                                Schedule
                              </h3>
                            </div>
                          <div class="card-body p-2">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                          </div>
                          <!-- /.card-body -->
                      </div> --}}
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-book-open"></i>
                                        Skils
                                    </h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body">
                                    <ul>
                                        @foreach (Auth()->user()->userable->teachersubject as $subject)
                                            <li>{{ $subject->subject->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
        var loadCoverImage = function(event) {

            var reader = new FileReader();

            reader.onload = function() {

                var output = document.getElementById('cover-image-output');

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

                    url: '{{ route('teacher.get_topics') }}',

                    contentType: "application/json; charset=utf-8",

                    dataType: 'json',

                    data: function(params) {

                        var query = {

                            search: params.term,

                            _method: "GET",

                            // _token: "{{ csrf_token() }}",

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



            $.post('{{ route('teacher.stor_subject1') }}', {

                    _method: "POST",

                    _token: "{{ csrf_token() }}",

                    subject: $('#select2-echannel-doctor option:selected').val()

                },
                function(data, status) {

                    // var jo = JSON.parse(data);


                    if (data.error == false) {

                        window.location = "{{ route('user.profile') }}";

                        //  alert(data.flag);

                    } else {

                        window.location = "{{ route('user.profile') }}";

                    }

                });







        }


        // Qualifications Auto Complete
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        // End of Qualifications Auto Complete



        /*An array containing all the country names in the world:*/
        // var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua & Barbuda",
        //     "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh",
        //     "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia & Herzegovina",
        //     "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia",
        //     "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central Arfrican Republic", "Chad", "Chile", "China",
        //     "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus",
        //     "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt",
        //     "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands",
        //     "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia",
        //     "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey",
        //     "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India",
        //     "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey",
        //     "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon",
        //     "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia",
        //     "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
        //     "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco",
        //     "Mozambique", "Myanmar", "Namibia", "Nauro", "Nepal", "Netherlands", "Netherlands Antilles",
        //     "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman",
        //     "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland",
        //     "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon",
        //     "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
        //     "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
        //     "South Korea", "South Sudan", "Spain", "Sri Lanka", "St Kitts & Nevis", "St Lucia", "St Vincent", "Sudan",
        //     "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
        //     "Timor L'Este", "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos",
        //     "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America",
        //     "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen",
        //     "Zambia", "Zimbabwe"
        // ];
        var ins = [];
        @foreach ($institutes as $in)
            ins.push('{{ $in->text }}');
        @endforeach
        var pos = [];
        @foreach ($position as $po)
            pos.push('{{ $po->text }}');
        @endforeach

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("myInput"), ins);
        autocomplete(document.getElementById("ins"), ins);
        autocomplete(document.getElementById("position"), pos);


        function removeEx(id) {
            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.delete_experience') }}", {
                        id: id,
                        _method: "delete",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            console.log('success');
                            window.location = "{{ route('user.profile') }}";
                        }
                    });
            }

        }

        function removeQua(id) {
            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.delete_qualification') }}", {
                        id: id,
                        _method: "delete",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            console.log('success');
                            window.location = "{{ route('user.profile') }}";
                        }
                    });
            }

        }

        $('#present').click(function() {
            if ($('#present').is(':checked')) {
                // alert("t");
                $('#end_y').prop('disabled', true);
            } else {
                //alert("tjio");
                $('#end_y').prop('disabled', false);
            }
        });

        $('#undergrad').click(function() {
            if ($('#undergrad').is(':checked')) {
                // alert("t");
                $('#dpic').prop('disabled', true);
            } else {
                //alert("tjio");
                $('#dpic').prop('disabled', false);
            }
        });
    </script>
@endpush
