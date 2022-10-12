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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $news->title }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if(!is_null($news))

                                @if (!$news->isPrivate)
                                    <p>{{ $news->text }}</p>
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
