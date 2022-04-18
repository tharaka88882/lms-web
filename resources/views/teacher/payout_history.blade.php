@extends('layouts.app')

@section('title')
    Payout History | YOU2MENTOR
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
                <li class="breadcrumb-item active">Payout History</li>
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
            <h3 class="card-title">Payout History</h3>

          </div>
          <div class="card-body">
              <div class="table-responsive">
                     <table class="table text-center">
                    <thead>
                        <tr>
                            {{-- <th>Sender</th>
                            <th>Receiver</th> --}}
                            <th>#</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Date/Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($userTransactions as $userTransaction)
                        <tr>
                            {{-- <td>{{$userTransaction->sender->name}}</td>
                            <td>{{$userTransaction->receiver->name}}</td> --}}
                            <td>{{$i}}</td>
                            <td>{{$userTransaction->amount}}</td>
                            <td>{{$userTransaction->notes}}</td>
                            <td>{{date('Y/m/d | H:i', strtotime($userTransaction->updated_at))}}</td>
                            <td><h5><span class="badge badge-secondary">{{$userTransaction->status==('1')? 'Completed':'Processing'}}</span><h5></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{route('teacher.view_payout',$userTransaction->id)}}"><i class="far fa-eye"></i> View</a>
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
