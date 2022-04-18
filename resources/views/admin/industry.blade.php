@extends('layouts.app')

@section('title')
    Mentor Working Industries
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
        <h3 class="card-title">Add Industry</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.industry')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="SubjectName"> Industry Name</label>
                    <input type="text" class="form-control @if($errors->has('name')) {{'is-invalid'}} @endif" id="name" name="name" placeholder="Mentoring Topic Name">

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
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Industries List</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table ">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($industries as $industry)
                      <tr>
                          <td>{{$i}}</td>
                          <td>{{$industry->name}}</td>
                          <td><h5><span class="badge badge-secondary">{{$industry->status==('1')? 'Active':'Inactive'}}</span><h5></td>
                          <td>
                            <button type="button" class="btn btn-danger pull-right" id="deleteBtn-{{$industry->id}}">Delete</button>
                            <form action="{{route('admin.delete_industry', $industry->id)}}" id="deleteform-{{$industry->id}}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
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
      $(document).on('click','[id^=deleteBtn-]', function() {
            var num = this.id.split('-')[1];
            if (confirm("Are you sure?") == true) {
                $('#deleteform-'+num).submit();
            }
        });
  </script>
@endpush
