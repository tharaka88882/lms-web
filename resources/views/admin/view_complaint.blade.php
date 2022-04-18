@extends('layouts.app')

@section('title')
    Complaints | YOU2MENTOR
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
            <li class="breadcrumb-item active">Complaints</li>
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
        <h3 class="card-title">View Complaint</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="#" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="SubjectName">Mentee name</label>
                    <input type="text" class="form-control" id="name" name="name" value="Testing" placeholder="Mentee">

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="SubjectName">Complaint</label>
                    <textarea class="form-control" id="name" name="name" placeholder="Complaint">Testing</textarea>
                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">

                <button type="submit" class="btn btn-success pull-right">Save</button>

            </div>
        </form>
    </div>
  </div>
  <!-- /.card -->
  </section>
@endsection
