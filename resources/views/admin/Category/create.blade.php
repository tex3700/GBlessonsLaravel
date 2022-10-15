@extends('layouts.admin')

@section('title')
    @parent Редактор категории
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__( $title )}}</div>
                    @include('inc.message')
                    <div class="card-body">

                        <form action="{{ route( $route, [ 'category' => $category ]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category_title">Назкание категории</label>
{{--                                @error('title') <span style="color: red";>{{ $message }}</span> @enderror--}}
                                <input type="text" name="title" id="categoryTitle" class="form-control" value="{{ $category->title }}">
                            </div>

                            <div class="form-group">
                                <label for="categorySlug">Псевдоним категории</label>
{{--                                @error('slug') <span style="color: red";>{{ $message }}</span> @enderror--}}
                                <input type="text" name="slug" id="categorySlug" class="form-control" value="{{ $category->slug }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"
                                       @if($category->id) value="Обновить категорию"
                                       @else value="Добавить категорию"
                                       @endif>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
