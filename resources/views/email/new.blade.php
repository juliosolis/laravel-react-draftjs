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
                        Create new Email
                        <a href="{{ route('email') }}" class="btn btn-outline-info float-right">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Return
                        </a>
                    </div>

                    <div class="card-body">

                        <div id="editor"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
