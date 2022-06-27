@extends('layouts.app')

@section('title', 'Страница регистрации')
@section('g_c3', 'active')

@section('naviBar')
@parent
@endsection

@section('content')
<div class="logRegForm">
    <div class="formContent">
        <label><h1>Регистрация</h1></label>
        <form method="POST" action="{{ route('user.register') }}">
            @csrf
            Логин
            <input class="form-control mr-sm-2" type="text" name="name">
            @error('name')<div style="font-size: 10pt; color:rgb(206, 87, 87)">Поле Пароль обязательно к закоплению</div>@enderror
            Пароль
            <input class="form-control mr-sm-2" type="password" name="password">
            @error('password')<div style="font-size: 10pt; color:rgb(206, 87, 87)">Поле Пароль обязательно к закоплению</div>@enderror
            Имя
            <input class="form-control mr-sm-2" type="text" name="firstName">
            @error('firstName')<div style="font-size: 10pt; color:rgb(206, 87, 87)">Поле Имя обязательно к закоплению</div>@enderror
            Фамилия
            <input class="form-control mr-sm-2" type="text" name="lastName">
            @error('lastName')<div style="font-size: 10pt; color:rgb(206, 87, 87)">Поле Фамилия обязательно к закоплению</div>@enderror
            Отчество
            <input class="form-control mr-sm-2" type="text" name="middleName" placeholder="Не обязательно"><br>
            <button class="btn btn-light btn-lg active" type="submit" name="action">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection


