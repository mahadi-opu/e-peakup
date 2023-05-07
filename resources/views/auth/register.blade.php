@extends('layouts/frontend')

@section('title', 'Sign Up')

@section('styles')
    <style type="text/css">
        #main-wrapper {
            background-image: url('{{ asset('frontend/images/sign_up_bg.jpg') }}');
        }
    </style>
@stop

@section('content')
<div class="login-signup-page mx-auto my-5">
    <h3 class="font-weight-400 text-center text-white">Sign Up</h3>
    <p class="lead text-center text-white">Your Sign Up information is safe with us.</p>
    <div class="bg-light shadow-md rounded p-4 mx-2">
        <form id="signupForm" method="post" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="refer" value="{{ request()->refer }}">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus="">
                @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="emailAddress">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">+61</span></div>
                    <input type="tel" class="form-control" id="phoneNumber" name="phone" placeholder="Enter Your Phone" min="10" value="{{ old('phone') }}" required autocomplete="phone">
                </div>
                @error('phone')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" required autocomplete="new-password" minlength="8">
                    <div class="input-group-append">
                      <button type="button" id="password_toggle" class="input-group-text"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm_password" name="password_confirmation" placeholder="Enter Confirm Password" required autocomplete="confirm_password" minlength="8">
                    <div class="input-group-append">
                      <button type="button" id="confirm_password_toggle" class="input-group-text"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block my-4">Sign Up</button>
        </form>
        <p class="text-3 text-muted text-center mb-0">Already have an account? <a class="btn-link" href="{{ route('login') }}">Log In</a></p>
   </div>
</div>
@endsection

@section('scripts')
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

        var confirmTogglePassword = document.getElementById("confirm_password_toggle");

        if (confirmTogglePassword) {
            confirmTogglePassword.addEventListener('click', function() {
              var x = document.getElementById("confirm_password");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            });
        }
    </script>
@stop