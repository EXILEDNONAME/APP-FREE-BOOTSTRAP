<head>
    <base href="../../">
    <title> {{ \DB::table('system_settings')->first()->application_name; }} - @yield('title') </title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="follow, index" name="robots" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta content="title" name="EXILEDNONAME" />
    <link href="https://exilednoname.com" rel="canonical" />
    <link href="{{ env('APP_URL') }}/favicon.png" rel="shortcut icon" />
    <link rel="stylesheet" href="{{ env('APP_URL') }}/assets/backend/mix/css/app-core.css" />
    @stack('head')
</head>