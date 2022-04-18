@extends('layouts.app')

@section('title')
    Notifications
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
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Home</a></li>
                <li class="breadcrumb-item active">Notifications </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">My Notifications</h3>

            <div class="card-tools">

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
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Seen</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $notification)
                        <tr>
                            <td><a href="{{$notification->url}}">{{$notification->message}}</a></td>
                            <td>@if($notification->seen) {{'Seen'}}@endif</td>
                            <td>{{$notification->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            {{ $notifications->links() }}
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
