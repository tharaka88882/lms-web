@extends('layouts.app')

@section('title')
    Add Packages
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
            <li class="breadcrumb-item active">Add Packages</li>
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
        <h3 class="card-title">Add Premium Package</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin.store_package')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="PackageName">Package Name</label>
                    <input type="text" class="form-control @if($errors->has('name')) {{'is-invalid'}} @endif" id="name" name="name" placeholder="Package Name">

                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="StreamingCount">Streaming Count</label>
                    <input type="number" class="form-control @if($errors->has('count')) {{'is-invalid'}} @endif" id="count" name="count" placeholder="Steaming Count">

                    @if($errors->has('count'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('count') }}</strong>
                        </span>
                    @endif
                </div>
                {{-- <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control @if ($errors->has('description')) {{ 'is-invalid' }} @endif"
                        rows="3" placeholder="Description"></textarea>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div> --}}
                <div class="form-group">
                    <label for="PackagePrice">Package Price</label>
                    <small>( $ )</small>
                    <input type="text" class="form-control @if($errors->has('price')) {{'is-invalid'}} @endif" id="price" name="price" placeholder="Package Price">

                    @if($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ribbon Color</label>
                    <select class="form-control  @if($errors->has('color')) {{'is-invalid'}} @endif" name="color">
                        <option value="yellow">Yellow</option>
                        <option value="gray">Gray</option>
                        <option value="red">Red</option>
                        <option value="lime">Lime</option>
                        <option value="olive">Olive</option>
                        <option value="teal">Teal</option>
                        <option value="indigo">Indigo</option>
                        <option value="fuchsia">Fuchsia</option>
                    </select>

                    @if($errors->has('color'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('color') }}</strong>
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
