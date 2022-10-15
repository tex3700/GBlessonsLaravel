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
                                            <a href="{{ route('admin.category.edit', ['category' => $category]) }}">
                                                Редактировать</a>
                                            <br>
                                            <a href="javascript:;" class="delete" rel="{{ $category->id }}">
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
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let elements = document.querySelectorAll(".delete");
            elements.forEach(function(element, key) {
                element.addEventListener("click", function () {
                    const id = element.getAttribute('rel');
                    if (confirm('Уверены что хотите удалить запись с #ID = '+id)) {
                        send(`/admin/category/destroy/${id}`).then(() => {
                            location.reload();
                        });
                    } else {
                        alert('Удаление отменено');
                    }
                })
            });
        });

        async function send(url) {
            let response = await fetch(url, {
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
            });
            let result = await response.json();
            return result;
        }
    </script>
@endpush
