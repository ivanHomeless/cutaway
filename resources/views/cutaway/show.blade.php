@extends('layouts.app')
@section('content')

    @php
        /**
        * @var \App\Models\User $user
        */

    @endphp

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card cutaway">
                    <div class="cutaway-edit card-title">
                    @if(Auth::check() && $canEdit)
                        <a href="" class="cutaway-edit-link ml-3" title="Выйти"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg>
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        <a href="{{ route('edit', $user->profile->id) }}" class="ml-auto cutaway-edit-link" title="Профиль">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </a>
                    @else
                         <a href="{{ route('login') }}" class="ml-auto cutaway-edit-link">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                 <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                 <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                             </svg>
                         </a>
                    @endif
                    </div>

                    <div class="card-body">
                        <div class="cutaway-avatar m-auto row">
                            <div>
                                @if ($user->profile->user_img)
                                    <img src="{{ asset($user->profile->user_img) }}" alt="">
                                @else
                                    <img src="{{ asset('user_img/no_img.png') }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="cutaway-info mb-4">
                            <div class="cutaway-info-name">
                                {{ $user->profile->name }}
                            </div>
                            <div class="cutaway-info-description">
                                {{ $user->profile->description }}
                            </div>
                        </div>

                        <div class="contacts show-page">
                            <contact-buttons :movable="false" :contacts="{{ $user->profile->contacts->toJson() }}"></contact-buttons>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div
@endsection
