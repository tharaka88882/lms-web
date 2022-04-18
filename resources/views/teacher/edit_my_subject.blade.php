@extends('layouts.app')

@section('title')
    Edit My  Mentoring Topics
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
            <li class="breadcrumb-item active">Edit My  Mentoring Topics </li>
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
      <h3 class="card-title">Add My  Mentoring Topics</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('teacher.stor_subject')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1"> Mentoring Topics</label>
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success pull-right">Add</button>
      </div>
    </form>
  </div>
</div>
  <!-- /.card -->
  </section>
@endsection
