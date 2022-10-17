@extends('layouts.app')

@section('title')
    @parent Редактор профиля
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__( $title_page)}}</div>
                    @include('inc.message')
                    <div class="card-body">
                        @if(Session::has('MSG'))
                            <div class="alert alert-success">
                                {{ Session::get('MSG') }}
                            </div>
                        @endif
                        <form action="{{ route( $route, ['user' => $user]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Имя пользователя</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">E-Mail пользователя</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Текущий пароль">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Новый пароль">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Обновить профиль пользователя">
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Забыли пароль?') }}
                                </a>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
