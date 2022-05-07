@extends('layouts.app')

@section('title')
    Conversations | YOU2MENTOR
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
            <h3 class="card-title">Mentee Conversations</h3>
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

                                            <input placeholder="Enter Mentee name" class="select2 form-control" data-placeholder="Any" name="m_name"/>

                                        </div>



                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">

                                            <label> My Development:</label>

                                            <input placeholder="Enter Development" class="select2 form-control" data-placeholder="Any" name="develop"/>

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
                                                    <img alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" src="{{ url('public') }}/images/{{$conversation['image']}}" onerror=" this.src='{{ url('public') }}/images/def.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="#">{{$conversation['name']}}</a></h4>
                                                    <span>
                                                    @foreach ($conversation['milestone'] as $milestone)
                                                    <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">

                                                            <span class="badge bg-gray">{{$milestone->note}}</span>
                                                    </div>
                                                    @endforeach
                                                </span>


                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                         @if ($conversation['user']=='mentee')
                                                         <a href="{{route('teacher.view_conversation',$conversation['conversation_id'])}}">
                                                            <button class="btn btn-sm btn-primary w-100 ml-2">Conversation</button>
                                                        </a>

                                                        @else
                                                        <a href="{{route('teacher.view_mentor_conversation',$conversation['conversation_id'])}}">
                                                            <button class="btn btn-sm btn-primary w-100 ml-2">Conversation</button>
                                                        </a>
                                                         @endif
                                                         <a>
                                                            <button  data-toggle="modal" data-target="#modal-md{{$conversation['conversation_id']}}" class="btn btn-sm btn-warning w-100 ml-3">Notes</button>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                    $i++;
                                @endphp

                                    <!-- /.modal -->
                                    <div class="modal fade" id="modal-md{{$conversation['conversation_id']}}">
                                        <div class="modal-dialog modal-sm">
                                        <div class="modal-content" style="background-color: rgb(255, 251, 0);">
                                            <div class="modal-header">
                                            <h4 class="modal-title" style="text-transform: capitalize">{{$conversation['name']}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                                @csrf

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        {{-- <label>Any Comments</label> --}}
                                                        <textarea onkeyup="saveNote('{{$conversation['id']}}');" id="stikey_{{$conversation['id']}}" style="background-color: rgb(255, 251, 0);"  name="question3" class="form-control" rows="6">
                                                            {{$conversation['stikey']}}
                                                        </textarea>
                                                        <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                                            </div>
                                                </div>
                                            {{-- <div class="modal-footer justify-content-between btn-group">
                                            <button onclick="saveNote('{{$conversation['id']}}');" type="submit" class="btn btn-warning">Save</button>
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
function saveNote(id){

    $.post("{{route('user.update_mentee_stikey')}}",
        {
            id: id,
            note: $('#stikey_'+id).val(),
            _method: "PUT",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                console.log('success');
                //window.location="{{route('user.milestone')}}";
            }
        });
    //alert('test');
}

</script>
@endpush
