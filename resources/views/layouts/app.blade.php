<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('public/') }}/theme/admin/dist/img/logo/favi_logo.jpeg" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ url('public/') }}/theme/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ url('public/') }}/theme/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/summernote/summernote-bs4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome -->
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/plugins/fullcalendar/main.css">
    <!-- Theme style -->

    <!-- Toastr Style-->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/select2/dist/css/select2.min.css">

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


    @stack('styles')

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('public/') }}/theme/admin/dist/img/dashboard_logo.png"
                alt="YOU2MENTOR_Logo" height="240" width="240">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    {{-- <a href="{{route('student.payment_packages')}}" class="nav-link">Premium Packages</a> --}}
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                       <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                       <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> --}}



                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge" id="notification_icon_count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"><span id="notificaton_count">0</span>
                            Notifications</span>
                        <div class="dropdown-divider"></div>
                        <div id="notification_panel">

                        </div>
                        <a href="{{ route('user.notifications') }}" class="dropdown-item dropdown-footer">See All
                            Notifications</a>
                    </div>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    @if (Auth()->user() != null)
                        <a href="#" class="dropdown-toggle1" data-toggle="dropdown">
                            <div class="user-panel">
                                <img style="width: 25px; height: 25px; margin-top: 5px; vertical-align: top !important; margin-left: 15px;"
                                    onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                    @if (Auth()->user()->image != null) src="{{ url('public') }}/images/profile/{{ Auth()->user()->image }}" @else src="" @endif
                                    class="img-circle elevation-2" alt="User Image"
                                    title="@if (Auth()->user()->image != null) {{ url('public/') }}/images/profile/{{ Auth()->user()->image }} @endif">

                                <div class="info">
                                    <span style="text-transform: capitalize">{{ Auth()->user()->name }}</span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="">
                                    <ul style="list-style: none; padding-left: 0px">
                                        <li><a href="{{ route('user.profile') }}">Profile</a></li>
                                    </ul>
                                    <ul style="list-style: none; padding-left: 0px">
                                        <li><a href="#!" data-toggle="modal" data-target="#modal-md">Refer a Friend</a>
                                        </li>
                                    </ul>
                                    <ul style="list-style: none; padding-left: 0px">
                                        <li><a target="_blank" href="https://you2mentor.com/rss-2/">RSS Feed</a></li>
                                    </ul>
                                    <ul style="list-style: none; padding-left: 0px">
                                        <li><a target="_blank" href="https://you2mentor.com/contact">Help and
                                                Support</a></li>
                                    </ul>
                                    <ul style="list-style: none; padding-left: 0px">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf @method('post')
                                            <button class="btn btn-link btn-flat pt-0" style="padding-left: 0">Sign
                                                out</button>
                                        </form>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    @endif
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li> --}} {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        {{-- <aside class="main-sidebar sidebar-light-olive elevation-4" style="position: fixed; height: 100%;"> --}}
        <aside class="main-sidebar sidebar-light-blue elevation-4" style="position: fixed; height: 100%;">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">

                <img src="{{ url('public/') }}/theme/admin/dist/img/logo/you2logo.png" alt="AdminLTE Logo"
                    class="img-push elevation-1" style="margin-left: 75px; width: 100px; height: 100px;">
                {{-- <span class="brand-text font-weight-light">YOU2MENTOR</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="height: calc(85% - (3.5rem + 1px)); !important">
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group pt-3" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    @if (Auth()->user()->userable_type == 'App\Models\Student')
                        @include('partials.student_menu')
                    @endif
                    @if (Auth()->user()->userable_type == 'App\Models\Teacher')
                        @include('partials.teacher_menu')
                    @endif
                    @if (Auth()->user()->userable_type == 'App\Models\Admin')
                        @include('partials.admin_menu')
                    @endif
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2022 You2Mentor.<a href="#"></a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <!-- SlimScroll -->
    <!-- /.modal -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Refer to a Friend</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.refer_friend') }}" method="POST">
                    @csrf
                    <input type="hidden" name="milestone_id" value="" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Friend's Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email Here"
                                required />
                            <input type="hidden" name="username" value="{{ Auth()->user()->name }}" />
                            <!-- <input type="test" name="due_date" class="form-control" placeholder="Enter ..."> -->
                        </div>
                        <div class="modal-footer justify-content-between btn-group">
                            <button onclick="" type="submit" class="btn btn-primary">Send</button>
                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- /.modal -->


    <script src="{{ url('public/') }}/theme/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('public/') }}/theme/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('public/') }}/theme/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ url('public/') }}/theme/admin/plugins/sparklines/sparkline.js"></script>

    <!-- ChartJS -->
    <script src="{{ url('public/') }}/theme/admin/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('public/') }}/theme/admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('public/') }}/theme/admin/dist/js/demo.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <!-- Page specific script -->
    <script src="{{ url('public/') }}/theme/admin/plugins/moment/moment.min.js"></script>
    <script src="{{ url('public/') }}/theme/admin/plugins/fullcalendar/main.js"></script>
    <script src="{{ url('public/') }}/theme/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- Toastr Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {!! Toastr::message() !!}

    @stack('scripts')
    <!-- Select2 -->
    <script src="{{ url('public/') }}/theme/admin/select2/dist/js/select2.full.min.js"></script>

    <script>
        function check_notifications() {
            console.log('checking notifications');
            $.post("{{ route('user.json.notifications') }}", {
                _token: '{{ csrf_token() }}'
            }, function(data, status) {

                //alert("Data: " + data + "\nStatus: " + status);

                var json = JSON.parse(data);
                //alert(json.data.length);
                $('#notificaton_count').html(json.data.length);
                $('#notification_icon_count').html(json.data.length);
                var notifications = '';
                for (var i = 0; i < json.data.length; i++) {
                    notifications += "<a href=\"" + json.data[i].url + "\" class=\"dropdown-item\">";
                    notifications += "    <i class=\"fas fa-envelope mr-2\"></i> " + json.data[i].message;
                    notifications +=
                        "    <br><small class=\"float-right text-muted text-sm\" style=\"font-size:8px;\">" + json
                        .data[i].created_at + "</small><br>";
                    notifications += "</a>";
                    notifications += "<div class=\"dropdown-divider\"></div>";
                }
                $('#notification_panel').html(notifications);

            });
        }
        check_notifications();
        setInterval(check_notifications, 20000);
    </script>

</body>

</html>
