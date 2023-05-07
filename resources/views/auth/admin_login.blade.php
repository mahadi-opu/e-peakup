
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="images/favicon.png" rel="icon" />
<title>Admin Login</title>
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
  <div class="container h-100">
    <!-- Login Form
    ============================================= -->
    <div class="row no-gutters h-100">
      <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4 m-auto">
        <div class="logo mb-4 text-center"> <a href="{{ url('/') }}" title="Quick Pickup"><img src="{{ asset('frontend/images/qp_logo_white.png') }}" alt="Quick Pickup" width="200px"></a> </div>
        <form id="loginForm" method="post" action="{{ route('login') }}">
          @csrf
          <div class="vertical-input-group">
            <div class="input-group">
              <input type="email" class="form-control" name="email" id="emailAddress" required placeholder="Your Email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="input-group">
              <input type="password" class="form-control" name="password" id="loginPassword" required placeholder="Password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <button class="btn btn-primary btn-block shadow-none my-4" type="submit">Login</button>
        </form>
        <p class="text-3 text-center text-muted">Don't have an account? <a class="btn-link" href="{{ route('register') }}">Sign Up</a></p>
        {{-- <p class="text-center"><a class="btn-link" href="#">Forgot Password?</a></p> --}}
      </div>
      <div class="col-12 fixed-bottom">
        <p class="text-center text-1 text-muted mb-1">Copyright © 2019 <a href="#">Payyed</a>. All Rights Reserved.</p>
      </div>
    </div>
    <!-- Login Form End -->
  </div>
</div>

<!-- Back to Top
============================================= --> 
<a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a> 

<!-- Script --> 
<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('frontend/js/theme.js') }}"></script>
</body>
</html>