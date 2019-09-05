@extends('layouts.app2')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/rich-editor.css') }}">
@endpush

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Email: "{{ $email->subject }}"</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('email') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Return
                </a>
            </div>
        </div>
    </div>

    <div id="editor" data-id="{{ $email->id }}"></div>
@endsection
