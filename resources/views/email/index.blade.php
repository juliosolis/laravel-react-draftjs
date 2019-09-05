@extends('layouts.app2')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('email.new') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    New Email
                </a>
                {{--<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
            </div>
            {{--<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>--}}
        </div>
    </div>

    <h2>Emails sent</h2>

    @if(count($emails))
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
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
                            <a href="{{ route('email.edit',[$email]) }}">Edit</a> |
                            <form style="display: inline-block" action="{{ route('email.delete') }}" method="post">
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
        </div>
    @else
        <p>You got no emails</p>
    @endif
@endsection
