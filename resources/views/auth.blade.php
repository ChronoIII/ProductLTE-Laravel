<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('includes.styles')
</head>

<body class="hold-transition layout-top-nav">
    <div id="auth"></div>

    @include('includes.scripts')
    <script src="{{ mix('js/auth.js') }}"></script>
</body>
</html>
