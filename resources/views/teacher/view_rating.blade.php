@extends('layouts.app')

@section('title')
My Ratings
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
                <li class="breadcrumb-item active">Add Subjects </li>
              </ol>
            </div> --}}
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="col-md-12">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">My Ratings</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
         <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3 style="color: green;">150</h3>

                <p>Overall Rating</p>
              </div>
              <!-- <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3 style="color: yellow;">53<sup style="font-size: 20px">%</sup></h3>

                <p>Relevance</p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3 style="color: red;">53<sup style="font-size: 20px">%</sup></h3>

                <p>Timely Responce</p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
        </div>

        <h4> Details and Feedbacks</h4>
        
                <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="row pull-right">
                    <div class="p-1">
                        <div class="form-group" id="currentModal">
                            <label>Search by Star Rating</label>
                              <select class="select2 form-control" data-placeholder="Any" style="width: 100%;" name="search_rating">
                                                    <option>Any</option>
                                                    <option>5</option>
                                                    <option>4</option>
                                                    <option>3</option>
                                                    <option>2</option>
                                                    <option>1</option>
                              </select>
                        </div>
                    </div>
                    <div class="p-1">
                        <button class="btn btn-success" style="margin-top: 31px;">Search</button>
                    </div>
            </div>
        </div>
                </div>
                <hr class="mt-0">

        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0" style="text-align: right;">
                  <b>Date: </b> 22-Feb-2022
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-10">
                      <!-- <h1 class="lead">How would you rate your overall experience with the mentor</h1> -->
                      <p class="text-muted text-md"> How would you rate your overall experience with the mentor: <b>4.5</b></p>
                      <p class="text-muted text-md"> Any Comments? <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad maxime tenetur illo</b></p>
                      <p class="text-muted text-md"> Question 3: <b>Yes</b></p>
                      <p class="text-muted text-md"> Question 4: <b>No</b></p>
                      <!-- <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                      </ul> -->
                    </div>
                    <!-- <div class="col-5 text-center">
                      <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div> -->
                  </div>
                </div>
                <!-- <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div> -->
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0" style="text-align: right;">
                  <b>Date: </b> 22-Feb-2022
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-10">
                    <p class="text-muted text-md"> How would you rate your overall experience with the mentor: <b>4.6</b></p>
                      <p class="text-muted text-md"> Any Comments? <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad maxime tenetur illo</b></p>
                      <p class="text-muted text-md"> Question 3: <b>No</b></p>
                      <p class="text-muted text-md"> Question 4: <b>Yes</b></p>
                    </div>
                    <!-- <div class="col-5 text-center">
                      <img src="../../dist/img/user2-160x160.jpg" alt="user-avatar" class="img-circle img-fluid">
                    </div> -->
                  </div>
                </div>
                <!-- <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div> -->
              </div>
            </div>
          </div>

            </div>
              </div>
              <!-- /.card-body -->
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