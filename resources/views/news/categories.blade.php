@extends('layouts.app')

@section('title')
    @parent Категории
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
                        <h1>Категории новостей!</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @forelse($categories as $item)

                                <a href="{{route('news.category.show', $item->slug)}}">
                                    <h3>{{$item->title}}</h3></a>
                                <br>
                            @empty
                                Нет категорий
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

