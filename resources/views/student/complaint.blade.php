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
        <h3 class="card-title">Flag profile for inappropriate content or behaviour</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('student.add_complaint')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="SubjectName">Choose</label>
                    <select class="form-control" name="status">
                        <option>Behaviour</option>
                        <option>Content</option>
                        <option>Other</option>
                    </select>
                    {{-- @if($errors->has('complaint'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('complaint') }}</strong>
                        </span>
                    @endif --}}
                </div>

                <div class="form-group">
                    <label for="SubjectName">Details</label>
                    <textarea class="form-control" id="name" name="complaint" placeholder="Add details"></textarea>
                    @if($errors->has('complaint'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('complaint') }}</strong>
                        </span>
                    @endif
                </div>
                <input type="hidden" name="mentor_id" value="{{$id}}"/>
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
