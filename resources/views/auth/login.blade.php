<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{ asset('frontend/images/qp_icon.png') }}" rel="icon" />
<title>Login</title>
<meta name="description" content="This professional design html template is for build a Money Transfer and online payments website.">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/font-awesome/css/all.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}" />
</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End -->

<div id="main-wrapper" class="h-100">
  <div class="container-fluid px-0 h-100">
    <div class="row no-gutters h-100">
      <!-- Welcome Text
      ============================================= -->
      <div class="col-md-6">
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-8 bg-primary"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('{{ asset('frontend/images/bg/image-3.jpg') }}');"></div>
          <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
            <div class="row no-gutters">
              <div class="col-10 col-lg-9 mx-auto">
                <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex" href="{{ url('/') }}" title="Quick Pickup"><img src="{{ asset('frontend/images/qp_logo_white.png') }}" alt="Quick Pickup" width="200px"></a> </div>
              </div>
            </div>
              <div class="row no-gutters my-auto">
                <div class="col-10 col-lg-9 mx-auto">
                  <h1 class="text-11 text-white mb-4">Welcome back!</h1>
                  <p class="text-4 text-white line-height-4 mb-5">We are glad to see you again! Instant deposits, withdrawals & payouts trusted by millions worldwide.</p>
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- Welcome Text End -->
      
      <!-- Login Form
      ============================================= -->
      <div class="col-md-6 d-flex align-items-center">
        <div class="container my-4">
          <div class="row">
            <div class="col-11 col-lg-9 col-xl-8 mx-auto">
              <h3 class="font-weight-400 mb-4">Log In</h3>
              <form id="loginForm" method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <label for="emailAddress">Email Address</label>
                  <input type="email" class="form-control" name="email" id="emailAddress" required placeholder="Enter Your Email">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" required placeholder="Enter Password">
                    <div class="input-group-append">
                      <button type="button" id="password_toggle" class="input-group-text"><i class="fas fa-eye"></i></button>
                    </div>
                  </div>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="row">
                  <div class="col-sm">
                    <div class="form-check custom-control custom-checkbox">
                      <input id="remember-me" name="remember" class="custom-control-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="col-sm text-right"><a class="btn-link" href="{{ route('password.request') }}">Forgot Password ?</a></div>
                </div>
                <button class="btn btn-primary btn-block my-4" type="submit">Login</button>
              </form>
              <p class="text-3 text-center text-muted">Don't have an account? <a class="btn-link" href="{{ route('register') }}">Sign Up</a></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End -->
    </div>
  </div>
</div>

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

<!-- Script -->
<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('frontend/js/theme.js') }}"></script>

<script type="text/javascript">
    var togglePassword = document.getElementById("password_toggle");

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        });
    }
</script>

</body>
</html>