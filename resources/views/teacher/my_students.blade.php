@extends('layouts.app')

@section('title')
    Conversations | YOU2MENTOR
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
                <li class="breadcrumb-item active">Mentees</li>
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
            <h3 class="card-title">My Mentees</h3>
          </div>


          <div class="card-body">
          <div class="row">

            <div class="col-md-12">

                <!-- USERS LIST -->

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">Filter a Mentee</h3>



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

                            <form action="{{ route('teacher.conversation_list') }}">

                                <div class="row">



                                    <div class="col-lg-4">

                                        <div class="form-group">

                                            <label>Name:</label>

                                            <input value="{{$request->get('m_name')}}" placeholder="Enter Mentee name" class="select2 form-control"  name="m_name"/>

                                        </div>



                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">

                                            <label>Development Area:</label>

                                            <input value="{{$request->get('develop')}}" placeholder="Enter Development" class="select2 form-control"  name="develop"/>

                                        </div>


                                    </div>

                                    {{-- <div class="col-lg-4">


                                        <div class="form-group">

                                            <label>Sort Order:</label>

                                            <select class="select2 form-control" style="width: 100%;">

                                                <option selected>Rating ASC</option>

                                                <option>Rating DESC</option>

                                            </select>

                                        </div>

                                    </div> --}}
                                    <div class="col-lg-4">
                                        <button  class="btn btn-success" style="margin-top: 30px;">Filter</button>

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

                        @php
                            $i = 1;
                        @endphp
                        @foreach($conversations as $conversation)
                                    <div class="col-md-6">
                                        <div class="card p-2">
                                            <div class="d-flex align-items-center">
                                                <a href="#">
                                                    <img alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" src="{{ url('public') }}/images/profile/{{$conversation['image']}}" onerror=" this.src='{{ url('public') }}/images/def.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="#">{{$conversation['name']}}</a></h4>

                                                    <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                        <span>
                                                        @foreach ($conversation['milestone'] as $milestone)
                                                            <span class="badge" style="color: #564b4b; background-color: #868f976b; !important">{{$milestone->note}}</span>
                                                        @endforeach
                                                    </span>
                                                    </div>

                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                         <div class="row">
                                                            <div class="col-xs-12">
                                                                @if ($conversation['user']=='mentee')
                                                            <a href="{{route('teacher.view_conversation',$conversation['conversation_id'])}}">
                                                               <button class="btn btn-sm btn-primary w-100">Conversation</button>
                                                           </a>

                                                           @else
                                                           <a href="{{route('teacher.view_mentee_conversation',$conversation['conversation_id'])}}">
                                                               <button class="btn btn-sm btn-primary w-100">Conversation</button>
                                                           </a>
                                                            @endif
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <a>
                                                                    <button  data-toggle="modal" data-target="#modal-md{{$conversation['ar_index']}}" class="btn btn-sm btn-warning w-100 ml-1">Notes</button>
                                                                </a>
                                                            </div>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                    $i++;
                                @endphp

                                    <!-- /.modal -->
                                    <div class="modal fade" id="modal-md{{$conversation['ar_index']}}">
                                        <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" style="text-transform: capitalize">{{$conversation['name']}} Notes</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                @csrf
                                            <div class="modal-body">
                                              <div class="container">
                                                <div class="row">
                                                    <div class="form-group col-md-9">
                                                        {{-- <label>Any Comments</label> --}}
                                                        <input id="stikey_{{$conversation['ar_index']}}"  name="question3" class="form-control" required/>
                                                            {{-- @foreach ($conversation->mentor->stikey as $stikey)
                                                            @if ($stikey->user_id==Auth()->user()->id && $stikey->teacher_id==$conversation->mentor->id)
                                                            {{$stikey->note}}
                                                            @endif
                                                            @endforeach --}}
                                                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        {{-- <label>Any Comments</label> --}}
                                                        <button onclick="saveNote('{{$conversation['id']}}','{{$conversation['user']}}','{{$conversation['ar_index']}}');" class="btn btn-success">Save</button>
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
                                                                    <th>Note</th>
                                                                    <th>Date Added</th>
                                                                    <th >Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $i = 1;
                                                                @endphp
                                                               @foreach ($conversation['stikey'] as $stikey)

                                                              @if ($stikey->user_id == Auth()->user()->id)
                                                              <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{$stikey->note}}</td>
                                                                <td>@displayDate($stikey->updated_at)</td>
                                                                <td >

                                                                      {{-- <a href="" class="btn btn-sm btn-warning" id="goal">Update</a> --}}


                                                                      <button type="button" onclick="del_stikey('{{$stikey->id}}','{{$conversation['user']}}');" class="btn btn-sm btn-danger" id="del_{{$stikey->id}}">Delete</button>


                                                                </td>
                                                            </tr>
                                                            @php
                                                            $i++;
                                                        @endphp
                                                              @endif

                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                      </div>
                                                   </div>
                                        </div>

                                            {{-- <div class="modal-footer justify-content-between btn-group">
                                            <button  type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div> --}}
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
function saveNote(id,user,ar_index){

   if( $('#stikey_'+ar_index).val()!=""){
    $.post("{{route('user.update_mentee_stikey')}}",
        {
            id: id,
            note: $('#stikey_'+ar_index).val(),
            user:user,
            _method: "PUT",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                window.location="{{route('teacher.conversation_list')}}";
            }
        });
   }else{
    alert("Note can't be null !");
   }
    //alert('test');
}

function del_stikey(id,user){
    //$(document).keyup(function (e) {
       //  console.log(e.keyCode);
       //alert(e.keyCode);
   // if(e.keyCode==13){
    if (confirm("Are you sure?") == true) {
        $.post("{{route('user.distory_mentor_stikey')}}",
        {
            id: id,
            user: user,
            _method: "delete",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                window.location="{{route('teacher.conversation_list')}}";
            }
        });
    }
    //alert('saved');

  // }
     // });


}

$( document ).ready(function() {
        document.querySelectorAll('[role="combobox"]').forEach(function (el){
        el.classList.add("eletest");
        });
        console.log( "ready!" );
    });
</script>
@endpush
