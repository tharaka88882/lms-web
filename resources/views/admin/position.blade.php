@extends('layouts.app')

@section('title')
    Mentor Positions
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
            <li class="breadcrumb-item active">Add Industry</li>
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
                    <h3 class="card-title">Add Positions</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.store_position') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="SubjectName"> Positions Name</label>
                            <input type="text"
                                class="form-control @if ($errors->has('name')) {{ 'is-invalid' }} @endif" id="name"
                                name="name" placeholder="Positions Name">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
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
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Positions List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($positions as $position)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $position->text }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('admin.edit_position', $position->id) }}"><i
                                                    class="far fa-edit"></i> Edit</a>
                                            {{-- <button type="button" class="btn btn-danger"
                                                id="deleteBtn-{{ $position->id }}">Delete</button>
                                            <form action="{{ route('admin.destory_position', $position->id) }}"
                                                id="deleteform-{{ $position->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form> --}}
                                        </td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '[id^=deleteBtn-]', function() {
            var num = this.id.split('-')[1];
            if (confirm("Are you sure?") == true) {
                $('#deleteform-' + num).submit();
            }
        });
    </script>
@endpush
