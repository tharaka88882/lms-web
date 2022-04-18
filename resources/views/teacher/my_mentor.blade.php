@extends('layouts.app')

@section('title')
    Mentors | YOU2MENTOR
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
            <h3 class="card-title">Mentor List</h3>
          </div>
          <div class="card-body">
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
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>
@endsection
