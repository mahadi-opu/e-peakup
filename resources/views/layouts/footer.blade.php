@php
  $setting = App\Models\Setting::first();
@endphp

<footer id="footer" class="pb-4">
 <div class="container">
   <div class="row">
    
    <div class="col-sm-6 col-md mb-3 mb-md-0 footer_logo">
      <img src="{{ asset('frontend/images/qp_icon.png') }}">
    </div>

    <div class="col-sm-6 col-md mb-3 mb-md-0">
      <h4 class="text-3 text-muted text-uppercase font-weight-400 mb-3">Useful Links</h4>
      <ul class="nav flex-column">
        <li class="nav-item"> <a class="nav-link" href="{{ route('frontend_about_us') }}">About Us</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('frontend_help') }}">FAQ</a></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('frontend_terms') }}">Terms and Privacy</a></li>
      </ul>
    </div>

    <div class="col-sm-6 col-md mb-3 mb-md-0">
      <h4 class="text-3 text-muted text-uppercase font-weight-400 mb-3">Contact Us</h4>
      <ul class="nav flex-column">
        <li class="nav-item"> <a class="nav-link" href="callto:+00000000">+000000000</a></li>
        <li class="nav-item"> <a class="nav-link" href="mailto:support@quickpeakup.com">support@quickpeakup.com</a></li>
      </ul>
      <ul class="social-icons mt-2">
        <li class="social-icons-facebook"><a data-toggle="tooltip" href="{{ $setting->facebook }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
        <li class="social-icons-instagram"><a data-toggle="tooltip" href="{{ $setting->instagram }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
        <li class="social-icons-twitter"><a data-toggle="tooltip" href="{{ $setting->twitter }}" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
        <li class="social-icons-linkedin"><a data-toggle="tooltip" href="{{ $setting->linkedin }}" target="_blank" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
        <li class="social-icons-youtube"><a data-toggle="tooltip" href="{{ $setting->youtube }}" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
      </ul>
    </div>
     
    <div class="col-12 col-lg-3">
     <h4 class="text-3 text-muted text-uppercase font-weight-400 mb-3">Subscribe</h4>
     <p>Subscribe to receive latest news and updates.</p>
     <form method="post" action="{{ route('frontend_subscribe') }}">
      @csrf
       <div class="input-group newsletter">
          <input class="form-control" placeholder="Your Email Address" name="email" id="newsletterEmail" type="email" value="{{ old('email') }}">
          <span class="input-group-append">
            <button type="submit" class="btn btn-secondary" data-toggle="tooltip" data-original-title="Subscribe"><i class="fas fa-paper-plane"></i></button>
          </span>
        </div>
     </form>
     <img src="{{ asset('frontend/images/ssl.png') }}" class="mt-3" width="150px">
     </div>
   </div>

   <div class="footer-copyright pt-4 mt-4">
      <div class="container">
        <p class="text-center text-lg-left mb-2 mb-lg-0">Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ env('APP_NAME') }}</a>. All Rights Reserved.</p>
      </div>
    </div>
   </div>
</footer>