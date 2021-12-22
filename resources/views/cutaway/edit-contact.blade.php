@extends('layouts.app')
@section('content')
    @php
        /**
        * @var \App\Models\Contact $contact
        * @var \App\Models\Profile $profile
        */

    @endphp

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                    @csrf

                    <div class="card cutaway">
                        <div class="cutaway-edit card-title">
                            <button style="background: none; border: none" type="button" class=""
                                    onclick="
                                            let result = confirm('Вы уверены?');if (result) $(this).siblings('form').submit()"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                            <form method="POST" action="{{ route('edit.delete-contact', [$contact->profile_id, $contact->slug])}}">
                                @method('DELETE')
                                @csrf
                            </form>

                            <button onclick="$('#edit-contact').submit()" type="submit"  class="ml-auto cutaway-edit-link cutaway-btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="card-body">

                            <form id="edit-contact" method="POST" action="{{ route('edit.edit-contact', [$contact->profile_id, $contact->slug]) }}" enctype="multipart/form-data">
                                @csrf
                            <div class="cutaway-info mb-4">

                                <div class="cutaway-info-name cutaway-info-form">
                                    <div class="form-group">
                                        <label for="link" class="col-md-12 col-form-label">
                                            Ссылка <br>
                                            {{ $contactOrigin->main_text }}. Например, {{ $contactOrigin->example }}

                                        </label>

                                        <input placeholder="{{ $contactOrigin->example }}" id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ $contact->link }}" autocomplete="link">

                                        @error('link')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="cutaway-info-name cutaway-info-form">
                                    <div class="form-group">
                                        <label for="text" class="col-md-12 col-form-label">Текст кнопки</label>

                                        <input id="text" type="text" class="form-control @error('text') is-invalid @enderror" name="text" value="{{ $contact->text }}" autocomplete="text">

                                        @error('text')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                                </div>
                            </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

