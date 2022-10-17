@extends('layouts.app')

@section('title')
    @parent Главная Вход
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h2>'Добро пожаловать в агрегатор новостей, {{ Auth::user()->name }}!'</h2></div>
                    @include('inc.message')
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('Вы вошли в систему') }}
                        </div>
                    <div class="card-body">

                        <a class="btn btn-primary btn-sm float-start " href="{{ route('account.update') }}" role="button">
                            Редактировать профиль
                        </a>
                        @if(\Auth::user()->isAdmin)
                        <a class="btn btn-primary btn-sm float-end " href="{{ route('admin.index') }}" role="button">
                            Перейти в админ панель
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
