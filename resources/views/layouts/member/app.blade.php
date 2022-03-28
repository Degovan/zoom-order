<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="/vendor/voler/css/bootstrap.css">
    <link rel="stylesheet" href="/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/vendor/voler/css/app.css">
    @stack('style')
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            @include('layouts.member.sidebar')
        </div>
        <div id="main">
        
            @include('layouts.member.topbar')

            @yield('content')

            @include('layouts.member.footer')
        </div>
    </div>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/voler/js/feather-icons/feather.min.js"></script>
    <script src="/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/vendor/voler/js/app.js"></script>
    <script src="/vendor/voler/js/main.js"></script>
    <x-sweetalert/>
    @stack('script')
</body>
</html>
