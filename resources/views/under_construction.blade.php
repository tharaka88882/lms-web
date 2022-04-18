<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | YOU2MENTOR</title>

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ url('public/') }}/theme/admin/select2/dist/css/select2.min.css">

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
    .checked {
    color: orange;
    }
    </style>

    @stack('styles')

</head>

<body class="hold-transition">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    @if (Auth()->user() != null)
                        <a href="#" class="dropdown-toggle1" data-toggle="dropdown">
                            <div class="user-panel">
                                <img style="width: 25px; height: 25px; margin-top: 5px; vertical-align: top !important; margin-left: 15px;"
                                    onerror=" this.src='{{ url('public') }}/theme/admin/dist/img/default-avatar.jpg'"
                                    @if (Auth()->user()->image != null) src="{{ url('public') }}/images/profile/{{ Auth()->user()->image }}" @else src="" @endif class="img-circle elevation-2" alt="User Image"
                                    title="@if (Auth()->user()->image != null) {{ url('public/') }}/images/profile/{{Auth()->user()->image}} @endif" >

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
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf @method('post')
                                        <button class="btn btn-link btn-flat" style="padding-left: 0">Sign out</button>
                                    </form>
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
            <a href="{{route('dashboard')}}" class="brand-link">

                <img src="{{ url('public/') }}/theme/admin/dist/img/logo/you2logo.png" alt="AdminLTE Logo"

                    class="img-push elevation-1" style="margin-left: 75px; width: 100px; height: 100px;">
                {{-- <span class="brand-text font-weight-light">YOU2MENTOR</span> --}}
            </a>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
              <div class="content-header">
                <div class="container-fluid">
                  <div class="container">
                  <div class="col-sm-12">
            <div style="font-size:15px; text-align:center;" class="alert alert-warning">
              Thanks for signing up. We will be launching officially soon and will notify you once we are live. In the meantime our pilot is running, so update your profile, explore and check out the RSS feed curated for your development.
              <br/>
              We would love to hear feedback on how we can improve your experience, so drop us a note through here (provide link to contact us page hyperlinking here)
              <br/>
              <span style="color:black; font-size:larger;">
                You can follow us on &nbsp;&nbsp;<a href="https://www.linkedin.com/company/you2mentor/" target="_blank"><i class="bi bi-linkedin"></i></a> &nbsp;&nbsp; <a href="https://www.twitter.com/You2Mentor" target="_blank" ><i class="bi bi-twitter"></i></a> &nbsp;&nbsp; <a href="https://www.instagram.com/You2Mentor/" target="_blank"><i class="bi bi-instagram"></i></a>
              </span>
            </div>
          </div>
                  </div>
                </div><!-- /.container-fluid -->
              </div>
              <!-- /.content-header -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2021-2022 <a href="#"></a>.</strong> All rights reserved.
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
        function check_notifications(){
            console.log('checking notifications');
            $.post("{{route('user.json.notifications')}}", {
                _token: '{{ csrf_token() }}'
            } ,function(data, status){

                //alert("Data: " + data + "\nStatus: " + status);

                var json = JSON.parse(data);
                //alert(json.data.length);
                $('#notificaton_count').html(json.data.length);
                $('#notification_icon_count').html(json.data.length);
                var notifications = '';
                for(var i=0; i<json.data.length; i++){
                    notifications += "<a href=\""+json.data[i].url+"\" class=\"dropdown-item\">";
                    notifications += "    <i class=\"fas fa-envelope mr-2\"></i> "+json.data[i].message;
                    notifications += "    <br><small class=\"float-right text-muted text-sm\" style=\"font-size:8px;\">"+json.data[i].created_at+"</small><br>";
                    notifications += "</a>";
                    notifications += "<div class=\"dropdown-divider\"></div>";
                }
                $('#notification_panel').html(notifications);

            });
        }
        check_notifications();
        setInterval( check_notifications,20000);
    </script>

</body>

</html>