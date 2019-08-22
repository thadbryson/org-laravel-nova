<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Life Dash') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">

    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="/fontawesome-pro-5.9.0-web/css/all.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    @if ($theme !== 'default')
        <link href="{{ asset('css/themes/' . $theme . '.css') }}" rel="stylesheet" type="text/css">
    @endif
</head>
<body>
    <script>

        const CONFIG = '{!! json_encode($config) !!}';

    </script>
    <script src="/js/app.js"></script>
</body>
</html>
