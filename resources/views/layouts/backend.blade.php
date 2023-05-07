<!doctype html>

<html lang="en" class="app_theme_dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no,width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="{{ asset('backend/assets/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('backend/assets/img/favicon-32x32.png') }}" sizes="32x32">

    <title>@yield('title')</title>

    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('backend/bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('backend/assets/icons/flags/flags.min.css') }}" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style_switcher.min.css') }}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/main.min.css') }}" media="all">

    <link rel="stylesheet" href="{{ asset('backend/assets/skins/dropify/css/dropify.css') }}">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/themes/themes_combined.min.css') }}" media="all">

    @yield('styles')

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">fullscreen</i></a></li>
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image">
                                <img class="md-user-image" src="{{ auth()->user()->image ? asset(auth()->user()->image) : asset('backend/assets/img/default-avatar.png') }}" alt=""/>
                            </a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="{{ route('admin_profile_index') }}">My Profile</a></li>
                                    <li><a href="javascript:void(0)" data-uk-modal="{target:'#changePasswordModal'}">Change Password</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
        </div>
    </header>
    <!-- main header end -->

    @include('layouts/main_sidebar')

    <div id="page_content">
        <div id="page_content_inner">
            @include('layouts/backend_alert')
            @yield('content')
        </div>
    </div>

    @include('layouts/change_password_modal')

    {{-- Delete Row Form --}}
    <form method="post" id="deleteRow" hidden>
        @method('DELETE')
        @csrf
    </form>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="{{ asset('backend/assets/js/common.min.js') }}"></script>
    <!-- uikit functions -->
    <script src="{{ asset('backend/assets/js/uikit_custom.min.js') }}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ asset('backend/assets/js/altair_admin_common.min.js') }}"></script>

    <script src="{{ asset('backend/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "{{ asset('backend/assets/js/custom/dense.min.js') }}", function(data) {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
        });
        $window.on('load', function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>

    <script type="text/javascript">
        $('.uk-modal').on({
            'show.uk.modal': function(){
                $('select').selectize();
            },
        });

        $('.dropify').dropify();

        function deleterow(link) {
            UIkit.modal.confirm('Are you sure?', function(){
                $('#deleteRow').attr('action', link);
                $('#deleteRow').submit();
            });
        }
    </script>

    @yield('scripts')

</body>

</html>