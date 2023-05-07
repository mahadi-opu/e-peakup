<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
      <link href="{{ asset('frontend/images/qp_icon.png') }}" rel="icon" />
      <title>@yield('title')</title>
      <meta name="description" content="This professional design html template is for build a Money Transfer and online payments website.">
      <meta name="author" content="harnishdesign.net">
      <!-- Web Fonts
         ============================================= -->
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>
      <!-- Stylesheet
         ============================================= -->
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/font-awesome/css/all.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap-select/css/bootstrap-select.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/currency-flags/css/currency-flags.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}" />

      <style type="text/css">
         #optimize_clear {
            position: fixed;
             z-index: 1030;
             bottom: 0;
             left: 15px;
             text-align: center;
             color: #fff;
             font-size: 10px;
             line-height: 36px;
             border-radius: 0.25rem;
             transition: all 0.3s ease-in-out;
         }

         #optimize_clear img {
            width: 25px;
            height: 25px;
         }

         .main_header {
            padding: 0 10rem;
         }

         .footer_logo img {
            width: 60%;
         }

         @media only screen and (max-width: 600px) {
            .main_header {
               padding: 0;
            }
            .footer_logo {
               text-align: center;
            }
            .footer_logo img {
               width: 40%;
            }
         }
      </style>
      @yield('styles')
   </head>

   <body style="background: #fff;">

      <div id="preloader">
         <div data-loader="dual-ring"></div>
      </div>

      <div id="main-wrapper">

         <header id="header" >
            <div class="container-fluid main_header">
               <div class="header-row">
                  <div class="header-column justify-content-start">
                     <div class="logo">
                        <a class="d-flex" href="{{ url('/') }}" title="{{ env('APP_NAME') }}">
                        <img src="{{ url()->current() == url('/') ? asset('frontend/images/qp_logo_white.png') : asset('frontend/images/qp_logo_black.png') }}" alt="{{ env('APP_NAME') }}" width="200px">
                        </a>
                     </div>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button>
                     <nav class="primary-menu navbar navbar-expand-lg">
                        <div id="header-nav" class="collapse navbar-collapse mx-3">
                           <ul class="navbar-nav mr-auto">
                              <li class="menu_send_money"><a href="{{ route('frontend_send') }}">Send Money</a></li>
                              @if (auth()->check())
                                 <li class="menu_profile"><a href="{{ route('userpanel_dashboard_index') }}">Dashboard</a></li>
                              @endif
                              <li class="menu_how_it_works"><a href="{{ route('frontend_how_it_works') }}">How It Works</a></li>
                              <li class="menu_help"><a href="{{ route('frontend_help') }}">Help</a></li>
                              <li class="menu_help"><a href="{{ route('frontend_about_us') }}">About Us</a></li>
                           </ul>
                        </div>
                     </nav>
                  </div>
                  <div class="header-column justify-content-end">
                     <nav class="login-signup navbar navbar-expand">
                        <ul class="navbar-nav">
                          @if (auth()->check())
                            <li>
                              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                              </form>
                            </li>
                          @else
                            <li><a href="{{ route('login') }}">Sign In</a> </li>
                            <li class="align-items-center h-auto ml-sm-3"><a class="btn btn-primary d-none d-sm-block" href="{{ route('register') }}">Sign Up</a></li>
                          @endif
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </header>

         <div id="content">
            @include('layouts/alert')
            @yield('content')
         </div>

         @include('layouts/footer')

      </div>

      <a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>
      <a id="optimize_clear" data-toggle="tooltip" title="Clear Cookies" href="{{ route('optimize') }}">
         <img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/50/000000/external-reload-arrows-vitaliy-gorbachev-fill-vitaly-gorbachev.png"/>
      </a>

      <div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bg-transparent border-0">
               <button type="button" class="close text-white opacity-10 ml-auto mr-n3 font-weight-400" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <div class="modal-body p-0">
                  <div class="embed-responsive embed-responsive-16by9">
                     <iframe class="embed-responsive-item" id="video" allow="autoplay"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('frontend/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
      <script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('frontend/js/theme.js') }}"></script>
      
      <!-- My Live Chat -->
      <script type="text/javascript">function add_chatinline(){var hccid=79452489;var nt=document.createElement("script");nt.async=true;nt.src="https://www.mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
      add_chatinline();</script>

      <script type="text/javascript">
         
         function copyToClipboard() {
            var link_to_copy = $('#link_to_copy');
             var $temp = $("<input>");
             $("body").append($temp);
             $temp.val(link_to_copy.val()).select();
             document.execCommand("copy");
             link_to_copy.select();
             $temp.remove();
         }

      </script>

      <script type="text/javascript">
         $(document).on('change', '.profile_thumb', function() {
            $('#profileThumbForm').submit();
         });
      </script>

      @yield('scripts')

   </body>
</html>