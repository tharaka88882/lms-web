<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YOU2MENTOR | Log in</title>
  <link rel="icon" href="{{ url('public/') }}/theme/admin/dist/img/logo/favi_logo.jpeg" type="image/x-icon"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('public')}}/theme/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('public')}}/theme/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public')}}/theme/admin/dist/css/adminlte.min.css">
     <!-- Toastr Style-->
     <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

 @stack('styles')
</head>
<body class="hold-transition login-page" style="background-image: url('{{url('public')}}/theme/admin/dist/img/you2mentor_covers-01.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="https://you2mentor.com"><img height="200px" width="200px" src="{{url('public')}}/theme/admin/dist/img/logo/you2logo.png"/></a>
    <button  data-toggle="modal" data-target="#modal-md" class="btn btn-xs btn-warning ml-2">btn</button>

  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>


      <div class="input-group mb-3">
        <select id="m_select" type="text" class="form-control">
          <!--<option value="select">Select One</option>-->
          <option selected="" value="student">Mentee only</option>
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
    <div id="form_div">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @if($errors->has('email')) {{'is-invalid'}} @endif" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
            </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @if($errors->has('password')) {{'is-invalid'}} @endif" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @if($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input name="remember" type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
          </a-->
        {{-- <p>- OR -</p> --}}
        <!--a href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a-->
        <a id="linkedinBtn" href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
          <i class="fab fa-linkedin mr-2"></i> Sign in using Liknedin
        </a>
      {{-- </div--> --}}
      {{-- </.social-auth-links> --}}

      <p class="mb-1">
        <a id="forgotBtn" href="{{route('auth.find_account')}}">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{url('')}}/register" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body>
  </div>
</div>


<!-- /.modal -->
<div class="modal fade" id="modal-md">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" style="text-transform: capitalize"><b>How to add login screen to Home Screen</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
            @csrf
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="form-group col-sm-9">
                            Click on settings button in web browser

                            Select more tool

                            Select create a shortcut on Desktop
                        </div>

                    </div>

                       </div>
            </div>


    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery -->
<script src="{{url('public')}}/theme/admin/plugins/jquery/jquery.min.js"></script>
<script src="{{url('public')}}/theme/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('public')}}/theme/admin/dist/js/adminlte.min.js"></script>
<!-- Toastr Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

{!! Toastr::message() !!}

@stack('scripts')


<script>
    //alert('test');
$('document').ready(function(){
   // alert('test');

        $('#form_div').show();
        $('#linkedinBtn').hide();
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
        if( $('#m_select option:selected').val()=='student'){
        $('#form_div').show();
        $('#linkedinBtn').hide();
        $('#forgotBtn').show();
        $('#fbBtn').show();
        $('#googleBtn').show();
    }else if( $('#m_select option:selected').val()=='teacher'){
        $('#form_div').hide();
        $('#linkedinBtn').show();
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
</body>
</html>
