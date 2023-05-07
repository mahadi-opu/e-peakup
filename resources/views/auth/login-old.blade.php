@extends('layouts/frontend')

@section('title', 'Sign In')

@section('content')
    <div class="login-signup-page mx-auto my-5">
      <h3 class="font-weight-400 text-center">Sign In</h3>
      <p class="lead text-center">Your login information is safe with us.</p>
      <div class="bg-light shadow-md rounded p-4 mx-2">
        <form id="loginForm" method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="emailAddress">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="emailAddress" required placeholder="Enter Your Email" value="{{ old('email') }}" autocomplete="email" autofocus="">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label for="loginPassword">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" required placeholder="Enter Password" required autocomplete="current-password">
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
              <div class="col-sm text-right"><a class="btn-link" href="#">Forgot Password ?</a></div>
            </div>
            <button type="submit" class="btn btn-primary btn-block my-4">Sign In</button>
        </form>
      <p class="text-3 text-muted text-center mb-0">Don't have an account? <a class="btn-link" href="{{ route('register') }}">Sign Up</a></p>
    </div>
@endsection
