@extends('layouts.app')

@section('title')
    @parent Скачивание статей
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Скачать новости')}}</div>
                        <div class="card-body">

                        <form action="{{ route('admin.export') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="newsCategory">Выберете категорию новостей</label>
                                <select name="category" id="newsCategory" class="form-control">
                                    @forelse($categories as $item)
                                        <option @if ($item->id == old('category')) selected
                                                @endif value="{{ $item->id }}">{{ $item->title }}</option>
                                    @empty
                                        <option value="0" selected>Нет категории</option>
                                    @endforelse
                                </select>
                            </div>
                                <br>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Скачать новости категории">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
