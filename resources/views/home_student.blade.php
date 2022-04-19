@extends('layouts.app')

@section('title')
    Dashboard | YOU2MENTOR
@endsection



@section('content')

    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard </li>
              </ol>
            </div>
          </div>
        </div>
      </section> --}}

      {{-- <!-- Main content -->
      <section class="content"> --}}

         <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div style="font-size:15px; text-align:center;" class="alert alert-warning">
              Thanks for signing up. We will be launching officially soon and will notify you once we are live. In the meantime our pilot is running, so update your profile, explore and check out the RSS feed curated for your development.
              <br/>
              We would love to hear feedback on how we can improve your experience, <a href="https://you2mentor.com/contact/" target="_blank">so drop us a note through here</a>
              <br/>
              <span style="color:black; font-size:larger;">
                You can follow us on &nbsp;&nbsp;<a href="https://www.linkedin.com/company/you2mentor/" target="_blank"><i class="bi bi-linkedin"></i></a> &nbsp;&nbsp; <a href="https://www.twitter.com/You2Mentor" target="_blank" ><i class="bi bi-twitter"></i></a> &nbsp;&nbsp; <a href="https://www.instagram.com/You2Mentor/" target="_blank"><i class="bi bi-instagram"></i></a>
              </span>
            </div>
          </div>
          <div class="col-sm-6">
            <h1 class="m-0">My Dashboard</h1>
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Dashboard</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
             <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{Auth()->user()->streaming_count}}</h3>

                <p>Available Streams</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatbox"></i>
              </div>
              <a href="{{ route('student.payment_history') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
           <div class="small-box bg-light">
             <div class="inner">
               <h3>{{$convo_count}}</h3>

               <p>Conversations</p>
             </div>
             <div class="icon">
               <i class="ion ion-chatbubbles"></i>
             </div>
             <a href="{{route('student.conversation_list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3>{{$teachers_count}}</h3>

                <p>Mentors</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="{{route('student.tutors')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3>{{$subject_count}}</h3>

                <p>Mentoring Topics/Professions</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-book"></i>
              </div>
              <a href="{{route('student.tutors')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">

              <div class="inner">
              <p style="margin-bottom: 3px;">Milestones</p>
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$completed_milestones_count}}</h5>
                      <p style="color:green; font-size: 14px;">Completed</p>
                      <!-- <span class="description-text">Completed</span> -->
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$inprogress_milestones_count}}</h5>
                      <p style="color:rgb(255, 153, 0); font-size: 14px;">In Progress</p>
                      <!-- <span class="description-text">In Progress</span> -->
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">{{$overdue_milestones_count}}</h5>
                      <p style="color:red; font-size: 14px;">Overdue</p>
                      <!-- <span class="description-text">Overdue</span> -->
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
              </div>

            <!-- <div class="row">
            <div class="small-box bg-light">
              <div class="inner">
                <h3>{{$my_milestones_count}}</h3>

                <p>Completed</p>
              </div>
          </div>
          <div class="small-box bg-light">
              <div class="inner">
                <h3>{{$my_milestones_count}}</h3>

                <p>In Progess</p>
              </div>
          </div>
          <div class="small-box bg-light">
              <div class="inner">
                <h3>{{$my_milestones_count}}</h3>

                <p>Overdue</p>
              </div>
          </div>
          </div> -->
              <!-- <div class="icon">
                <i class="fas fa-flag"></i>
              </div> -->
              <a href="{{route('user.milestone')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

              <!-- Default box -->
      {{-- <div class="card">
        <div class="card-header">
          <h3 class="card-title">Current Premium Details</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Completed Streams</span>
                      <span class="info-box-number text-center text-muted mb-0">5</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Available Streams</span>
                      <span class="info-box-number text-center text-muted mb-0">{{Auth()->user()->streaming_count}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Available Amount</span>
                      <span class="info-box-number text-center text-muted mb-0">${{Auth()->user()->streaming_count}}</span>
                     </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Recent Purchases</h4>
                  @foreach ($user_orders as $user_order)
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../public/theme/admin/dist/img/package_icon.jpg" alt="package">
                        <span class="username">
                          <a href="#">Package: {{$user_order->payment_package->name}}</a>
                        </span>
                        <span class="description">Purchased at: {{date('d-m-Y | H:i', strtotime($user_order->created_at))}}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Unlimited Chat. {{$user_order->payment_package->streaming_count}} Streamings. Connect with good mentors
                        <ul>
                            <li>Unlimited Chat</li>
                            <li>{{$user_order->payment_package->streaming_count}} Video Streams</li>
                            <li>Connect with good mentors</li>
                            <li>Only ${{$user_order->amount}}</li>
                        </ul>
                      </p>

                    </div>
                  @endforeach


                  <div class="post">
                        <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../public/theme/admin/dist/img/package_icon.jpg" alt="package">
                                <span class="username">
                                    <a href="#">Red Package</a>
                                </span>
                                <span class="description">Purchased at - 7:45 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Unlimited Chat. 5 Streamings. Connect with good mentors
                                </p>

                                <p>
                                <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                </p>
                      </div>

                      <div class="post clearfix">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../public/theme/admin/dist/img/package_icon.jpg" alt="package">
                          <span class="username">
                            <a href="#">Indigo Package</a>
                          </span>
                          <span class="description">Purchased at - 7:45 PM today</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            Unlimited Chat. 10 Streamings. Connect with good mentors
                        </p>

                      </div>

                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore.
                      </p>
                      <p>
                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                      </p>
                    </div>

                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                        <span class="description">Shared publicly - 5 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore.
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v1</a>
                      </p>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas fa-paint-brush"></i> YOU2MENTOR</h3>
              <p class="text-muted">Here you can see your premium facilities, Your recently purchased packages and available streaming count and everything.</p>
              <br>
              <div class="text-muted">
                <p class="text-sm">Payment Method
                  <b class="d-block">Paypal</b>
                </p>
                <p class="text-sm">Project Leader
                  <b class="d-block">Tony Chicken</b>
                </p>
              </div>

              <h5 class="mt-5 text-muted">Project files</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                </li>
              </ul>
              <div class="text-center mt-5 mb-3">
                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div> --}}
      <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
