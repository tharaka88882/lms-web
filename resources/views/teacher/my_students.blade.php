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

                                                    @foreach ($conversation['milestone'] as $milestone)
                                                    <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                        <span>My Developments -
                                                            <span class="badge bg-gray">{{$milestone->note}}</span>
                                                        </span>
                                                    </div>
                                                    @endforeach

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

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                    $i++;
                                @endphp
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
