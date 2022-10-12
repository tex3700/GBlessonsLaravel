@extends('layouts.admin')

@section('title')
    @parent Категории новостей
@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @include('inc.message')
                    <div class="card-header">
                        <h2>Список категорий новостей</h2>
                        <a class="btn btn-primary btn-sm float-end " href="{{ route('admin.category.create') }}" role="button">
                            Добавить категорию
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped table-sm">

                                <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Слаг</th>
                                    <th scope="col">Управление</th>
                                </tr>

                                </thead>
                                <tbody>
                                @forelse($categoryList as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category) }}">
                                                Редактировать</a>
                                            <br>
                                            <a href="{{ route('admin.category.destroy', $category) }}">
                                                Удалить</a>
                                        </td>
                                    </tr>
                                @empty
                                    "Нет категорий"
                                @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>
                    {{ $categoryList->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
