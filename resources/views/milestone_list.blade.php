@extends('layouts.app')

@section('title')
    Milestones
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style>
        /* Timeline */
        .timeline,
        .timeline-horizontal {
            list-style: none;
            padding: 20px;
            position: relative;
        }

        .timeline:before {
            top: 40px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 3px;
            background-color: #eeeeee;
            left: 50%;
            margin-left: -1.5px;
        }

        .timeline .timeline-item {
            margin-bottom: 20px;
            position: relative;
        }

        .timeline .timeline-item:before,
        .timeline .timeline-item:after {
            content: "";
            display: table;
        }

        .timeline .timeline-item:after {
            clear: both;
        }

        .timeline .timeline-item .timeline-badge {
            color: #fff;
            width: 54px;
            height: 54px;
            line-height: 52px;
            font-size: 22px;
            text-align: center;
            position: absolute;
            top: 18px;
            left: 50%;
            margin-left: -25px;
            background-color: #333;
            border: 3px solid #ffffff;
            z-index: 100;
            border-top-right-radius: 50%;
            border-top-left-radius: 50%;
            border-bottom-right-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .timeline .timeline-item .timeline-badge i,
        .timeline .timeline-item .timeline-badge .fa,
        .timeline .timeline-item .timeline-badge .glyphicon {
            top: 2px;
            left: 0px;
        }

        .timeline .timeline-item .timeline-badge.primary {
            background-color: #1f9eba;
        }

        .timeline .timeline-item .timeline-badge.info {
            background-color: #5bc0de;
        }

        .timeline .timeline-item .timeline-badge.success {
            background-color: #59ba1f;
        }

        .timeline .timeline-item .timeline-badge.warning {
            background-color: #d1bd10;
        }

        .timeline .timeline-item .timeline-badge.danger {
            background-color: #ba1f1f;
        }

        .timeline .timeline-item .timeline-panel {
            position: relative;
            width: 46%;
            float: left;
            right: 16px;
            border: 1px solid #777;
            background: #ffffff;
            border-radius: 2px;
            padding: 20px;
            -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        }

        .timeline .timeline-item .timeline-panel:before {
            position: absolute;
            top: 26px;
            right: -16px;
            display: inline-block;
            border-top: 16px solid transparent;
            border-left: 16px solid #777;
            border-right: 0 solid #777;
            border-bottom: 16px solid transparent;
            content: " ";
        }

        .timeline .timeline-item .timeline-panel .timeline-title {
            margin-top: 0;
            color: inherit;
        }

        .timeline .timeline-item .timeline-panel .timeline-body>p,
        .timeline .timeline-item .timeline-panel .timeline-body>ul {
            margin-bottom: 0;
        }

        .timeline .timeline-item .timeline-panel .timeline-body>p+p {
            margin-top: 5px;
        }

        .timeline .timeline-item:last-child:nth-child(even) {
            float: right;
        }

        .timeline .timeline-item:nth-child(even) .timeline-panel {
            float: right;
            left: 16px;
        }

        .timeline .timeline-item:nth-child(even) .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
        }

        .timeline-horizontal {
            list-style: none;
            position: relative;
            /* padding: 20px 0px 20px 0px; */
            display: inline-block;
        }

        .timeline-horizontal:before {
            height: 3px;
            top: auto;
            bottom: 26px;
            left: 56px;
            right: 0;
            width: 100%;
            margin-bottom: 20px;
        }

        .timeline-horizontal .timeline-item {
            display: table-cell;
            height: 230px;
            width: 20%;
            min-width: 320px;
            float: none !important;
            padding-left: 0px;
            padding-right: 20px;
            margin: 0 auto;
            vertical-align: bottom;
        }

        .timeline-horizontal .timeline-item .timeline-panel {
            top: auto;
            bottom: 90px;
            display: inline-block;
            float: none !important;
            left: 0 !important;
            right: 0 !important;
            width: 100%;
            margin-bottom: 20px;
        }

        .timeline-horizontal .timeline-item .timeline-panel:before {
            top: auto;
            bottom: -16px;
            left: 28px !important;
            right: auto;
            border-right: 16px solid transparent !important;
            border-top: 16px solid #777 !important;
            border-bottom: 0 solid #777 !important;
            border-left: 16px solid transparent !important;
        }

        .timeline-horizontal .timeline-item:before,
        .timeline-horizontal .timeline-item:after {
            display: none;
        }

        .timeline-horizontal .timeline-item .timeline-badge {
            top: auto;
            bottom: 0px;
            left: 43px;
        }
    </style>
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{-- <div class="container"> --}}

            {{-- <section class="content-header"> --}}
            <div class="row" style="margin-top: 10px; !important">
                <div class="col-md-12">
                    <!-- small box -->
                    <div class="small-box bg-light">
                        <div class="inner">
                            <center>
                                <p style="margin-bottom: 3px; font-size: 24px;">My Development</p>
                            </center>
                            <div class="row">
                                <div class="col-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $completed_milestones_count }}</h5>
                                        <p style="color:green; font-size: 16px;">Completed</p>
                                        <!-- <span class="description-text">Completed</span> -->
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $inprogress_milestones_count }}</h5>
                                        <p style="color:rgb(255, 153, 0); font-size: 16px;">In Progress</p>
                                        <!-- <span class="description-text">In Progress</span> -->
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $overdue_milestones_count }}</h5>
                                        <p style="color:red; font-size: 16px;">Overdue</p>
                                        <!-- <span class="description-text">Overdue</span> -->
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        {{-- <a href="{{route('user.milestone')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="callout callout-warning">
                        <p>Development goals appear on your profile, however actions within goals are private.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header" style="border-bottom: 0px;margin: 0px; !important">
                        @php
                            $flag = false;
                        @endphp
                        @foreach ($milestones as $milestone)
                            @php
                                $date_facturation = \Carbon\Carbon::parse($milestone->due_date);
                            @endphp
                            @if ($milestone->status != 0)
                                @php
                                    $flag = true;
                                @endphp
                            @endif
                        @endforeach
                        @if ($flag)
                            <h3>Timeline</h3>
                        @endif
                    </div>
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" style="margin-bottom: 0px; !important">
                            @foreach ($milestones as $milestone)
                                @php
                                    $date_facturation = \Carbon\Carbon::parse($milestone->due_date);
                                @endphp
                                @if ($milestone->status != 0)
                                    <li class="timeline-item">
                                        <div
                                            class="timeline-badge  @if ($milestone->status == 1) success
                    @elseif ($milestone->status == 2)
                    warning
                    @else
                    danger @endif">
                                            <i
                                                class="glyphicon @if ($milestone->status == 1) glyphicon-check
                    @elseif ($milestone->status == 2)
                    glyphicon-edit
                    @else
                    glyphicon-share @endif"></i>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h5 class="timeline-title" style="margin-bottom: 0px; !important">
                                                    <strong>{{ $milestone->note }}</strong>
                                                </h5>
                                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>
                                                        Due Date: {{ $milestone->due_date }}</small></p>
                                            </div>
                                            <div class="timeline-body">
                                                {{-- <p>Mussum ipsum cacilds, vidis litro abertis. Consetis faiz elementum girarzis, nisi eros gostis.</p> --}}
                                                <h6 class="text-center"><strong>Number of Tasks : <span
                                                            class="badge bg-gray">{{ count(json_decode($milestone->notes, true)) }}</span></strong>
                                                </h6>
                                                <a type="button" href="{{ route('user.notes', $milestone->id) }}"
                                                    class="btn btn-block btn-info btn-xs">See More <i
                                                        class='fa fa-angle-double-right'></i></a>
                                                {{-- <ul>
                            <a href="{{route('user.notes',$milestone->id)}}">See More</a> --}}
                                                {{-- <li>Task 1</li>
                            <li>Task 2</li>
                            <li>Task 3</li>
                            <li>Task 4</li> --}}
                                                {{-- </ul> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach

                            {{-- <li class="timeline-item">
                    <div class="timeline-badge info"><i class="glyphicon glyphicon-check"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title">Mussum ipsum cacilds 3</h4>
                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
                        </div>
                        <div class="timeline-body">
                            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipisci. Mé faiz elementum girarzis, nisi eros gostis.</p>
                        </div>
                    </div>
                </li> --}}

                        </ul>
                    </div>
                </div>
            </div>
            {{-- </div> --}}



            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Goals</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user.milestone_create') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Milestone">Name</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('note')) {{ 'is-invalid' }} @endif"
                                        id="note" name="note" placeholder="Name">

                                    @if ($errors->has('note'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('note') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="Milestone">Due Date</label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('due_date')) {{ 'is-invalid' }} @endif"
                                        id="due_date" name="due_date" placeholder="Milestone Due Date">

                                    @if ($errors->has('due_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('due_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">

                </div>

                <!-- /.card -->
            </div>
            {{-- </section> --}}

            <!-- Main content -->
            {{-- <section class="content"> --}}
            <div class="row">
                <!-- Default box -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Goals</h3>
                        </div>
                        <div class="card-body">
                            <div class="container col-md-12">
                                {{-- <h2>Stacked Progress Bars</h2>
                <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> --}}
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success"  role="progressbar"
                                        style="width:{{ $completed }}%">
                                        Completed
                                    </div>
                                    <div class="progress-bar progress-bar-warning" role="progressbar"
                                        style="width:{{ $in_progress }}%">
                                        In Progress
                                    </div>
                                    <div class="progress-bar progress-bar-danger" role="progressbar"
                                        style="width:{{ $overdue }}%">
                                        Overdue
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px;">#</th>
                                            <th>Goals</th>
                                            <th>Created On</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th style="width: 190px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($milestones as $milestone)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $milestone->note }}</td>
                                                <td>{{ \Carbon\Carbon::parse($milestone->created_at)->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    @php
                                                    ($date_facturation = \Carbon\Carbon::parse($milestone->due_date))
                                                    @endphp
                                                    @if ($date_facturation->isPast())
                                                        @if ($milestone->status == 1)
                                                        <span class="badge" style="background-color: green; color: white;">
                                                        @else
                                                            <span class="badge" style="background-color: red; color: white;">
                                                        @endif
                                                        @else
                                                            @if ($milestone->status == 1)
                                                                <span class="badge"
                                                                    style="background-color: green; color: white;">
                                                                @else
                                                                    <span class="badge"
                                                                        style="background-color: rgb(255, 153, 0); color: white;">
                                                            @endif
                                                    @endif
                                                    {{ \Carbon\Carbon::parse($milestone->due_date)->format('d-m-Y') }}</span>

                                                </td>
                                                <td>
                                                    <select onchange="update_milestone('{{ $milestone->id }}')"
                                                        id='status-{{ $milestone->id }}' class="form-control">
                                                        <option {{ $milestone->status == 1 ? 'selected="true"' : '' }}
                                                            value="1">
                                                            Completed</option>
                                                        <option {{ $milestone->status == 2 ? 'selected="true"' : '' }}
                                                            value="2">
                                                            In progress</option>
                                                        <option disabled=""
                                                            {{ $milestone->status == 3 ? 'selected="true"' : '' }}
                                                            value="3">
                                                            Overdue</option>
                                                        <option {{ $milestone->status == 0 ? 'selected="true"' : '' }}
                                                            value="0">
                                                            Cancelled</option>
                                                    </select>
                                                </td>
                                                <td style="width: 190px">
                                                    <div class="button-group">
                                                        <div class="col-xm-12 col-md-4 p-1">
                                                            <a href="{{ route('user.edit_milestone', $milestone->id) }}"
                                                                class="btn btn-sm btn-warning"
                                                                id="goal">Edit</a>
                                                        </div>

                                                        <div class="col-xm-12 col-md-4 p-1">
                                                            <a href="{{ route('user.notes', $milestone->id) }}"
                                                                class="btn btn-sm btn-success"
                                                                id="goal">Tasks</a>
                                                        </div>
                                                        <div class="col-xm-12 col-md-4 p-1">
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                id="deleteBtn-{{ $milestone->id }}">Delete</button>
                                                            <form
                                                                action="{{ route('user.milestone_delete', $milestone->id) }}"
                                                                id="deleteform-{{ $milestone->id }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </div>

                                                    </div>
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
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            {{-- </section> --}}
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '[id^=deleteBtn-]', function() {
            var num = this.id.split('-')[1];
            if (confirm("Are you sure?") == true) {
                $('#deleteform-' + num).submit();
            }
        });


        function update_milestone(id) {

            if (confirm("Are you sure?") == true) {
                $.post("{{ route('user.update_milestone') }}", {
                        id: id,
                        status: $('#status-' + id + ' option:selected').val(),
                        _method: "put",
                        _token: "{{ csrf_token() }}"
                    },
                    function(data, status) {
                        if (data.success == true) {
                            window.location = "{{ route('user.milestone') }}";
                        }
                    });
            }
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
