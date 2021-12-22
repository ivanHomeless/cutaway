@extends('layouts.admin')
@section('content')

    <div class="container">

        <ul class="breadcrumbs mb-3">
            <li class="first">
                <a href="{{ route('admin.dashboard') }}" class="icon-home">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                    </svg>
                </a>
            </li>
            <li><a href="{{ route('admin.cutaway.contacts.index') }}">Контакты</a></li>
            <li class="last active"><a href="{{ route('admin.cutaway.contacts.create') }}">Добавить</a></li>
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
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.cutaway.contacts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">Лого</label>
                                <div class="col-md-6">
                                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                                    @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Название</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="background_color" class="col-md-4 col-form-label text-md-right">Цвет фона</label>
                                <div class="col-md-6">
                                    <input id="background_color" type="color" class="form-control @error('background_color') is-invalid @enderror" name="background_color" value="#0B4EEA">
                                    @error('background_color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="color" class="col-md-4 col-form-label text-md-right">Цвет теста</label>
                                <div class="col-md-6">
                                    <input id="color" type="color" class="form-control @error('color') is-invalid @enderror" name="color" value="#FFFFFF">
                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="main_link" class="col-md-4 col-form-label text-md-right">Ссылка</label>
                                <div class="col-md-6">
                                    <input id="main_link" type="text" class="form-control @error('main_link') is-invalid @enderror" name="main_link" value="" autocomplete="main_link">

                                    @error('main_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="main_text" class="col-md-4 col-form-label text-md-right">Текст</label>
                                <div class="col-md-6">
                                    <input id="main_text" type="text" class="form-control @error('main_text') is-invalid @enderror" name="main_text" value="" autocomplete="main_link">

                                    @error('main_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example" class="col-md-4 col-form-label text-md-right">Пример ввода</label>
                                <div class="col-md-6">
                                    <input id="example" type="text" class="form-control @error('example') is-invalid @enderror" name="example" value="" autocomplete="example">

                                    @error('example')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
