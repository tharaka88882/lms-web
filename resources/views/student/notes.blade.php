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
                <h3 class="card-title">Milestone Details</h3>

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
                      <span class="description-text">{{$milestone->note}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Due By</h5>
                      <span class="description-text">{{$milestone->due_date}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <div class="description-block">
                      <h5 class="description-header">Status</h5>
                    @if ($milestone->status==1)
                    <span style="color: green;" class="description-text">Completed</span>
                      @elseif ($milestone->status==2)
                      <span style="color: yellow;" class="description-text">In Progress</span>
                      @elseif ($milestone->status==3)
                      <span style="color: red;" class="description-text">Overdue</span>
                      @else
                      <span class="description-text">Cancelled</span>
                      @endif
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
</div>
            <table class="table table-bordered">
                  <tbody>
                  <!-- success -->
                  <tr>
                    <td>
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-md">Add Note</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                      </div>
                    </td>
                  </tr>
                  <!-- /.success -->
                </tbody>
            </table>
<div class="row">
              <div class="col-md-11">
              <div class="card-body p-2">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Action plans to achieve Milestone</th>
                      <th>Due by</th>
                      <th style="width: 150px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($milestone->notes as $note)
                    <tr>
                        <td>{{$note->id}}</td>
                        <td>{{$note->text}}</td>
                        <td>
                            {{$note->due_date}}
                        </td>
                        <td>
                            <select onchange="update_note('{{$note->id}}')" id="status-{{$note->id}}" class="form-control">
                                <option {{$note->status==2?'selected="true"':''}} value="2">In progress</option>
                                <option {{$note->status==1?'selected="true"':''}}  value="1">Completed</option>

                                   {{-- <option disabled="" value="3">Overdue</option> --}}
                                <option {{$note->status==0?'selected="true"':''}} value="0">Cancelled</option>
                          </select>
                        </td>
                      </tr>
                    @endforeach
                    {{-- <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                      24-03-2022
                      </td>
                      <td>
                      <select id="status-1" class="form-control">
                                 <option value="1">Completed</option>
                                 <option selected="&quot;true&quot;" value="2">In progress</option>
                                 <option disabled="" value="3">Overdue</option>
                                 <option value="0">Cancelled</option>
                        </select>
                      </td>
                    </tr> --}}
                    {{-- <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                      26-03-2022
                      </td>
                      <td>
                      <select id="status-1" class="form-control">
                                 <option value="1">Completed</option>
                                 <option selected="&quot;true&quot;" value="2">In progress</option>
                                 <option disabled="" value="3">Overdue</option>
                                 <option value="0">Cancelled</option>
                        </select>
                      </td>
                    </tr> --}}
                  </tbody>
                </table>
              </div>
</div>
</div>
              <dl>
                  <dt>Notes</dt>
                  <dd>A description list is perfect for defining terms.</dd>
                </dl>
              <!-- /.card-body -->

                <div class="container col-md-10">
                    {{-- <h2>Stacked Progress Bars</h2>
                    <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> --}}
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" style="width:{{$completed}}%">
                        Completed
                      </div>
                      <div class="progress-bar progress-bar-warning" role="progressbar" style="width:{{$in_progress}}%">
                        In Progress
                      </div>
                      <div class="progress-bar progress-bar-danger" role="progressbar" style="width:{{$Cancelled}}%">
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
                    </section>

 <!-- /.modal -->
  <div class="modal fade" id="modal-md">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add new note</h4>
          <button onclick="location.reload();" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('user.store_notes')}}" method="POST">
            @csrf
            <input type="hidden" name="milestone_id" value="{{$milestone->id}}"/>
        <div class="modal-body">
        <div class="form-group">
                        <label>Action Plan to achive the Milestone</label>
                        <input type="text" name="text" class="form-control" placeholder="Enter ...">
                      </div>
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control" placeholder="Enter ...">
                      </div>
        <div class="modal-footer justify-content-between">
          <button onclick="location.reload();" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
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

function update_note(id){

if (confirm("Are you sure?") == true) {
    $.post("{{route('user.update_notes')}}",
    {
        id: id,
        status: $('#status-'+id+' option:selected').val(),
        _method: "put",
        _token: "{{ csrf_token() }}"
    },
    function(data, status){
        if(data.success==true){
            window.location="{{route('user.notes',$milestone->id)}}";
        }
    });
}
}
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
