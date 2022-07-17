@extends('layouts.app')

@section('title')
    Milestones
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}

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
            <li class="breadcrumb-item active">Add My  Mentoring Topics </li>
          </ol>
        </div> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content" >
  <!-- general form elements -->



            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Task</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user.task_update',$id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Milestone">Name</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('note')) {{ 'is-invalid' }} @endif"
                                        id="note" value="{{$note->text}}" name="text" placeholder="Name" required>

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
                                        id="due_date" value="{{$note->due_date}}" name="due_date" placeholder="Milestone Due Date" required>

                                    @if ($errors->has('due_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('due_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <input type="hidden" name="milestone_id" value="{{$note->milestone_id}}"/>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">

                </div>

                <!-- /.card -->
            </div>

@endsection

@push('scripts')
    <script>

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
