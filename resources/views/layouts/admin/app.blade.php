<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="stylesheet" href="/vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/vendor/notyf/notyf.min.css">
    <link rel="stylesheet" href="/vendor/volt/volt.css">
    @stack('style')
</head>
<body>
    @include('layouts.admin.nav')

    <main class="content">
        @include('layouts.admin.topbar')

        @yield('content')

        @include('layouts.admin.footer')
    </main>

    @include('layouts.admin.script')
    @stack('script')
</body>
</html>
