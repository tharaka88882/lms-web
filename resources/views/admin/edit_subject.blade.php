@extends('layouts.app')

@section('title')
    Edit  Mentoring Topics
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
            <li class="breadcrumb-item"><a>Home</a></li>
            <li class="breadcrumb-item active">Edit  Mentoring Topics </li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
  <!-- general form elements -->
  <div class="col-sm-6">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Edit  Mentoring Topic</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.update_subject', $id)}}" method="POST">
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="SubjectName"> Mentoring Topic Name</label>
            <input type="text" class="form-control @if($errors->has('name')) {{'is-invalid'}} @endif" id="exampleInputEmail1" name="name" placeholder="Subject Name" value="{{$subject->name}}">

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>
                  <!-- checkbox -->
            <div class="form-group">
                <label for="SubjectName">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" name="status" type="checkbox" {{$subject->status==('1')? 'Checked':''}}>
                      <label class="form-check-label">Active</label>
                    </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success pull-right">Save</button>
            <button type="button" class="btn btn-danger pull-right" id="deleteBtn">Delete</button>
        </div>
        </form>
        <form action="{{route('admin.delete_subject', $id)}}" id="deleteform" method="POST">
            @csrf
            @method('delete')
        </form>
    </div>
  </div>
  <!-- /.card -->
  </section>
@endsection

@push('scripts')
  <script>
      $('#deleteBtn').click(function(){
        if (confirm("Are you sure?") == true) {
          $('#deleteform').submit();
        }
      });
  </script>
@endpush
