@extends('layouts.app')

@section('title')
    Milestones
@endsection

@push('styles')
    {{-- <style>h1 {background-color: red !important}</style> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


    <style>
        #process {
  margin-bottom: 40px;
  overflow-x: hidden;
}

#process .section-heading {
  margin-bottom: 40px;
}

.steps-pane img {
  height: 100px;
  margin-top: 18px;
  -ms-transform: skewX(-15deg);
  /* IE 9 */
  -webkit-transform: skewX(-15deg);
  /* Safari */
  -o-transform: skewX(-15deg);
  /* Standard syntax */
  -moz-transform: skewX(-15deg);
}

.pane-warp {
  height: 140px;
  width: 25px;
  margin-left: 20%;
  margin-top: 20px;
  -ms-transform: skewX(15deg);
  /* IE 9 */
  -webkit-transform: skewX(15deg);
  /* Safari */
  -o-transform: skewX(15deg);
  /* Standard syntax */
  -moz-transform: skewX(15deg);
}

.steps-pane {
  height: 140px;
  width: 140px;
  margin-left: 30px;
  box-shadow: 7px 0px 5px #bcbcbc;
}

.inverted-pane-warp {
  height: 140px;
  width: 25px;
  margin-left: 20%;
  -ms-transform: skewX(-15deg);
  /* IE 9 */
  -webkit-transform: skewX(-15deg);
  /* Safari */
  -o-transform: skewX(-15deg);
  /* Standard syntax */
  -moz-transform: skewX(-15deg);
}

.inverted-steps-pane {
  height: 140px;
  width: 140px;
  background: #bcbcbc;
  margin-left: 30px;
  box-shadow: 7px 0px 5px #bcbcbc;
}

.inverted-steps-pane p {
  -ms-transform: skewX(15deg);
  /* IE 9 */
  -webkit-transform: skewX(15deg);
  /* Safari */
  -o-transform: skewX(15deg);
  /* Standard syntax */
  -moz-transform: skewX(15deg);
  padding: 20px 10px 10px 10px;
}

@media(min-width: 900px) {
  .steps-timeline {
    border-top: 5px double #fc6429;
    padding-top: 20px;
    margin-top: 40px;
    margin-left: 3%;
    margin-right: 3%;
  }
  .steps-one,
  .steps-two,
  .steps-three,
  .steps-four,
  .steps-five {
    float: left;
    width: 20%;
    margin-top: -105px;
  }
  .step-wrap {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    background: transparent;
    margin-left: 39%;
    border: 2px solid #fc6429;
  }
  .verticle-line {
    position: absolute;
    height: 57px;
    width: 5px;
    margin-left: 10px;
    marker-top: 10px;
  }
  .steps-stops {
    height: 25px;
    width: 25px;
    margin: 11px 10.1px;
    border-radius: 50%;
    background: #fc6429;
  }
  .end-circle {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    position: absolute;
    margin-top: 19px;
    margin-left: -10px;
  }
  .inverted-end-circle {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    position: absolute;
    margin-top: 19px;
    margin-left: 18.1%;
  }
}

@media(max-width: 899px) {
  #process .container-fluid {
    width: 50%;
  }
  .steps-timeline {
    border-left: 5px double #fc6429;
    margin-left: 35px;
  }
  .steps-one,
  .steps-two,
  .steps-three,
  .steps-four,
  .steps-five {
    margin-left: -25px;
  }
  .step-wrap,
  .steps-stops {
    float: left;
  }
  .steps-timeline {
    border-left: 2px solid $brand-primary;
    margin-left: 30px;
  }
  .pane-warp {
    margin-left: 30%;
  }
  .inverted-pane-warp {
    margin-left: 30%;
  }
  .verticle-line {
    position: absolute;
    width: 125px;
    height: 5px;
    margin-left: 5px;
    margin-top: 10px;
  }
  .steps-stops {
    height: 25px;
    width: 25px;
    margin: 11px 10px;
    border-radius: 50%;
    background: #fc6429;
  }
  .step-wrap {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    background: transparent;
    margin-top: 125px;
    margin-left: -2px;
    border: 2px solid #fc6429;
  }
  .end-circle {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    position: absolute;
    margin-top: -45px;
    margin-left: 15px;
  }
  .inverted-end-circle {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    position: absolute;
    margin-top: 280px;
    margin-left: 15px;
  }
}

@media (max-width: 600px) {
  #process .container-fluid {
    width: 90%;
  }
}

@media (max-width: 400px) {
  .verticle-line {
    width: 105px;
  }
}

.back-orange {
  background: #fc6429;
}

.back-blue {
  background: rgb(59, 37, 132);
}
    </style>
@endpush

@section('content')


<section id="process">
    <div class="row">
      <div class="section-heading">
        <h2 class="text-center orange">Responsive Horizontal Timeline</h2>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="steps-timeline text-center">
          <div class="steps-one">
            <h3>Step 1</h3>
            <div class="end-circle back-orange"></div>
            <div class="step-wrap">
              <div class="steps-stops">
                <div class="verticle-line back-orange"></div>
              </div>
            </div>
            <div class="pane-warp back-blue">
              <div class="steps-pane">
                <img src="https://imgur.com/5U7IJvy.png">
              </div>
            </div>
            <div class="inverted-pane-warp back-blue">
              <div class="inverted-steps-pane">
                <p>Please fill your respective details in the attached TAX sheet whose salary mandat</p>
              </div>
            </div>
          </div>

          <div class="steps-two">
            <h3>Step 2</h3>
            <div class="step-wrap">
              <div class="steps-stops">
                <div class="verticle-line back-orange"></div>
              </div>
            </div>
            <div class="pane-warp back-orange">
              <div class="steps-pane">
                <img src="https://imgur.com/ACjjJNm.png">
              </div>
            </div>
            <div class="inverted-pane-warp back-orange">
              <div class="inverted-steps-pane">
                <p>Please fill your respective details in the attached TAX sheet whose salary mandat</p>
              </div>
            </div>
          </div>

          <div class="steps-three">
            <h3>Step 3</h3>
            <div class="step-wrap">
              <div class="steps-stops">
                <div class="verticle-line back-orange"></div>
              </div>
            </div>
            <div class="pane-warp back-blue">
              <div class="steps-pane">
                <img class="third" src="https://imgur.com/5U7IJvy.png">
              </div>
            </div>
            <div class="inverted-pane-warp back-blue">
              <div class="inverted-steps-pane">
                <p>Please fill your respective details in the attached TAX sheet whose salary mandat</p>
              </div>
            </div>
          </div>

          <div class="steps-four">
            <h3>Step 4</h3>
            <div class="step-wrap">
              <div class="steps-stops">
                <div class="verticle-line back-orange"></div>
              </div>
            </div>
            <div class="pane-warp back-orange">
              <div class="steps-pane">
                <img src="https://imgur.com/ACjjJNm.png">
              </div>
            </div>
            <div class="inverted-pane-warp back-orange">
              <div class="inverted-steps-pane">
                <p>Please fill your respective details in the attached TAX sheet whose salary mandat</p>
              </div>
            </div>
          </div>

          <div class="steps-five">
            <h3>Step 5</h3>
            <div class="inverted-end-circle back-orange"></div>
            <div class="step-wrap">
              <div class="steps-stops">
                <div class="verticle-line back-orange"></div>
              </div>
            </div>
            <div class="pane-warp back-blue">
              <div class="steps-pane">
                <img src="https://imgur.com/5U7IJvy.png">
              </div>
            </div>
            <div class="inverted-pane-warp back-blue">
              <div class="inverted-steps-pane">
                <p>Please fill your respective details in the attached TAX sheet whose salary mandat</p>
              </div>
            </div>
          </div>

        </div>
        <!-- /.steps-timeline -->
      </div>
    </div>
  </section>

  <section class="content-header">




  <div class="row">
    <div class="col-md-6">
        <!-- small box -->
        <div class="small-box bg-light">
            <div class="inner">
            <p style="margin-bottom: 3px; font-size: 14px;">My Development</p>
              <div class="row">
                <div class="col-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$completed_milestones_count}}</h5>
                    <p style="color:green; font-size: 11px;">Completed</p>
                    <!-- <span class="description-text">Completed</span> -->
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$inprogress_milestones_count}}</h5>
                    <p style="color:rgb(255, 153, 0); font-size: 11px;">In Progress</p>
                    <!-- <span class="description-text">In Progress</span> -->
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <div class="description-block">
                    <h5 class="description-header">{{$overdue_milestones_count}}</h5>
                    <p style="color:red; font-size: 11px;">Overdue</p>
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
    <div class="col-md-6">
        <div class="callout callout-warning">
            <p>Please note development goals are appeared in your profile and, however actions within goals are private.</p>
          </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Add Milestone</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('user.milestone_create')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="Milestone">Milestone Note</label>
                        <input type="text" class="form-control @if($errors->has('note')) {{'is-invalid'}} @endif" id="note" name="note" placeholder="Milestone Note">

                        @if($errors->has('note'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('note') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="Milestone">Due Date</label>
                        <input type="date" class="form-control @if($errors->has('due_date')) {{'is-invalid'}} @endif" id="due_date" name="due_date" placeholder="Milestone Due Date">

                        @if($errors->has('due_date'))
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
  </div>
  </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
      <!-- Default box -->
      <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Milestone List</h3>
        </div>
        <div class="card-body">
            <div class="container col-md-12">
                {{-- <h2>Stacked Progress Bars</h2>
                <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> --}}
                <div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" style="width:{{$completed}}%">
                    Completed
                  </div>
                  <div class="progress-bar progress-bar-warning" role="progressbar" style="width:{{$in_progress}}%">
                    In Progress
                  </div>
                  <div class="progress-bar progress-bar-danger" role="progressbar" style="width:{{$overdue}}%">
                    Overdue
                  </div>
                </div>
              </div>

            <div class="table-responsive">
              <table class="table ">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Goals</th>
                          <th>Created On</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach($milestones as $milestone)
                      <tr>
                          <td>{{$i}}</td>
                          <td>{{$milestone->note}}</td>
                          <td>{{ \Carbon\Carbon::parse($milestone->created_at)->format('d-m-Y')}}</td>
                          <td>
                                @php
                                    ($date_facturation = \Carbon\Carbon::parse($milestone->due_date))
                                @endphp
                                @if ($date_facturation->isPast())
                                    <span class="badge" style="background-color: red;">
                                @else
                                    <span class="badge" style="background-color: green;">
                                @endif
                                {{ \Carbon\Carbon::parse($milestone->due_date)->format('d-m-Y')}}</span>

                          </td>
                          <td>
                             <select onchange="update_milestone('{{ $milestone->id}}')" id='status-{{ $milestone->id}}' class="form-control">
                                 <option {{$milestone->status==1?'selected="true"':''}}  value="1">Completed</option>
                                 <option {{$milestone->status==2?'selected="true"':''}} value="2">In progress</option>
                                 <option disabled="" {{$milestone->status==3?'selected="true"':''}} value="3">Overdue</option>
                                 <option {{$milestone->status==0?'selected="true"':''}} value="0">Cancelled</option>
                             </select>
                          </td>
                          <td style="float: left;">
                            <div class="col-xs-6 p-1">
                                <a href="{{route('user.notes',$milestone->id)}}" class="btn btn-sm btn-success float-right" id="goal">Tasks</a>
                            </div>
                            <div class="col-xs-6 p-1">
                                <button type="button" class="btn btn-sm btn-danger pull-left" id="deleteBtn-{{$milestone->id}}">Delete</button>
                                <form action="{{route('user.milestone_delete', $milestone->id)}}" id="deleteform-{{$milestone->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
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
      </section>
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
