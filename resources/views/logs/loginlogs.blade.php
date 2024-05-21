@extends('layouts.master')

@section('title', 'Login & Logout Logs')

@section('content')
@section('page-title', 'Login & Logout Logs')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <h1>Login & Logout Logs</h1>
                <br>
                <ul>
                    @foreach ($logs as $log)
                        <li>{{ $log }}</li>
                    @endforeach
                </ul>
                <br>
                <a href="{{ route('adminpainel') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
