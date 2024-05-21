@extends('layouts.master')

@section('title', 'Login & Logout Logs')

@section('content')
@section('page-title', 'Login & Logout Logs')

<div class="content-wrapper">
    <div class="content">
        <div class="col-lg-7 col-xxl-12">
            <!-- Chat -->
            <div class="card card-default chat-right-sidebar">
                <div class="card-header">
                    <h2>Login & Logout Logs</h2>
                </div>

                <div class="card-body" data-simplebar style="height: 620px;">
                    <ul>
                        @foreach ($logs->reverse() as $log)
                            <li>{{ $log }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
