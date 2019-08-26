@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Emails
                        <a href="{{ route('email.new') }}" class="btn btn-success float-right">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            New Email
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Some Subject</td>
                                <td>Some Subject</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <div id="example"></div>--}}
    <div id="editor"></div>

@endsection
