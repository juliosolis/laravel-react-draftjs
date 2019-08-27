@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/rich-editor.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Edit Email: "{{ $email->subject }}"
                        <a href="{{ route('email') }}" class="btn btn-outline-info float-right">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Return
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="emailUpdate" data-id="{{ $email->id }}"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
