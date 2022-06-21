@extends('layouts.app')



@section('title')

    Find a Mentor

@endsection



@push('styles')

    {{-- <style>h1 {background-color: red !important}</style> --}}
    <style>
        .eletest{
            height: 37px !important;
        }
    </style>

@endpush



@section('content')

    <section class="content-header">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <!-- USERS LIST -->

                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">Find a Mentor</h3>



                            <div class="card-tools">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">

                                    <i class="fas fa-minus"></i>

                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">

                                    <i class="fas fa-times"></i>

                                </button>

                            </div>

                        </div>

                        <!-- /.card-header -->

                        <div class="card-body p-10">

                            <div class="col-md-12">

                                <form action="{{ route('student.tutors') }}">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-3">

                                            <div class="form-group">

                                                <label>Name:</label>

                                                <input placeholder="Enter Mentor Name" class="select2 form-control" data-placeholder="Any" name="m_name"/>

                                            </div>


                                        </div>


                                        <div class="col-lg-3">

                                            <div class="form-group" id="currentModal">

                                                <label> Mentoring Topics:</label>



                                                 <select  name="search_subject" class="form-control select22 select2 @if($errors->has('search_subject')) {{'is-invalid'}} @endif" id="select2-echannel-doctor"  size="30">

                                                    {{-- <option>Any</option> --}}

                                                </select>

                                            </div>


                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">

                                                <label>Sort Order:</label>

                                                <select class="form-control" style="width: 100%;">

                                                    <option selected>Rating ASC</option>

                                                    <option>Rating DESC</option>

                                                </select>

                                            </div>
                                        </div>

                                     <div class="col-lg-3">

                                            <div class="form-group">

                                                <label>City:</label>

                                                <input placeholder="Enter City" class="select2 form-control" data-placeholder="Any" name="city"/>

                                            </div>


                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group" id="currentModal">
                                                <label>Industry :</label>
                                                <select class="select2 form-control" data-placeholder="Any" style="width: 100%;" name="search_industry">
                                                    <option>Any</option>
                                                    @foreach ($industries as $industry)
                                                        <option value="{{ $industry->id }}" @if ($industry->id == $request->get('search_industry')) {{ 'selected' }} @endif>
                                                            {{ $industry->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                          <div class="col-lg-3">

                                            <div class="form-group">

                                                <label> Country:</label>

                                                <input placeholder="Enter Country" class="select2 form-control" data-placeholder="Any" name="country"/>

                                            </div>


                                        </div>
                                          <div class="col-lg-3">

                                            <div class="form-group">

                                                <label> Company:</label>

                                                <input placeholder="Enter Company" class="select2 form-control" data-placeholder="Any" name="company"/>

                                            </div>


                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                            <button class="btn btn-success" style="margin-top: 30px;">Find Mentor</button>
                                        </div>
                                        </div>





                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- /.card-body -->

                    </div>

                    <!--/.card -->

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">Mentors List</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->

                        <div class="card-body p-0">
                            <div class="row">
                                @foreach ($tutors as $tutor)
                                    <div class="col-md-6">
                                        <div class="card p-3">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('student.view_tutor',$tutor->id)}}">
                                                    <img @if ($tutor->user->image != null) src="{{ url('public') }}/images/profile/{{ $tutor->user->image}}" @else src="" @endif alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="{{ route('student.view_tutor', $tutor->id) }}">{{ $tutor->user->name }}</a></h4>
                                                    <?php
                                                    $rator_count = count(json_decode($tutor->rate,true));
                                                    $rating_count = 0;
                                                    $mediation = 0;

                                                    ?>

                                                    @foreach ($tutor->rate as $rate)
                                                    <?php
                                                    $rating_count ++;
                                                    ?>
                                                    @endforeach

                                                 <?php

                                                    if($rator_count!=0){

                                                            $mediation = $rating_count/$rator_count;

                                                    }


                                                            $round_mediation =(int)$mediation;
                                                 ?>

                                                    @php
                                                        $i = 0;
                                                        //$r = intval(Auth()->user()->userable->level);
                                                        $r = (int)$mediation;
                                                    @endphp
                                                    @while ($i<5)
                                                        @if ($r>0)
                                                        <span class="fa fa-star checked" style="color:rgb(255, 153, 0);"></span>
                                                        @else
                                                        <span class="fa fa-star"></span>

                                                        @endif
                                                        @php
                                                        $i += 1;
                                                        $r -=1;
                                                        @endphp
                                                    @endwhile

                                                    @if ($tutor->user->industry !=null)
                                                        <span class="users-list-date">Industry - {{ $tutor->user->industry }}</span>
                                                    @endif
                                                    {{-- @if ($tutor->user->job !=null)
                                                        <span class="users-list-date">Job Title - {{ $tutor->user->job }}</span>
                                                    @endif --}}
                                                    @if (sizeof($tutor->experiences)>0)
                                                    @php
                                                       $sizeArr = sizeof($tutor->experiences);
                                                       $i = 0;
                                                    @endphp
                                                    @foreach ($tutor->experiences as $experience)
                                                   @php
                                                        $i++;
                                                   @endphp
                                                   @if ($i == $sizeArr)
                                                   <span class="users-list-date">{{ $experience->position->text }}</span>
                                                   @endif
                                                    @endforeach

                                                    @endif
                                                    {{-- <span class="users-list-date">Timely Responce - {{ $tutor->avg_time }} hour</span> --}}

                                                    @if (count($tutor->subjects)>0)
                                                        <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                            <span>Skills -
                                                            @foreach ($tutor->subjects as $subject)
                                                                <span class="badge bg-gray">{{$subject['name']}}</span>
                                                            @endforeach
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if ($tutor->user->country !=null)
                                                        <span class="users-list-date">{{ $tutor->user->country }}/{{ $tutor->user->city}}</span>
                                                    @endif
                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                        <a href="{{ route('student.view_tutor',$tutor->id)}}">
                                                            <button class="btn btn-sm btn-outline-primary w-100">View Profile</button>
                                                        </a>
                                                        @if ($tutor->conversation != null)
                                                            <a href="{{ route('student.view_conversation', $tutor->conversation['id']) }}">
                                                                <button class="btn btn-sm btn-primary w-100 ml-2">Message</button>
                                                            </a>
                                                        @else
                                                            <form action="{{ route('user.store_conversation') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{Auth()->user()->userable->id}}">
                                                                <input type="hidden" name="teacher_id" value="{{$tutor->id}}">
                                                                <button class="btn btn-sm btn-primary w-100 ml-2" type="submit">Message</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="users-list-date text-right">Average Responce Time - {{ $tutor->avg_time }} hour(s)</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--/.card -->
                </div>

            </div>

        </div>

    </section>

@endsection



@push('scripts')

  <script>

       $(function () {

    //  var ele =    document.getElementsByClassName('select2-selection');
    //  for(var i = 0;i<ele.leanth;i++){
    //     ele[i].style.height = '50px';
    //  }


   //Initialize Select2 Elements

        $('.select22').select2({
            dropdownParent: $('#currentModal')
        });



        $('#select2-echannel-doctor').select2({
            ajax: {
                method: 'GET',
                url: '{{route('student.get_topics')}}',
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        _method: "GET",
                       // _token: "{{csrf_token()}}",
                        type: 'public'
                    };
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },

                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.results
                    };
                }
            },
            dropdownParent: $('#currentModal')
        });

    });


    $( document ).ready(function() {
        document.querySelectorAll('[role="combobox"]').forEach(function (el){
        el.classList.add("eletest");
        });
        console.log( "ready!" );
    });
  </script>

@endpush

