@extends('layouts.admin')

@section('title')
    @parent Добавление категории
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Добавить категорию')}}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.category.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category_title">Назкание категории</label>
                                <input type="text" name="title" id="categoryTitle" class="form-control" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <label for="categorySlug">Псевдоним категории</label>
                                <input type="text" name="slug" id="categorySlug" class="form-control" value="{{ old('slug') }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Добавить категорию">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
