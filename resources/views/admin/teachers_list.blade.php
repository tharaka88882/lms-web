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
                <li class="breadcrumb-item active">Mentor </li>
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
            <h3 class="card-title">Mentors List</h3>

            <div class="card-tools">
              <a href="{{route('admin.add-teachers')}}" class="btn btn-block btn-success">Add New</a>
            </div>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Email</th>
                            <th>Qualification</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                        <tr>
                            <td>{{$teacher->id}}</td>
                            <td>{{$teacher->user->name}}</td>
                            <td>{{$teacher->nic}}</td>
                            <td>{{$teacher->user->email}}</td>
                            <td>{{$teacher->qualification}}</td>
                            <td><h5><span class="badge badge-secondary">{{$teacher->status==('1')? 'Active':'Inactive'}}</span><h5></td>
                            <td>
                                 <a class="btn btn-sm btn-warning" href="{{route('admin.edit_teacher', $teacher->id)}}"><i class="far fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            {{ $teachers->render() }}
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
@endsection
