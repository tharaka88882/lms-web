@extends('layouts.app')

@section('title')
Mentoring Topics
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
                <li class="breadcrumb-item active">What I can Mentor</li>
              </ol>
            </div> --}}
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">What I can Mentor</h3>

            <div class="card-tools">
              <a href="{{ route('teacher.find_subject') }}" class="btn btn-block btn-success">Add New</a>

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
                            <th>#</th>
                            <th>Name</th>
                            {{-- <th>Status</th> --}}
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($subjects as $subject)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$subject->name}}</td>
                            {{-- <td><h5><span class="badge badge-secondary">{{$subject->status==('1')? 'Active':'Inactive'}}</span><h5></td> --}}
                            <td><button class="btn btn-sm btn-danger" id="deleteBtn" onclick="deleteSubject('{{$subject->id}}')"><i class="far fa-trash-alt"></i> Remove</button></td>
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
          {{-- <form action="{{route('teacher.remove_subject', $subject->id)}}" id="deleteform" method="POST">
            @csrf
            @method('delete')
        </form> --}}
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
            <button type="button" class="btn btn-success">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div> --}}
    <!-- /.modal -->
      <!-- /.content -->
@endsection

@push('scripts')
  <script>
      $('#deleteBtn').click(function(){
      });

      function deleteSubject(id){

        if (confirm("Are you sure?") == true) {
            $.post("{{route('teacher.remove_subject')}}",
            {
                id: id,
                _method: "delete",
                _token: "{{ csrf_token() }}"
            },
            function(data, status){
                if(data.success==true){
                    window.location="{{route('teacher.my_subject')}}";
                }
            });
        }
      }
  </script>
@endpush

