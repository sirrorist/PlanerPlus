@extends('layouts.app')

@section('title', 'Страница входа')
@section('g_c2', 'active')

@section('naviBar')
@parent
@endsection

@section('content')
<div class="logRegForm">
    <div class="formContent">
        <label><h1>Авторизация</h1></label>
        <form method="POST" action="{{ route('user.login') }}">
            @csrf
            <div class="formItem">
                Логин
                <input class="form-control mr-sm-2" type="text" name="name">
                @error('name')<div class="alert" style="font-size: 10pt; color:rgb(206, 87, 87)">{{ $message }}</div>@enderror
                Пароль
                <input class="form-control mr-sm-2" type="password" name="password"><br>
                @error('password')<div class="alert" style="font-size: 10pt; color:rgb(206, 87, 87)">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-light btn-lg active" type="submit" name="action">Войти</button>
            <a class="btn btn-secondary btn-lg" role="button" href="/register">Нет аккаунта?</a>
        </form>
    </div>
</div>
@endsection

