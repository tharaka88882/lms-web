@extends('layouts.app')

@section('title')
    Edit Mentor Position
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
                    <h3 class="card-title">Edit Mentor Position</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.update_position', $id) }}" method="POST">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="PositionName">Position Name</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name')) {{ 'is-invalid' }} @endif" id="name"
                                name="name" placeholder="Position Name" value="{{ $position->text }}">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="button-group pull-right">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                            <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('admin.destory_position', $id) }}" id="deleteform" method="POST">
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
        $('#deleteBtn').click(function() {
            if (confirm("Are you sure?") == true) {
                $('#deleteform').submit();
            }
        });
    </script>
@endpush
