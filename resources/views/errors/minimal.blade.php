<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('theme/global/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/global/css/bootstrap-extend.min.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/assets/css/site.css') }}">

        <style>
            .page-error .error-mark {
                margin-bottom: 33px;
            }

            .page-error header h1 {
                font-size: 10em;
                font-weight: 400;
            }

            .page-error header p {
                margin-bottom: 30px;
                font-size: 30px;
                text-transform: uppercase;
            }

            .page-error h2 {
                margin-bottom: 30px;
            }

            .page-error .error-advise {
                margin-bottom: 25px;
                color: #a9afb5;
            }
        </style>
        <title>@yield('title')</title>
    </head>
    <body class="animsition page-error layout-full">
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle">
            <header>
                <h1 class="animation-slide-top">@yield('code')</h1>
                <p>@yield('message')</p>
            </header>
            <a class="btn btn-primary btn-round waves-effect waves-classic" href="{{ route('dashboard') }}">
                {{ __('labels.go_to_home_page') }}
            </a>
        </div>
    </div>
    </body>
</html>
