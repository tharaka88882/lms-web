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
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col">
                </div>
                <div class="col">
                  <a href="{{ url()->previous() }}" type="button" class="btn btn-warning pull-right">
                    <i class="fa fa-arrow-left"></i> Go Back
                  </a>
                </div>
            </div>
        </div>
        <!-- general form elements -->
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Goal Details</h3>

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
                                    <h5 class="description-header">Name of Goal</h5>
                                    <span class="description-text">{{ $milestone->note }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Due By</h5>
                                    <span class="description-text">{{ $milestone->due_date }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header">Status</h5>
                                    @if ($milestone->status == 1)
                                        <span style="color: green;" class="description-text">Completed</span>
                                    @elseif ($milestone->status == 2)
                                        <span style="color: rgb(255, 187, 0);" class="description-text">In Progress</span>
                                    @elseif ($milestone->status == 3)
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
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modal-md">Add Task</button>
                                            {{-- <button type="button" class="btn btn-danger">Delete</button> --}}
                                        </div>
                                    </td>
                                </tr>
                                <!-- /.success -->
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-11">
                                <div class="card-body p-2 table-responsive">
                                    <table class="table table-md">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Tasks to achieve goal</th>
                                                <th>Due by</th>
                                                <th style="width: 150px">Status</th>
                                                <th style="width: 125px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($milestone->notes as $note)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $note->text }}</td>
                                                    <td>
                                                        {{ $note->due_date }}
                                                    </td>
                                                    <td>

                                                        <select onchange="update_note('{{ $note->id }}')"
                                                            id="status-{{ $note->id }}" class="form-control" style="width: auto !important;">

                                                            <option {{ $note->status == 2 ? 'selected="true"' : '' }} value="2">In
                                                                progress</option>
                                                            <option {{ $note->status == 1 ? 'selected="true"' : '' }} value="1">
                                                                Completed</option>

                                                            {{-- <option disabled="" value="3">Overdue</option> --}}
                                                            <option {{ $note->status == 0 ? 'selected="true"' : '' }} value="0">
                                                                Cancelled</option>
                                                        </select>
                                                    </td>
                                                    <td style="width: 190px;">
                                                        <div class="button-group">

                                                              <a href="{{ route('user.edit_task', $note->id) }}" type="button"
                                                                  class="btn btn-warning">Edit</a>


                                                                <button onclick="delete_note('{{ $note->id }}');" type="button"
                                                                    class="btn btn-danger">Delete</button>

                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
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
                            {{-- <dt>Notes</dt> --}}
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-md1">Add
                                Note</button>
                            {{-- <dd>A description list is perfect for defining terms.</dd> --}}
                        </dl>
                        <!-- /.card-body -->

                        <div class="container col-md-10">
                            {{-- <h2>Stacked Progress Bars</h2>
                    <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> --}}
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar"
                                    style="width:{{ $completed }}%">
                                    Completed
                                </div>
                                <div class="progress-bar progress-bar-warning" role="progressbar"
                                    style="width:{{ $in_progress }}%">
                                    In Progress
                                </div>
                                <div class="progress-bar progress-bar-danger" role="progressbar"
                                    style="width:{{ $Cancelled }}%">
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
                    <h4 class="modal-title">Add new Task</h4>
                    <button onclick="location.reload();" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store_notes') }}" method="POST">
                    @csrf
                    <input type="hidden" name="milestone_id" value="{{ $milestone->id }}" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Action Plan to achive the Milestone</label>
                            <input type="text" name="text" class="form-control" placeholder="Enter ...">
                        </div>
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control" placeholder="Enter ...">
                    </div>
                    <div class="modal-footer justify-content-between btn-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button onclick="location.reload();" type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- /.modal -->
    <div class="modal fade" id="modal-md1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="text-transform: capitalize">Notes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-9">
                            {{-- <label>Any Comments</label> --}}
                            <input id="stikey_" name="question3" class="form-control" required />

                        </div>
                        <div class="form-group col-sm-3">
                            {{-- <label>Any Comments</label> --}}
                            <button onclick="saveSNote('{{ $milestone->id }}');" class="btn btn-success">Save</button>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Note</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($milestone->m_stikey as $m_stikey)
                                  @if ($m_stikey->user_id == Auth()->user()->id)
                                  <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $m_stikey->s_note }}</td>
                                    <td>{{ date('Y/m/d | H:i', strtotime($m_stikey->updated_at)) }}</td>
                                    <td>
                                        {{-- <a href="" class="btn btn-sm btn-warning" id="goal">Update</a> --}}
                                        <button type="button" onclick="del_stikey('{{ $m_stikey->id }}');"
                                            class="btn btn-sm btn-danger" id="del_">Delete</button>
                                    </td>
                                </tr>
                                  @endif
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="modal-footer justify-content-between btn-group">
                                            <button  type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script>
        $(document).on('click', '[id^=deleteBtn-]', function() {
            var num = this.id.split('-')[1];
            if (confirm("Are you sure?") == true) {
                $('#deleteform-' + num).submit();
            }
        });


        function update_note(id) {

            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.update_notes') }}", {
                        id: id,
                        status: $('#status-' + id + ' option:selected').val(),
                        _method: "put",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            window.location = "{{ route('user.notes', $milestone->id) }}";
                        }
                    });

            }
        }

        function saveSNote(id) {

            //if (confirm("Are you sure?") == true) {
            if($('#stikey_').val() != ""){
                $.post("{{ route('user.add_s_note') }}", {
                    id: id,
                    s_note: $('#stikey_').val(),
                    _method: "put",
                    _token: "{{ csrf_token() }}"
                },
                function(data, status) {
                    if (data.success == true) {
                        console.log('success');
                        window.location = "{{ route('user.notes', $milestone->id) }}";
                    }
                });
            }else{
                alert("Note can't be null !");
            }

        }

        function del_stikey(id) {

            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.distory_s_note') }}", {
                        id: id,
                        _method: "delete",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            console.log('success');
                            window.location = "{{ route('user.notes', $milestone->id) }}";
                        }
                    });
            }

        }
        //}
        function delete_note(id) {

            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.destroy_notes') }}", {
                        id: id,
                        _method: "delete",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            window.location = "{{ route('user.notes', $milestone->id) }}";
                        }
                    });

            }
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
