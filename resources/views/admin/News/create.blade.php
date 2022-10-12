@extends('layouts.admin')

@section('title')
    @parent Добавление статьи
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Добавить новость')}}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.news.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="news_title">Заголовок новости</label>
                                <input type="text" name="title" id="newsTitle" class="form-control" value="{{ old('title') }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="newsCategory">Категория новости</label>
                                <select name="category_id" id="newsCategory" class="form-control">
{{--                                    <option value="0" selected>Выбрать категорию</option>--}}
                                    @foreach($categories as $item)
                                        <option @if ($item->id == old('category_id')) selected
                                                @endif value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="newsText">Текст новости</label>
                                <textarea name="text" id="newsText" class="form-control">{{ old('text') }}</textarea>
                            </div>
                            <br>
                            <div class="form-check">
                                    <p>Новость приватна?</p>
                                <label for="isPrivateYes"> Да
                                    <input @if(old('isPrivate') === "1") checked @endif id="isPrivateYes" name="isPrivate"
                                           type="radio" value="1" class="form-check-input">
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label for="isPrivateNo"> Нет
                                    <input @if(old('isPrivate') === "0") checked @endif id="isPrivateNo" name="isPrivate"
                                           type="radio" value="0" class="form-check-input">
                                </label>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Добавить новость">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
