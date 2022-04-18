@extends('layouts.app')

@section('title')
    User Orders | YOU2MENTOR
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
                <li class="breadcrumb-item active">User Orders</li>
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
            <h3 class="card-title">User Orders</h3>

          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Package</th>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Date/Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_orders as $user_order)
                         <tr>
                            <td>{{$user_order->id}}</td>
                            <td>{{$user_order->user->name}}</td>
                            <td>{{$user_order->payment_package->name}}</td>
                            <td>{{$user_order->reference}}</td>
                            <td>{{$user_order->amount}}</td>
                            <td>{{date('Y/m/d | H:i', strtotime($user_order->created_at))}}</td>
                            <td><h5><span class="badge badge-{{$user_order->status==('1')? 'success':'danger'}}">{{$user_order->status==('1')? 'Successful':'Unsuccessful'}}</span><h5></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{route('admin.view_order', $user_order->id)}}"><i class="far fa-eye"></i> View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

              </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </div>
      </section>
      <!-- /.content -->
@endsection
@push('scripts')
  <script>
      $('#updateBtn').click(function(){
      });

      function updateComplaiant(id){

        if (confirm("Are you sure?") == true) {
            $.post("{{route('admin.update_complaint')}}",
            {
                id: id,
                _method: "put",
                _token: "{{ csrf_token() }}"
            },
            function(data, status){
                if(data.success==true){
                    window.location="{{route('admin.complaints')}}";
                }
            });
        }
      }
  </script>
@endpush
