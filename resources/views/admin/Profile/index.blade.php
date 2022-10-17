@extends('layouts.admin')

@section('title')
    @parent Профили
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
                        <h2>Список пользователей</h2>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped table-sm">

                                <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Админ</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Дата регистрации</th>
                                    <th scope="col">Пароль</th>
                                    <th scope="col">Управление</th>
                                </tr>

                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->isAdmin }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->password }}</td>
                                        <td>
                                            <a href="{{ route('admin.profile.update', ['user' => $user]) }}">
                                                Редактировать</a><br>
                                           <div class="@if($user->isAdmin) visually-hidden @endif">
                                            <a href="javascript:;" class="delete" rel="{{ $user->id }}">
                                                Удалить</a>
                                           </div>
                                        </td>
                                    </tr>
                                @empty
                                    "Нет таких пользователей"
                                @endforelse

                                </tbody>

                            </table>
                        </div>
                    </div>
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
                    if (confirm('Уверены что хотите удалить пользователя с #ID = '+id)) {
                        send(`/admin/profile/destroy/${id}`).then(() => {
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
