@extends('layouts.app')

@section('title')
    Milestones
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@endpush

@section('content')

  <section class="content-header">
  <!-- general form elements -->
  <div class="col-md-12">
  <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Milestone Name</h3>

                <!-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div> -->
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Milestone Name</h5>
                      <span class="description-text">Test Milestone 1</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Due By</h5>
                      <span class="description-text">30-Mar-22</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <div class="description-block">
                      <h5 class="description-header">Status</h5>
                      <span class="description-text">In Progress</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
</div>
<div class="row">
</div>
            <table class="table table-bordered">
                  <tbody>
                  <!-- success -->
                  <tr>
                    <td>
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg">Add Note</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                      </div>
                    </td>
                  </tr>
                  <!-- /.success -->
                </tbody>
            </table>

              <div class="col-md-11">
              <div class="card-body p-2">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Action plans to achieve Milestone</th>
                      <th>Due by</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        22-03-2022
                      </td>
                      <td>
                        <select id="status-1" class="form-control">
                                 <option value="1">Completed</option>
                                 <option selected="&quot;true&quot;" value="2">In progress</option>
                                 <option disabled="" value="3">Overdue</option>
                                 <option value="0">Cancelled</option>
                             </select>
                            </td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                      24-03-2022
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                      26-03-2022
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              </div>

                </div>

                <div class="container col-md-10">
                    {{-- <h2>Stacked Progress Bars</h2>
                    <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> --}}
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" style="width:20%">
                        Completed
                      </div>
                      <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">
                        In Progress
                      </div>
                      <div class="progress-bar progress-bar-danger" role="progressbar" style="width:50%">
                        Cancelled
                      </div>
                    </div>
                  </div>
              </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


  </div>
  <!-- /.card -->

 <!-- /.modal -->
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Large Modal</h4>
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
  </div>
  <!-- /.modal -->

@endsection

@push('scripts')
  <script>
        $(document).on('click','[id^=deleteBtn-]', function() {
            var num = this.id.split('-')[1];
            if (confirm("Are you sure?") == true) {
                $('#deleteform-'+num).submit();
            }
        });


function update_milestone(id){

    if (confirm("Are you sure?") == true) {
        $.post("{{route('user.update_milestone')}}",
        {
            id: id,
            status: $('#status-'+id+' option:selected').val(),
            _method: "put",
            _token: "{{ csrf_token() }}"
        },
        function(data, status){
            if(data.success==true){
                window.location="{{route('user.milestone')}}";
            }
        });
}
}
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
