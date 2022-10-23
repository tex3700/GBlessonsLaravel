@extends('layouts.admin')

@section('title')
    @parent Редактор статьи
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

                        <form action="{{ route( $route, ['news' => $news]) }}" method="post">
                            @csrf
                            @if($news->id) @method('PUT') @endif
                            <div class="form-group">
                                <label for="news_title">Заголовок новости</label>
                                <input type="text" name="title" id="newsTitle" class="form-control" value="{{ $news->title }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="newsCategory">Категория новости</label>
                                <select name="category_id" id="newsCategory" class="form-control">
                                    <option value="0" selected>Выбрать категорию</option>
                                    @foreach($categories as $category)
                                        <option @if ($category->id == $news->category_id) selected
                                                @endif value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="newsText">Текст новости</label>
                                <textarea name="text" id="newsText" class="form-control">{{ $news->text }}</textarea>
                            </div>
                            <br>
                            <div class="form-check">
                                <label for="isPrivate">Приватность</label>
                                <fieldset id="isPrivate">
                                <label for="isPrivateYes"> Да
                                    <input @if( $news->isPrivate == "1" ) checked @endif id="isPrivateYes" name="isPrivate"
                                           type="radio" value="1" class="form-check-input">
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="isPrivateNo"> Нет
                                    <input @if( $news->isPrivate == "0" ) checked @endif id="isPrivateNo" name="isPrivate"
                                           type="radio" value="0" class="form-check-input">
                                </label>
                                </fieldset>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary"
                                       @if($news->id) value="Обновить новость"
                                       @else value="Добавить новость"
                                       @endif>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
