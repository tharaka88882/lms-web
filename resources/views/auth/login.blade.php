<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YOU2MENTOR | Log in</title>
    <link rel="icon" href="{{ url('public/') }}/theme/admin/dist/img/logo/favnew.ico" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('public') }}/theme/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('public') }}/theme/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public') }}/theme/admin/dist/css/adminlte.min.css">
    <!-- Toastr Style-->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs.min.css" integrity="sha512-iaYE9B9u4GU8+KkRTOdRdZuzKdYw1X0hOAa4GwDV/uwdXgoX/ffT3ph1+HG1m4LPZD/HV+dkuHvWFLZtPviylQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs-rtl.min.css" integrity="sha512-VwsKKwi99ZnRScgAkJ+ISGNolfoq+ic/mzJfhZWQ1xwfcbLZzLnHDoERYEppL25Okf+wEI/nDhHogudTa/YkWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    @stack('styles')
</head>

<body class="hold-transition login-page"
    style="background-image: url('{{ url('public') }}/theme/admin/dist/img/you2mentor_covers-01.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
    {{-- <button style="position:absolute; top:10px; right:10px;" data-toggle="modal" data-target="#modal-md"
        class="btn btn-xs btn-warning ml-2">btn</button> --}}

    {{-- <nav class="navbar navbar-expand navbar-white navbar-light mt-100px">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" data-target="#navbar-search2" href="#"
                    role="button">
                    <i class="fas fa-search"></i>
                </a>
            </li>
        </ul>
    </nav> --}}

    <div class="login-box">
        <div style="margin-top: 164px; margin-bottom:-214px;!important"><h5 class="text-center">Unleash Your Potential!</h5></div>
        <div class="login-logo" style="margin-bottom: 3.9rem; !important">
            <a href="https://you2mentor.com">
                <img height="200px" width="200px"
                    src="{{ url('public') }}/theme/admin/dist/img/logo/you2logo.png" /></a>
        </div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>


                <div class="input-group mb-3" style="display: none;">
                    <select id="m_select" type="text" class="form-control" >
                        <!--<option value="select">Select One</option>-->
                        <option  value="student">Mentee only</option>
                        <option selected="" value="teacher">Mentor/Mentee</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    {{-- @error('name')
          <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror --}}
                </div>

                @php
                 if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
                {
                   $login_email = $_COOKIE['login_email'];
                   $login_pass  = $_COOKIE['login_pass'];
                   $is_remember = "checked='checked'";
                }
                else{
                   $login_email ='';
                   $login_pass = '';
                   $is_remember = "";
                 }
                @endphp
                <div id="form_div">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email"
                                class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif"
                                name="email" placeholder="Email" value="{{$login_email}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="password"
                                class="form-control @if ($errors->has('password')) {{ 'is-invalid' }} @endif"
                                name="password" placeholder="Password" value="{{$login_pass}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input name="remember" type="checkbox" id="remember" {{$is_remember}}>
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button id="sb_btn" type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <a id="fbBtn" href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a id="googleBtn" href="{{ url('auth/google') }}" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i> Sign in using Google
                        </a>
                    <a id="linkedinBtn" href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
                            <i class="fab fa-linkedin mr-2"></i> Sign in using Linkedin
                     </a>
                        {{-- <p>- OR -</p> --}}
                        <!--a href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a-->
            <div class="row pl-2">
                    <div id="fake_remember" class="form-check" style="text-align: left">
                        <input class="form-check-input" type="checkbox"/>
                        <label class="form-check-lable" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                        {{-- <a id="linkedinBtn" href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
                            <i class="fab fa-linkedin mr-2"></i> Sign in using Linkedin
                        </a> --}}
                        {{-- <a id="googleBtn_1" href="{{ url('auth/google') }}" class="btn btn-block btn-danger">
                            <i class="fab fa-google mr-2"></i> Sign in using Google
                            </a>
                        <a id="fbBtn_1" href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a> --}}
                        {{-- </div--> --}}
                        {{-- </.social-auth-links> --}}

                        <p class="mb-1">
                            <a id="forgotBtn" href="{{ route('auth.find_account') }}">I forgot my password</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{ url('') }}/register" class="text-center">Register a new
                                membership</a>
                        </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-demo">
        <a id="charging-one" class="btn btn-app bg-secondary" style="top:10px; bottom:10px; right:10px; min-width:50px; height:50px; !important"
        data-toggle="modal" data-target="#modal-md">
        <i class="fa fa-external-link-alt"></i>

    </a>
    </div>

    {{-- <div id="charging-one" class="fa" style='font-size:48px; position: relative; left: 68px; bottom: 48px'></div> --}}
    <!-- /.login-card-body>

  </div>
</div>


<!-- /.modal -->
    <div class="modal fade" id="modal-md">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-transform: capitalize">
                        <b>How to add login screen to Home Screen</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            {{-- <div class="form-group col-sm-9">
                                Click on settings button in web browser

                                Select more tool

                                Select create a shortcut on Desktop
                            </div> --}}
                            <ol style="line-height: 2.6;">
                                <li>Click on settings button in web browser</li>
                                <li>Select more tool</li>
                                <li>Select create a shortcut on Desktop</li>
                            </ol>

                        </div>

                    </div>
                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!-- /.modal -->
    {{-- <div class="modal fade" id="modal_arrow">
        <div class="modal-dialog modal-xs">
            <div class="">
    <center>

            <img style="margin-top: 25px;" width="250px;" height="500px;" src="{{ url('public') }}/images/arrow.png"/>
    </center>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}
    <!-- /.modal -->
    <a id="arrow_click" data-toggle="modal" data-target="#modal_arrow" style="display: none;">
    <!-- jQuery -->
    <script src="{{ url('public') }}/theme/admin/plugins/jquery/jquery.min.js"></script>
    <script src="{{ url('public') }}/theme/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('public') }}/theme/admin/dist/js/adminlte.min.js"></script>
    <!-- Toastr Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {!! Toastr::message() !!}

    @stack('scripts')


    {{-- <script>
        function chargebattery() {
          var a;
          a = document.getElementById("charging");
          a.innerHTML = "&#xf104;";
          setTimeout(function () {
            a.innerHTML = "&#xf100;";
          }, 1000);
          setTimeout(function () {
            a.innerHTML = "&#xf104;";
          }, 2000);
          setTimeout(function () {
            a.innerHTML = "&#xf100;";
          }, 3000);
          setTimeout(function () {
            a.innerHTML = "&#xf104;";
          }, 4000);
        }
        chargebattery();
        setInterval(chargebattery, 4000);
        </script> --}}

    <script>
        //alert('test');

        $('document').ready(function() {
        //    if( $('#remember').is(":checked")){
        //     document.getElementById("sb_btn").click();
        //            }

            // alert('test');

            $('#form_div').show();
            $('#linkedinBtn').show();
           // $('#googleBtn_1').hide();
           // $('#fbBtn_1').hide();
            // $('#googleBtn_1').show();
            // $('#fbBtn_1').show();
            $('#fake_remember').hide();
            $('#forgotBtn').show();
            $('#fbBtn').show();
            $('#googleBtn').show();
            //$('#registerBtn').attr("disabled",true);
            //$('#lilnedinBtn').removeAttr('href');
            //$('#lilnedinBtn').addClass('disabled');


            // $('#m_select').click(function(){
            // //alert('test');
            // if( $('#m_select option:selected').val()=='student'){
            //     $('#form_div').show();
            //     $('#linkedinBtn').hide();
            //     $('#forgotBtn').show();
            // }else if( $('#m_select option:selected').val()=='teacher'){
            //     $('#form_div').hide();
            //     $('#linkedinBtn').show();
            //     $('#forgotBtn').hide();
            // }
            // });

            $('#m_select').on('change', function() {
                if ($('#m_select option:selected').val() == 'student') {
                    $('#form_div').show();
                    $('#linkedinBtn').hide();
                    // $('#fbBtn_1').hide();
                    // $('#googleBtn_1').hide();
                    $('#fake_remember').hide();
                    $('#forgotBtn').show();
                    $('#fbBtn').show();
                    $('#googleBtn').show();
                } else if ($('#m_select option:selected').val() == 'teacher') {
                    $('#form_div').hide();
                    $('#linkedinBtn').show();
                    // $('#fbBtn_1').show();
                    // $('#googleBtn_1').show();
                    $('#fake_remember').show();
                    $('#forgotBtn').hide();
                    $('#fbBtn').hide();
                    $('#googleBtn').hide();
                }
            });

        });

        // function trans(lang){
        //     $.post( 'cookie/set' , {'name':lang, 'timeout':-1}).done(function(data){
        //         removeEvent();
        //     });
        // }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/intro.min.js" integrity="sha512-B0B1bdTGi9XHtoCINbtR6z9Vi8IYvvtImIE8KWMtqWAVUt2Wn2k69GxM7ya/3rQcz/Pgm/o1WcDU347/5k202A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        // $('#arrow_click').click();
        // const intro = introJs();

        // intro.setOption("dontShowAgain", true)
        // intro.setOption("doneLabel", " Close ");
        // intro.setOptions({
        //     showBullets: false,
        //     steps: [
        //         {
        //             title: '<b>Welcome</b>',
        //             element: document.querySelector('.card-demo'),
        //             intro: 'Click here to add to home page'
        //         }
        //     ]
        // })

        // intro.start();

    </script>
</body>

</html>
