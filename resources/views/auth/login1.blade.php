<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YOU2MENTOR | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('public')}}/theme/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('public')}}/theme/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public')}}/theme/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url('{{url('public')}}/theme/admin/dist/img/YOU2MENTOR_new.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('')}}"><img height="85px" width="180px" src="{{url('public')}}/theme/admin/dist/img/logo/YOU2MENTOR.png"/></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

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

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <!--a href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a-->
        <a href="{{ url('auth/linkedin') }}" class="btn btn-block btn-primary">
          <i class="fab fa-linkedin mr-2"></i> Sign in using Liknedin
        </a>
      </div-->
      {{-- </.social-auth-links> --}}

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{url('')}}/register" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('public')}}/theme/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('public')}}/theme/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('public')}}/theme/admin/dist/js/adminlte.min.js"></script>
</body>
</html>
