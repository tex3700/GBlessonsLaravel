@extends('layouts.app')

@section('title')
    @parent Авторизация
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

<div class="container text-center">
    <div class="row">
        <h1>Точка входа для админа</h1>
        <form method="post" class="sign-in-form mt-5 mt-md-5 col-lg-4 col-md-5 col-sm-8">
            <h3>Авторизация</h3>
            <label for="username" class="visually-hidden">Логин</label>
            <input type="text" id="username" name="username" class="form-control mt-3" placeholder="Логин" required="" autofocus="">
            <label for="password" class="visually-hidden">Пароль</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Пароль" required="">
            <label class="visually-visible">Запомнить меня
            <input type="checkbox" id="checkbox" name="checkbox" class="checkbox">
            </label>
            <button class="w-75 btn btn-lg btn-primary mt-1" type="submit">Войти</button>
            <div class="mt-3">
                <a href="/">Назад</a>
            </div>
        </form>
    </div>
</div>

@endsection
