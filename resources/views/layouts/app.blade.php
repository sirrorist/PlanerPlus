<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset("css/normalize.css") }}" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <style>body{font-family: 'Nunito', sans-serif;  background-color: antiquewhite;}</style>
</head>
<body>
    @section('naviBar')
    @guest
    <nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 9px">
        <a class="navbar-brand" href="/">Planer +</a>
        <div class="navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link @yield('g_c1')" href="/">Главная</a>
            <a class="nav-item nav-link @yield('g_c2')" href="{{ route('user.login') }}">Вход</a>
            <a class="nav-item nav-link @yield('g_c3')" href="{{ route('user.register') }}">Регистрация</a>
            </div>
        </div>
    </nav>
    @endguest
    @auth
    <nav class="navbar navbar-expand-lg navbar-light" style="margin-left: 9px">
        <a class="navbar-brand" href="/">Planer +</a>
        <div class="navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link @yield('a_c1')" href="/">Главная</a>
                <a class="nav-item nav-link @yield('a_c2')" href="{{ route('user.tasks') }}">Задачи <span class="sr-only"></span></a>
                <a class="nav-item nav-link @yield('a_c3')" href="{{ route('user.report') }}">Отчёты</a>
                <a class="nav-item nav-link @yield('a_c4')" href="{{ route('user.chat') }}">Чат</a>
                <a class="nav-item nav-link @yield('a_c5')" href="{{ route('user.logout') }}">Выход</a>
            </div>
        </div>
    </nav>
    @endauth
    @show
    <div class="container">
        @yield('content')
    </div>
</body>
</html>