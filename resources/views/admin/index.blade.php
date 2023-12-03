@extends('layouts.admin')

@section('title')
    @parent Админ панель
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h2>'Добро пожаловать в админ панель, {{ Auth::user()->name }}!'</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Некоторый текст') }}
                            <li class="btn btn-dark">
                                <a class="nav-link" href="{{route('admin.parser')}}">Парсинг новосных каналов</a>
                            </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
