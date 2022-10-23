@extends('layouts.app')

@section('title')
    @parent Новость
@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $news->title }}</h2>
                    </div>

                    <div class="card-img align-self-md-auto">
                        <img src="{{ is_null($news->image) ? asset("storage/1.jpg") : $news->image }}"
                             width="400" height="300" alt="img">
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if(!is_null($news))

                                @if (!$news->isPrivate || \Auth::check())
                                    <p>{{ $news->text }}</p>

                                    @if(!is_null($news->link))
                                        <a href="{{ $news->link }}" target="_blank">Посмотреть новость в источнике</a>
                                    @endif
                                <br>
                                    <p>Новость опубликована: &nbsp;
                                    @if(!is_null($news->pubDate)) {{ $news->pubDate }}
                                        @else {{ $news->cerated_at }}
                                        @endif
                                    </p>
                                @else
                                    Зарегистрируйтесь для просмотра
                                @endif

                            @else
                                <p>Нет новости с таким id</p>
                            @endif
                    </div>
                    @include('inc.message')
                </div>
            </div>
        </div>
    </div>


@endsection
