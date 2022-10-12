@extends('layouts.admin')

@section('title')
    @parent Редактирование статьи
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Редактировать статью')}}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.news.update', ['news' => $news]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="newsTitle">Заголовок новости</label>
                                <input type="text" name="title" id="newsTitle" class="form-control" value="{{ $news->title }}">
                            </div>
                            <div class="form-group">
                                <label for="newsCategory">Категория новости</label>
                                <select name="category_id" id="newsCategory" class="form-control">
                                    <option value="0" selected>Выбрать категорию</option>
                                    @foreach($categories as $item)
                                        <option @if ($item->id == $news->category_id) selected
                                                @endif value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="newsText">Текст новости</label>
                                <textarea name="text" id="newsText" class="form-control">{{ $news->text }}</textarea>
                            </div>
                            <div class="form-check">
                                <p>Новость приватна?</p>
                                <label for="isPrivateYes"> Да
                                    <input @if( $news->isPrivate === 1 ) checked @endif id="isPrivateYes" name="isPrivate"
                                           type="radio" value="1" class="form-check-input">
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="isPrivateNo"> Нет
                                    <input @if( $news->isPrivate === 0 ) checked @endif id="isPrivateNo" name="isPrivate"
                                           type="radio" value="0" class="form-check-input">
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Обновить новость">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
