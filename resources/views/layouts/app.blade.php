<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ @$title}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" {{-- defer --}}></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('inc.sidebar')           
        <!-- Page Content  -->
        <div id="content">
            @include('inc.pesan')
            @include('inc.modal')
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
