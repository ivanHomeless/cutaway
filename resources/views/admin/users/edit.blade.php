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
            <li class="last active"><a href="{{ route('admin.users.edit', $item->id) }}">Изменить</a></li>
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
                        <a href="{{ route('admin.users.show', $item->id) }}" class="btn btn-success">Просмотр</a>
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
                        <form method="POST" action="{{ route('admin.users.update', $item->id) }}">
                            @csrf
                            @method("PATCH")

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Логин</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $item->username }}" autocomplete="username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $item->email }}" autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">Роль</label>
                                <div class="col-md-6">
                                    <select name="role" id="role" class="form-control">
                                        @foreach($roles as $id => $title)
                                            <option value="{{ $id }}"
                                                    @if($id == $item->role) selected @endif
                                            >
                                                {{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Статус</label>
                                <div class="col-md-6">
                                    <select name="status" id="status" class="form-control">
                                        @foreach($statuses as $id => $title)
                                            <option value="{{ $id }}"
                                                    @if($id == $item->status) selected @endif
                                            >
                                                {{ $title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div
@endsection
