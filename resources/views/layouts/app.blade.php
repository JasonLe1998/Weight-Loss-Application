<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ secure_asset('css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        
        <title>{{config('app.name','laravel')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
    </head>
<body> 
    
    @include('inc.header')
    @include('inc.navbar')
    <div class = "container">
        @include('inc.messages')
        @yield('content')
    </div>

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset = "utf-8"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>