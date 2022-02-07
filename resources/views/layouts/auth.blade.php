<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#5777ba" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <meta content="Money App" name="description">
    <meta property="og:description" content="Money App" >
    <meta property="og:title" content="@yield('title') - Money App" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{\URL::current()}}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/css/auth.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body class="bg-blue">
    <div id="app" class="flex-center position-ref full-height text-center">
        <main class="py-4">
        <a href="/"><img src="{{env('WHITE_LOGO_FILE')}}" alt="{{env('APP_NAME')}}" width="200"></a>
            @yield('content')
        </main>
    </div>
</body>
</html>
<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@yield('script')