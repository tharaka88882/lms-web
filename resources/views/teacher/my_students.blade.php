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
          <!-- <div class="card-body">
              <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mantee Name</th>
                            {{-- <th>Email</th> --}}
                            <th>Grade/Level</th>
                            {{-- <th>Status</th> --}}
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($conversations as $conversation)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$conversation['name']}}</td>
                            {{-- <td>{{$conversation->student->user->email}}</td> --}}
                            <td>{{$conversation['grade']}}</td>

                            {{-- <td><h5><span class="badge badge-secondary">{{$conversation->student->status==('1')? 'Active':'Inactive'}}</span><h5></td> --}}
                            <td>
                                @if ($conversation['user']=='mentee')
                                <a class="btn btn-sm btn-warning" href="{{route('teacher.view_conversation', $conversation['conversation_id'])}}"><i class="far fa-edit"></i> View Conversation</a>

                                @else
                                <a class="btn btn-sm btn-warning" href="{{route('teacher.view_mentor_conversation', $conversation['conversation_id'])}}"><i class="far fa-edit"></i> View Conversation</a>

                                @endif
                          </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div> -->


          <div class="card-body">
          <div class="row">
                                    <div class="col-md-6">
                                        <div class="card p-2">
                                            <div class="d-flex align-items-center">
                                                <a href="#">
                                                    <img alt="User Image" style="width: 120px; height: 120px; border-radius: 50%;" onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'">
                                                </a>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><a style="text-transform: capitalize" href="#">Mentee Name</a></h4>
                                                  
                                                    <div class="p-2 mt-2 bg-light d-flex justify-content-between rounded text-white stats" style="font-size: 14px;">
                                                            <span>My Developments -
                                                                <span class="badge bg-gray">Milestone 1</span>
                                                                <span class="badge bg-gray">Milestone 2</span>

                                                            </span>
                                                        </div>

                                                    <div class="button mt-2 d-flex flex-row align-items-center">
                                                            <a href="#">
                                                                <button class="btn btn-sm btn-primary w-100 ml-2">Conversation</button>
                                                            </a>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
