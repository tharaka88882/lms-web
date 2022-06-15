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

    @stack('styles')
</head>

<body class="hold-transition login-page"
    style="background-image: url('{{ url('public') }}/theme/admin/dist/img/you2mentor_covers-04.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
    <div class="login-box">
        <div class="login-logo">
            <a href="https://you2mentor.com"><img height="200px" width="200px"
                    src="{{ url('public') }}/theme/admin/dist/img/logo/you2logo.png" /></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="Please copy and paste Your Linkedin Profile link or Any Professional reference Website.(Eg:IMBD)</p>


    <div id="
                    form_div">
                <form method="POST" action="{{ route('auth.save_linkedin') }}">
                    @csrf

                    <label>Please enter your linkedin profile link</label>
                    <div class="input-group mb-3">
                        <input type="text"
                            class="form-control @if ($errors->has('linkedin_link')) {{ 'is-invalid' }} @endif"
                            name="linkedin_link" placeholder="Linkedin Link">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('linkedin_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linkedin_link') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-4">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Continue</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="col-4">

                    </div>
                </form>

            </div>
        </div>


        <!-- jQuery -->
        <script src="{{ url('public') }}/theme/admin/plugins/jquery/jquery.min.js"></script>
        <script src="{{ url('public') }}/theme/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('public') }}/theme/admin/dist/js/adminlte.min.js"></script>
        <!-- Toastr Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        {!! Toastr::message() !!}

        @stack('scripts')
        <script>
            //alert('test');
            // $('document').ready(function(){
            //    // alert('test');

            //         $('#form_div').show();
            //         $('#linkedinBtn').hide();
            //         $('#forgotBtn').show();
            //         //$('#registerBtn').attr("disabled",true);
            //         //$('#lilnedinBtn').removeAttr('href');
            //         //$('#lilnedinBtn').addClass('disabled');


            //     $('#m_select').click(function(){
            //     //alert('test');
            //     if( $('#m_select option:selected').val()=='student'){
            //         $('#form_div').show();
            //         $('#linkedinBtn').hide();
            //         $('#forgotBtn').show();
            //     }else if( $('#m_select option:selected').val()=='teacher'){
            //         $('#form_div').hide();
            //         $('#linkedinBtn').show();
            //         $('#forgotBtn').hide();
            //     }
            //     });
            // });

            // function trans(lang){
            //     $.post( 'cookie/set' , {'name':lang, 'timeout':-1}).done(function(data){
            //         removeEvent();
            //     });
            // }
        </script>
</body>

</html>
