@extends('layouts.app')

@section('title')
Payment Packages List | YOU2MENTOR
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
                <li class="breadcrumb-item active"> Payment Packages</li>
              </ol>
            </div> --}}
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Premium Packages List</h3>

            <div class="card-tools">
              <a href="{{route('admin.create_package')}}" type="button" class="btn btn-block btn-success">Add New</a>

              {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button> --}}
              {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button> --}}
            </div>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Streaming Count</th>
                            {{-- <th>Description</th> --}}
                            <th>Price($)</th>
                            <th>Ribbon Color</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i =1;
                    @endphp
                         @foreach($packages as $package)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$package->name}}</td>
                            <td>{{$package->streaming_count}}</td>
                            {{-- <td>{{$package->description}}</td> --}}
                            <td>{{$package->price}}</td>
                            <td><h4 class="text-center text-md bg-{{$package->color}}">{{ ucfirst(trans($package->color)) }}</h4></td>
                            {{-- <td>{{$package->color}}</td> --}}
                            <td><h5><span class="badge badge-secondary">{{$package->status==('1')? 'Active':'Inactive'}}</span><h5></td>
                            <td>
                                <a  class="btn btn-sm btn-warning" href="{{route('admin.edit_package', $package->id)}}"><i class="far fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                        @php
                        $i ++;
                    @endphp
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            {{ $packages->render() }}
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </div>
      </section>

{{-- @extends('modal.add_subject') --}}
        {{-- @yield('add-subject') --}}
    {{-- <div class="modal fade" id="modal-lg">
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
    <!-- /.modal -->
      <!-- /.content -->
@endsection
