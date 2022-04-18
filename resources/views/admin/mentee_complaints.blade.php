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

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Mentee Complaints</h3>

          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mentee</th>
                            <th>Mentor</th>
                            <th>Complaint</th>
                            <th>Seen</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                     @php
                        $i =1;
                    @endphp
                      @foreach ($complaints as $complaint)

                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$complaint->user->name}}</td>
                            <td>{{$complaint->mentor->user->name}}</td>
                            <td>{{$complaint->description}}</td>
                            <td>{{($complaint->seen==1)?'seen':'unseen'}}</td>
                            <td>
                                <button  class="btn btn-sm btn-{{($complaint->seen==0)?'warning':'success'}}" id="updateBtn" {{($complaint->seen==1)?'disabled=""':''}} onclick="updateComplaiant('{{$complaint->id}}')"><i class="far fa-eye"></i>@if ($complaint->seen==0)Check @else
                                    Checked
                                @endif</button>
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
