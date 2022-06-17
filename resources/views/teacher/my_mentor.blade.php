@extends('layouts.app')

@section('title')
    Mentors | YOU2MENTOR
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

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              {{-- <h1>YOU2MENTOR</h1> --}}
            </div>
            {{-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Mentor</li>
              </ol>
            </div> --}}
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Mentor conversations List</h3>
          </div>
          <!-- <div class="card-body">
              <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conversations as $conversation)
                        <tr>
                            <td>{{$conversation->mentor->id}}</td>
                            <td>{{$conversation->mentor->user->name}}</td>
                            <td>{{$conversation->mentor->user->email}}</td>
                            <td><h5><span class="badge badge-secondary">{{$conversation->mentor->status==('1')? 'Active':'Inactive'}}</span><h5></td>
                            <td>
                              <a class="btn btn-sm btn-warning" href="{{route('teacher.view_mentor_conversation', $conversation->id)}}"><i class="far fa-edit"></i> View Conversation</a>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div> -->


          <div class="card-body">
          <div class="row">
            <div class="col-md-12">

                <!-- USERS LIST -->

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">Filter a Mentor</h3>



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

                            <form action="{{ route('teacher.mentor_conversation_list') }}">

                                <div class="row">

                                    <div class="col-lg-3">

                                        <div class="form-group">

                                            <label> Name:</label>

                                            <input placeholder="Enter Mentor Name" class="select2 form-control" data-placeholder="Any" name="m_name"/>

                                        </div>

                                        <div class="form-group">

                                            <label>Sort Order:</label>

                                            <select class="select2 form-control" style="width: 100%;">

                                                <option selected>Rating ASC</option>

                                                <option>Rating DESC</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-lg-3">

                                        <div class="form-group" id="currentModal">

                                            <label> Mentoring Topics:</label>

                                            {{-- <select class="select2 form-control" data-placeholder="Any"

                                                style="width: 100%;" name="search_subject">

                                                <option>Any</option>

                                                @foreach ($subjects as $subject)

                                                    <option value="{{ $subject->id }}" @if ($subject->id == $request->get('search_subject')) {{ 'selected' }} @endif>

                                                        {{ $subject->name }}</option>

                                                @endforeach

                                            </select> --}}

                                             <select name="search_subject" class="form-control select22 @if($errors->has('search_subject')) {{'is-invalid'}} @endif" id="select2-echannel-doctor">

                                                {{-- <option>Any</option> --}}

                                            </select>

                                        </div>
                                        <div class="form-group" id="currentModal">
                                            <label>Industry:</label>
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

                                            <label>City:</label>

                                            <input placeholder="Enter City" class="select2 form-control" data-placeholder="Any" name="city"/>

                                        </div>
                                        <div class="form-group">

                                            <label>Company:</label>

                                            <input placeholder="Enter Company" class="select2 form-control" data-placeholder="Any" name="company"/>

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
                                            <button  class="btn btn-success" style="margin-top: 30px;">Filter</button>
                                        </div>
                                    </div>

                                    @csrf
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- /.card-body -->

                </div>

                <!--/.card -->

            </div>
            @foreach($conversations as $conversation)
                                    <div class="col-md-6">
                                        <div class="card p-2">
                                            <div class="d-flex align-items-center">
                                                <a href="#">
                                                    <img alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" src="{{ url('public') }}/images/profile/{{$conversation->mentor->user->image}}" onerror=" src='{{ url('public') }}/images/def.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="#">{{$conversation->mentor->user->name}}</a></h4>



                                                    @php
                                                    $mediation = 0;
                                                    $rator_count = count(json_decode($conversation->mentor->ratings,true));
                                                    $rating_count = 0;
                                                        $mediation = 0;
                                                    @endphp
                                                    @foreach ($conversation->mentor->ratings as $rating1)
                                                    @php
                                                    $rating_count+=$rating1->rating;
                                                    @endphp



                                                    @if($rator_count!=0)
                                                       @php
                                                            $mediation = $rating_count/$rator_count;
                                                       @endphp
                                                    @endif

                                                       @php
                                                            $round_mediation =(int)$mediation;
                                                       @endphp



                                                    @endforeach

                                                    @php
                                                        $i = 0;
                                                        //$r = intval(Auth()->user()->userable->level);
                                                        $r = (int)$mediation;
                                                    @endphp
                                                    @while ($i<5)
                                                        @if ($r>0)
                                                        <span class="fa fa-star checked"></span>
                                                        @else
                                                        <span class="fa fa-star"></span>

                                                        @endif
                                                        @php
                                                        $i += 1;
                                                        $r -=1;
                                                        @endphp
                                                    @endwhile

                                                    @if (sizeof($conversation->mentor->experiences)>0)
                                                    @php
                                                       $sizeArr = sizeof($conversation->mentor->experiences);
                                                       $i = 0;
                                                    @endphp
                                                    @foreach ($conversation->mentor->experiences as $experience)
                                                   @php
                                                        $i++;
                                                   @endphp
                                                   @if ($i == $sizeArr)
                                                   <span class="users-list-date">Job Title - {{ $experience->position->text }}</span>
                                                   @endif
                                                    @endforeach

                                                    @endif
                                                    {{-- <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                        <span>Skills -
                                                           @foreach ($conversation->mentor->teachersubject as $skils)

                                                            <span class="badge bg-gray">{{$skils->name}}</span>

                                                           @endforeach
                                                        </span>
                                                        </div> --}}

                                                        @if (count($conversation->subjects)>0)
                                                        <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                            <span>Skills -
                                                            @foreach ($conversation->subjects as $subject)
                                                                <span class="badge bg-gray">{{$subject['name']}}</span>
                                                            @endforeach
                                                            </span>
                                                        </div>
                                                    @endif
                                                    {{-- <span class="users-list-date">Timely Responce - {{ $conversation->avg_time }} hour</span> --}}

                                                        @if ($conversation->mentor->user->country!=null)
                                                        <span class="users-list-date">{{$conversation->mentor->user->country}}/{{$conversation->mentor->user->city}}</span>
                                                        @endif
                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <a href="{{route('teacher.view_mentor',$conversation->mentor->id)}}">
                                                                    <button class="btn btn-xs btn-outline-primary w-100">View Profile</button>
                                                                </a>
                                                            </div>
                                                              <div class="col-xs-12">
                                                                <a href="{{route('teacher.view_mentor_conversation', $conversation->id)}}">
                                                                    <button class="btn btn-xs btn-primary w-100 ml-1">Conversation</button>
                                                                </a>
                                                              </div>
                                                              <div class="col-xs-12">
                                                                <a>
                                                                    <button  data-toggle="modal" data-target="#modal-md{{$conversation->id}}" class="btn btn-xs btn-warning w-100 ml-2">Notes</button>
                                                                </a>
                                                              </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <span class="users-list-date text-right">Average Responce Time - {{ $conversation->avg_time }} hour</span>
                                        </div>
                                    </div>


                                                                            <!-- /.modal -->
                                                                            <div class="modal fade" id="modal-md{{$conversation->id}}">
                                                                                <div class="modal-dialog modal-md">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                    <h4 class="modal-title" style="text-transform: capitalize">{{$conversation->mentor->user->name}}Notes</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                        @csrf
                                                                                        <div class="modal-body">
                                                                                            <div class="container">
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-sm-9">
                                                                                                        {{-- <label>Any Comments</label> --}}
                                                                                                        <input id="stikey_{{$conversation->mentor->id}}"  name="question3" class="form-control" required/>
                                                                                                            {{-- @foreach ($conversation->mentor->stikey as $stikey)
                                                                                                            @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                                                                                                            {{$stikey->note}}
                                                                                                            @endif
                                                                                                            @endforeach --}}
                                                                                                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                                                                                                    </div>
                                                                                                    <div class="form-group col-sm-3">
                                                                                                        {{-- <label>Any Comments</label> --}}
                                                                                                        <button onclick="saveNote1('{{$conversation->mentor->id}}');" class="btn btn-success">Save</button>
                                                                                                            {{-- @foreach ($conversation->mentor->stikey as $stikey)
                                                                                                            @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                                                                                                            {{$stikey->note}}
                                                                                                            @endif
                                                                                                            @endforeach --}}
                                                                                                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                                                                                                    </div>
                                                                                                </div>
                                                                                                    <div class="table-responsive">
                                                                                                        <table class="table ">
                                                                                                            <thead>
                                                                                                                <tr>
                                                                                                                    <th>#</th>
                                                                                                                    <th>Stikey Note</th>
                                                                                                                    <th>Date Added</th>
                                                                                                                    <th>Actions</th>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>
                                                                                                                @php
                                                                                                                    $i = 1;
                                                                                                                @endphp
                                                                                                               @foreach ($conversation->mentor->stikey as $stikey)
                                                                                                               <tr>
                                                                                                                <td>{{$i}}</td>
                                                                                                                <td>{{$stikey->note}}</td>
                                                                                                                {{-- <td>{{date('Y/m/d | H:i', strtotime($stikey->updated_at))}}</td> --}}
                                                                                                                {{-- <td>{{ Timezone::convertToLocal($stikey->updated_at, 'Y/m/d | H:i', true) }}</td> --}}
                                                                                                                <td>@displayDate($stikey->updated_at)</td>
                                                                                                                <td >
                                                                                                                      {{-- <a href="" class="btn btn-sm btn-warning" id="goal">Update</a> --}}
                                                                                                                      <button type="button" onclick="del_stikey('{{$stikey->id}}');" class="btn btn-sm btn-danger" id="del_{{$stikey->id}}">Delete</button>
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
                                                                                <!-- /.modal-content -->
                                                                                </div>
                                                                                <!-- /.modal-dialog -->
                                                                            </div>
                                                                            <!-- /.modal -->
                        @endforeach
                            </div>
                            </div>



          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>



@endsection

@push('scripts')
<script>
function del_stikey(id){
    //$(document).keyup(function (e) {
       //  console.log(e.keyCode);
       //alert(e.keyCode);
   // if(e.keyCode==13){
    if (confirm("Are you sure?") == true) {
        $.post("{{route('user.distory_stikey')}}",
        {
            id: id,
            _method: "delete",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                window.location="{{route('teacher.mentor_conversation_list')}}";
            }
        });
    }
    //alert('saved');

  // }
     // });


}
function saveNote1(id){
    // var n = new Date();
    // $('#stikey_'+id).val( n+" "+$('#stikey_'+id).val());
  if($('#stikey_'+id).val() !=""){
    $.post("{{route('user.update_stikey')}}",
        {
            id: id,
            note: $('#stikey_'+id).val(),
            _method: "PUT",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                window.location="{{route('teacher.mentor_conversation_list')}}";
            }
        });
  }else{
    alert("Stikey note can't be null !");
  }
   // alert('saved');

}

$(function () {

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
