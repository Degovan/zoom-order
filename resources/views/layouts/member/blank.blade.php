<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="/vendor/voler/css/bootstrap.css">
    <link rel="stylesheet" href="/vendor/voler/css/app.css">
    @stack('style');
</head>
<body style="background: #dcdcdc;">
    <div id="blank">
        @yield('content')
    </div>
    <script src="/vendor/voler/js/feather-icons/feather.min.js"></script>
    <script src="/vendor/voler/js/app.js"></script>
    <script src="/vendor/voler/js/main.js"></script>
    @stack('script');
</body>
</html>
