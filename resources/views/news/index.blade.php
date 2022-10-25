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
            <div class="col-md-12">
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
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                            <img src="
                                        @if(is_null($item->image)) {{ asset("storage/1.jpg") }}
                                        @elseif(str_starts_with($item->image, "h")) {{ $item->image }}
                                        @else {{ asset("storage/$item->image") }}
                                        @endif " width="100" height="80" alt="img">
                                    </div>

                                <div class="flex-grow-1 ms-3">
                                <h3>{{$item->title}}</h3>

                                @if(!\Auth::check() && $item->isPrivate)
                                          <a href="{{route('login')}}">Доступно только авторизированным пользователям</a><br>
                                    @else <a href="{{route('news.show', $item->id)}}">Подробнее ...</a><br>
                                @endif
                                    <br>
                                </div>
                            </div>
                                @empty
                                Нет новостей
                            @endforelse

                    </div>
                </div>
                {{ $news->links() }}
            </div>
        </div>
    </div>

@endsection

