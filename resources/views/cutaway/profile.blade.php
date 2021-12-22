@extends('layouts.app')
@section('content')

    @php
        /**
        * @var \App\Models\Profile $profile
        */

    @endphp

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-5">
                <form method="POST" action="{{ route('edit.profile', $profile->id) }}" enctype="multipart/form-data">
                    @csrf

                <div class="card cutaway">
                    <div class="cutaway-edit card-title">
                        <a href="{{ route('edit', $profile->id) }}" class="cutaway-edit-link ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                            </svg>
                        </a>
                        <button type="submit"  class="ml-auto cutaway-edit-link cutaway-btn-save">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="cutaway-avatar m-auto row">
                            <div>
                                @if ($profile->user_img)
                                    <img src="{{ asset($profile->user_img) }}" alt="">
                                @else
                                    <img src="{{ asset('user_img/no_img.png') }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="row cutaway-avatar-upload mt-1 mb-1">
                            <div class="form-group col-md-12">

                                <input id="user_img" type="file" class="form-control @error('user_img') is-invalid @enderror" name="user_img">
                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="cutaway-info mb-4">
                            <div class="cutaway-info-name cutaway-info-form">
                                <div class="form-group">
                                    <label for="name" class="col-md-12 col-form-label">Имя</label>

                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $profile->name }}" autocomplete="name">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                </div>
                            </div>

                            <div class="cutaway-info-description cutaway-info-form">
                                <div class="form-group">
                                    <label for="description" class="col-md-12 col-form-label">Описание</label>

                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $profile->description }}" autocomplete="description">

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="cutaway-info-url cutaway-info-form">
                                <div class="form-group">
                                    <label for="username" class="col-md-12 col-form-label">Адрес страницы</label>

                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $profile->user->username }}" autocomplete="user.username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

