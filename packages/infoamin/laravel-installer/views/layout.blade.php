<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>JaykaApp installer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('dist/installer/assets/fonts/icon.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('dist/installer/assets/installer.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/installer/assets/installer-style.css')}}">
        @yield('style')
    </head>
    <body>
        @yield('content')
        <script type="text/javascript" src="{{ url('dist/installer/assets/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ url('dist/installer/assets/installer.min.js') }}"></script>
        @yield('script')
    </body>
</html>