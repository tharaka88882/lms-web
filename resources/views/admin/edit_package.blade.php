@extends('layouts.app')

@section('title')
    Edit Package
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
            <li class="breadcrumb-item active">Packages</li>
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
        <h3 class="card-title">Edit Payment Package</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.update_package', $id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="PackageName">Package Name</label>
                    <input type="text" class="form-control @if($errors->has('name')) {{'is-invalid'}} @endif" id="name" name="name" placeholder="Package Name" value="{{$package->name}}">

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="StreamingCount">Streaming Count</label>
                    <input type="number" class="form-control @if($errors->has('count')) {{'is-invalid'}} @endif" id="count" name="count" placeholder="Steaming Count" value="{{$package->streaming_count}}">

                    @if($errors->has('count'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('count') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control @if ($errors->has('description')) {{ 'is-invalid' }} @endif"
                        rows="3" placeholder="Description">{{$package->description}}</textarea>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div> --}}
                <div class="form-group">
                    <label for="PackagePrice">Package Price</label>
                    <input type="text" class="form-control @if($errors->has('price')) {{'is-invalid'}} @endif" id="price" name="price" placeholder="Package Price" value="{{$package->price}}">

                    @if($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ribbon Color</label>
                    <select class="form-control  @if($errors->has('color')) {{'is-invalid'}} @endif" name="color">
                        <option value="yellow" @if ($package->color=='yellow') {{'selected'}} @endif>Yellow</option>
                        <option value="gray" @if ($package->color=='gray') {{'selected'}} @endif>Gray</option>
                        <option value="red" @if ($package->color=='red') {{'selected'}} @endif>Red</option>
                        <option value="lime" @if ($package->color=='lime') {{'selected'}} @endif>Lime</option>
                        <option value="olive" @if ($package->color=='olive') {{'selected'}} @endif>Olive</option>
                        <option value="teal" @if ($package->color=='teal') {{'selected'}} @endif>Teal</option>
                        <option value="indigo" @if ($package->color=='indigo') {{'selected'}} @endif>Indigo</option>
                        <option value="fuchsia" @if ($package->color=='fuchsia') {{'selected'}} @endif>Fuchsia</option>
                    </select>

                    @if($errors->has('color'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('color') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="status" {{$package->status==('1')? 'Checked':''}}>
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
        <form action="{{route('admin.delete_package', $id)}}" id="deleteform" method="POST">
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
