@extends('layouts.admin')

@section('title')
    @parent Новости
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
                        <h2>Список новостей</h2>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped table-sm">

                                <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Заголовок</th>
                                    <th scope="col" style="width: 40%; text-align: center">Текст</th>
                                    <th scope="col">Приват- ность</th>
                                    <th scope="col">Дата добавления</th>
                                    <th scope="col">Управление</th>
                                </tr>

                                </thead>
                                <tbody>
                                @forelse($newsList as $news)
                                <tr>
                                    <td>{{ $news->id }}</td>
                                    <td>{{ $news->category->title }}</td>
                                    <td>{{ $news->title }}</td>
                                    <td>
                                        <p>
                                            <a class="btn btn-primary" data-bs-toggle="collapse"
                                               href="#collapseTextNews" role="button"
                                               aria-expanded="false" aria-controls="collapseExample">
                                                Читать текст
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseTextNews">
                                            <div class="card card-body">
                                                {{ $news->text }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $news->isPrivate }}</td>
                                    <td>{{ $news->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.news.edit', $news) }}">
                                            Редактировать</a>
                                        <br>
                                        <a href="{{ route('admin.news.destroy', $news) }}">
                                            Удалить</a>
                                    </td>
                                </tr>
                                @empty
                                    "Нет новостей"
                                @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>
                    {{ $newsList->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
