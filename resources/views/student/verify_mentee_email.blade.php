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
    <!-- Toastr Style-->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('styles')
</head>
<body class="hold-transition login-page" style="background-image: url('{{url('public')}}/theme/admin/dist/img/you2mentor_covers-04.jpg');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('')}}"><img height="200px" width="200px" src="{{url('public')}}/theme/admin/dist/img/logo/you2logo.png"/></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Enter the verification code we sent to your email.</p>


    <div id="form_div">
      <form method="POST" action="{{route('auth.verify_mentee_code')}}">
        @csrf
        <input type="hidden" name="encripted_code" value="{{$en_code}}"/>
        <input type="hidden" name="email" value="{{$email}}"/>
        <input type="hidden" name="name" value="{{$name}}"/>
        <input type="hidden" name="password" value="{{$password}}"/>
        <input type="hidden" name="type" value="{{$type}}"/>
        {{-- <input type="hidden" name="email" value="{{$email}}"/> --}}
        <div class="input-group mb-3">
          <input type="password" class="form-control @if($errors->has('veri_code')) {{'is-invalid'}} @endif" name="veri_code" placeholder="Verification Code">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @if($errors->has('veri_code'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('veri_code') }}</strong>
              </span>
          @endif
        </div>
        <div class="row">
          <div class="col-4">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Verify</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="col-4">

        </div>
      </form>

  </div>
</div>


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
