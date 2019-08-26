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

                        @if(count($emails))
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emails as $email)
                                    <tr>
                                        <td>{{ $email->subject }}</td>
                                        <td>{{ $email->created_at->isoFormat('dddd D, MMM YYYY') }}</td>
                                        <td>
                                            <form action="{{ route('email.delete') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $email->id }}">
                                                <button class="btn btn-link" type="submit">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>You got no emails</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
