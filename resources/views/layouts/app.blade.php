<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/site.css') }}">
    <link rel="icon" href="{{ asset('theme/assets/images/new-logo.jpg') }}" type="image/jpg">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/slidepanel/slidePanel.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('theme/global/vendor/flag-icon-css/flag-icon.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('theme/global/vendor/waves/waves.css') }}">

    @yield('style')

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('theme/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <script src="{{ asset('theme/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="@yield('body_class')">
    @auth
        @include('layouts.header')
        @include('layouts.menu')
    @endauth

    <div id="app">
        @yield('content')
    </div>

    @auth
        @include('layouts.footer')
    @endauth
</body>
    <!-- Core  -->
    <script src="{{ asset('theme/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/popper-js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/animsition/animsition.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/waves/waves.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('theme/global/vendor/switchery/switchery.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/intro-js/intro.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/screenfull/screenfull.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
    <script src="{{ asset('theme/global/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('theme/global/js/Component.js') }}"></script>
    <script src="{{ asset('theme/global/js/Plugin.js') }}"></script>
    <script src="{{ asset('theme/global/js/Base.js') }}"></script>
    <script src="{{ asset('theme/global/js/Config.js') }}"></script>

    <script src="{{ asset('theme/assets/js/Section/Menubar.js') }}"></script>
    <script src="{{ asset('theme/assets/js/Section/Sidebar.js') }}"></script>
    <script src="{{ asset('theme/assets/js/Section/PageAside.js') }}"></script>
    <script src="{{ asset('theme/assets/js/Plugin/menu.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('theme/global/js/config/colors.js') }}"></script>
    <script src="{{ asset('theme/assets/js/config/tour.js') }}"></script>
    <script>Config.set('assets', '{{ asset('theme/assets') }}');</script>

    <!-- Page -->
    <script src="{{ asset('theme/assets/js/Site.js') }}"></script>
    <script src="{{ asset('theme/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{ asset('theme/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{ asset('theme/global/js/Plugin/switchery.js') }}"></script>
    <script src="{{ asset('theme/global/js/Plugin/jquery-placeholder.js') }}"></script>
    <script src="{{ asset('theme/global/js/Plugin/material.js') }}"></script>

    <script>
        (function(document, window, $){
            'use strict';

            var Site = window.Site;
            $(document).ready(function(){
                Site.run();
            });
        })(document, window, jQuery);
    </script>

    <!-- common js -->
    <script src="{{ asset('js/common.js') }}"></script>

    @yield('script')
</html>
