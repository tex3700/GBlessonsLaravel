@extends('layouts.app')

@section('title')
    @parent Новости
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
                        <h1>Hовости</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @forelse($news as $item)

                                <h3>{{$item['title']}}</h3>

                                    @if(!$item['isPrivate'])
                                        <a href="{{route('news.single', $item['id'])}}">Подробнее ...</a><br>
                                   @endif

                                @empty
                                Нет новостей
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

