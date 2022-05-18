<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard </title>
    <!-- Styles -->
    <link  rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div id="root"></div>

    <script defer src="{{ asset('js/Dashboard.js') }}"></script>
</body>

</html>
