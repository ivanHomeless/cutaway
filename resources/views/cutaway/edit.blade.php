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
                <div class="card cutaway">
                    <div class="cutaway-edit card-title">
                        <a href="{{ route('edit.profile', $profile->id) }}" class="cutaway-edit-link ml-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                        <a href="{{ url('/'. $profile->user->username) }}" class="ml-auto cutaway-edit-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </a>
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
                        <div class="cutaway-info mb-1">

                            <div class="cutaway-info-name">
                                {{ $profile->name }}
                            </div>
                            <div class="cutaway-info-description">
                                {{ $profile->description }}
                            </div>

                        </div>
                        <div class="m-auto justify-content-center row">
                            @if($profile->contacts)
                                <add-button :profile_id="{{ $profile->id  }}" :contacts="{{ $contacts->toJson() }}"></add-button>
                            @endif
                        </div>
                        <div class="contacts show-page mt-3">
                            <contact-buttons :movable="true" :contacts="{{ $profile->contacts->toJson() }}"></contact-buttons>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
