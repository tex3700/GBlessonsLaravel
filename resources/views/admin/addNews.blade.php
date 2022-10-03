@extends('layouts.app')

@section('title')
    @parent Добавление статьи
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

<div class="container text-center">
    <div class="row">
        <h1>Страница добавления новости</h1>
        <form method="post" class="sign-in-form mt-5 mt-md-5 col-lg-4 col-md-5 col-sm-8">

            <label class="visually-visible">Название новости</label>
            <input type="text" id="newsName" name="newsName" class="form-control mt-3">
            <br>
            <label class="visually-visible">Подробное описание новости</label>
            <textarea type="text" id="fullDescription" name="fullDescription" class="form-control mt-9"></textarea>
            <br>
            <label class="visually-visible">Краткое описание новости</label>
            <input type="text" id="shortDescription" name="shortDescription" class="form-control mt-3">
            <br>

            <button class="w-75 btn btn-lg btn-primary mt-1" type="submit">Добавить новость</button>

        </form>
    </div>
</div>

@endsection
