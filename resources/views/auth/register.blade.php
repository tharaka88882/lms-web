<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YOU2MENTOR | Register</title>
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
</head>

<body class="hold-transition login-page"
    style="background-image: url('{{ url('public') }}/theme/admin/dist/img/you2mentor_covers-02.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
    <div class="register-box">
        <div class="register-logo">
            <a href="https://you2mentor.com"><img height="200px" width="200px"
                    src="{{ url('public') }}/theme/admin/dist/img/logo/you2logo.png" /></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>



                <div class="input-group mb-3" style="display: none;" >
                    <select id="m_select" type="text" class="form-control">
                        <!--<option value="select">Select One</option>-->
                        <option selected="" value="student">Mentee</option>
                        <option value="teacher">Mentor/Mentee</option>
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
                <div>
                    <form id="form_div" action="{{ route('auth.verify_mentee_email') }}" method="post">
                        @csrf
                        <input type="hidden" name="type" value="teacher" />
                        <div id="name_div" class="input-group mb-3 se">
                            <input type="text"
                                class="form-control @if ($errors->has('name')) {{ 'is-invalid' }} @endif"
                                placeholder="Full name" name="name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div id="email_div" class="input-group mb-3 se">
                            <input type="email"
                                class="form-control @if ($errors->has('email')) {{ 'is-invalid' }} @endif"
                                name="email" placeholder="Email">
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
                        <div id="pass1_div" class="input-group mb-3 se">
                            <input type="password" name="password"
                                class="form-control @if ($errors->has('password')) {{ 'is-invalid' }} @endif"
                                placeholder="Password">
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
                        <div id="pass2_div" class="input-group mb-3 se">
                            <input type="password"
                                class="form-control @if ($errors->has('password_confirmation')) {{ 'is-invalid' }} @endif"
                                name="password_confirmation" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div id="agree_div" class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        I agree to the <a href="{{ route('privacy') }}">Terms & Conditions</a>
                                    </label>
                                </div>
                                <div class="icheck-primary">
                                    <input type="checkbox" id="disclaimerTerms" name="disclaimer" value="agree">
                                    <label for="disclaimerTerms">
                                        I agree to the <a href="{{ route('disclaimer') }}">Disclaimer and Release</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4 se">
                                <button disabled id="registerBtn" type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div id="lilnedin_div" class="social-auth-links text-center">
                    {{-- <p>- OR -</p> --}}
                    <button disabled onclick="loadFb();" id="fbBtn"  class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </button>
                    <button disabled onclick="loadGo();" id="googleBtn" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i> Sign in using Google
                    </button>
                        <button disabled onclick="loadLin();" id="lilnedinBtn" class="btn btn-block btn-primary">
                            <i class="fab fa-linkedin mr-2"></i> Sign up using Linkedin
                        </button>
                </div>

                <a href="{{ url('') }}/login" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>




    <!-- jQuery -->
    <script src="{{ url('public') }}/theme/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('public') }}/theme/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('public') }}/theme/admin/dist/js/adminlte.min.js"></script>
    <script>
        //alert('test');
        $('document').ready(function() {
            // alert('test');

            $('.se').show();
            $('#lilnedinBtn').show();
            $('#fbBtn').show();
            $('#googleBtn').show();
            //$('#registerBtn').attr("disabled",true);
            //$('#lilnedinBtn').removeAttr('href');
            //$('#lilnedinBtn').addClass('disabled');


            // $('#m_select').click(function(){
            // //alert('test');
            // if( $('#m_select option:selected').val()=='student'){
            //     $('#form_div').show();
            //     $('#lilnedin_div').hide();
            // }else if( $('#m_select option:selected').val()=='teacher'){
            //     $('#form_div').hide();
            //     $('#lilnedin_div').show();
            // }

            // });

            $('#m_select').on('change', function() {
                if ($('#m_select option:selected').val() == 'student') {
                    $('.se').show();
                    $('#lilnedinBtn').hide();
                    $('#fbBtn').show();
                    $('#googleBtn').show();
                } else if ($('#m_select option:selected').val() == 'teacher') {
                    $('.se').hide();
                    $('#lilnedinBtn').show();
                    $('#fbBtn').hide();
                    $('#googleBtn').hide();
                }
            });


            $('#agreeTerms').click(function() {
                if ($('#agreeTerms').is(':checked') && $('#disclaimerTerms').is(':checked')) {
                    // alert("t");
                    $('#registerBtn').prop('disabled', false);
                    $('#fbBtn').prop('disabled', false);
                    $('#googleBtn').prop('disabled', false);
                    $('#lilnedinBtn').prop('disabled', false);
                } else {
                    //alert("tjio");
                    $('#registerBtn').prop('disabled', true);
                    $('#fbBtn').prop('disabled', true);
                    $('#googleBtn').prop('disabled', true);
                    $('#lilnedinBtn').prop('disabled', true);
                }
            });

            $('#disclaimerTerms').click(function() {
                if ($('#disclaimerTerms').is(':checked') && $('#agreeTerms').is(':checked')) {
                    // alert("t");
                    $('#registerBtn').prop('disabled', false);
                    $('#fbBtn').prop('disabled', false);
                    $('#googleBtn').prop('disabled', false);
                    $('#lilnedinBtn').prop('disabled', false);
                } else {
                    //alert("tjio");
                    $('#registerBtn').prop('disabled', true);
                    $('#fbBtn').prop('disabled', true);
                    $('#googleBtn').prop('disabled', true);
                    $('#lilnedinBtn').prop('disabled', true);
                }
            });

        });

        // function trans(lang){
        //     $.post( 'cookie/set' , {'name':lang, 'timeout':-1}).done(function(data){
        //         removeEvent();
        //     });
        // }

        function loadFb(){
            document.location = '{{ url('auth/facebook') }}';
        }
        function loadGo(){
            document.location = '{{ url('auth/google') }}';
        }
        function loadLin(){
            document.location = '{{ url('auth/linkedin') }}';
        }
    </script>

</body>

</html>
<!-- /.register-box -->
