@extends('layouts.admin')
@section('content')

    @php
        /**
        * @var \App\Models\User $item
        */
                $url = URL::to('/') . '/' . $item->hash;
    @endphp

    <div class="container">

        <ul class="breadcrumbs mb-3">
            <li class="first">
                <a href="{{ route('admin.dashboard') }}" class="icon-home">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                    </svg>
                </a>
            </li>
            <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
            <li class="last active"><a href="{{ route('admin.users.show', $item->id) }}">Просмотр</a></li>
        </ul>

        @if(session('success'))
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-warning">Изменить</a>
                        <button type="button" class="btn delete btn-danger"
                                onclick="
                                            let result = confirm('Вы уверены?');if (result) $(this).siblings('form').submit()"
                        >
                            Удалить
                        </button>
                        <form method="POST" action="{{ route('admin.users.destroy', $item->id) }}">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>#</strong></div>
                                    <div class="col-6">
                                        {{ $item->id }}
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>Ссылка:</strong></div>
                                    <div class="col-6">
                                        <a target="_blank" href="{{$url}}" class="card-link">{{$url}}</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>Логин:</strong></div>
                                    <div class="col-6">
                                        {{ $item->username }}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>Email:</strong></div>
                                    <div class="col-6">
                                        {{ $item->email }}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>Хэш:</strong></div>
                                    <div class="col-6">
                                        {{ $item->hash }}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>Роль:</strong></div>
                                    <div class="col-6">
                                        {{ $roles[$item->role] }}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2"><strong>Статус:</strong></div>
                                    <div class="col-6">
                                        {{ $statuses[$item->status] }}
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-3"><strong>Дата создания:</strong></div>
                                    <div class="col-6">
                                        {{ $item->created_at }}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-3"><strong>Дата обновления:</strong></div>
                                    <div class="col-6">
                                        {{ $item->updated_at }}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div
@endsection
