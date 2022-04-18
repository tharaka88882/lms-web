@extends('layouts.app')

@section('title')
    Mentees | YOU2MENTOR
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
                <li class="breadcrumb-item active">Mentee</li>
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
            <h3 class="card-title">Mentees List</h3>

            <div class="card-tools">
                <a href="{{route('admin.add_students')}}" type="button" class="btn btn-block btn-success">Add New</a>
            </div>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->user->name}}</td>
                            <td>{{$student->user->email}}</td>
                            <td>{{$student->grade}}</td>
                            <td><h5><span class="badge badge-secondary">{{$student->status==('1')? 'Active':'Inactive'}}</span><h5></td>
                            <td>
                              <a class="btn btn-sm btn-warning" href="{{route('admin.edit_student', $student->id)}}"><i class="far fa-edit"></i> Edit</a>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            {{ $students->render() }}
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>
      {{-- @extends('modal.add_student') --}}
      <!-- /.content -->
      {{-- <div class="modal fade" id="modal-add-student">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Sublect</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}
@endsection
