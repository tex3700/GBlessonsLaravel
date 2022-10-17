@extends('layouts.admin')

@section('title')
    @parent Редактор профиля пользователя
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__( $title_page)}}</div>
                    @include('inc.message')
                    <div class="card-body">

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
{{--                            <div class="form-group">--}}
{{--                                <input type="password" name="password" id="password" class="form-control" placeholder="Текущий пароль">--}}
{{--                            </div>--}}
{{--                            <br>--}}
                            <div class="form-group">
                                <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Новый пароль">
                            </div>
                            <br>
                            <div class="form-check">
                                <label for="isAdmin">Администратор?</label>
                                <fieldset id="isAdmin">
                                    <label for="isAdminYes"> Да
                                        <input @if( $user->isAdmin == "1" ) checked @endif id="isAdminYes" name="isAdmin"
                                               type="radio" value="1" class="form-check-input">
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="isAdminNo"> Нет
                                        <input @if( $user->isAdmin == "0" ) checked @endif id="isAdminNo" name="isAdmin"
                                               type="radio" value="0" class="form-check-input">
                                    </label>
                                </fieldset>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Обновить профиль пользователя">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
