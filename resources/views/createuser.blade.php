@extends('layouts.master')

@section('title', 'Create User')

@section('content')
@section('page-title', 'Create User')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Create User</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('createuser.store') }}">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="example@elpato.com" required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="telegram">Telegram</label>
                                        <input type="text" name="telegram" id="telegram" class="form-control"
                                            placeholder="Telegram" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="type">Role</label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="worker" selected>Worker</option>
                                            <option value="general">General</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email_verified_at">Create Check</label>
                                        <input type="datetime" name="email_verified_at" id="email_verified_at"
                                            class="form-control" placeholder="Create Check" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input class="g-recaptcha" type="hidden" id="recaptchaToken" name="recaptchaToken">
                    <button type="submit" class="btn btn-primary">Create User</button>
                    <a href="{{ route('user.all') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://www.google.com/recaptcha/api.js?render=6LfIvMMpAAAAAMyq68S6_XTjd_bJnZopR1brbTSY"></script>
@push('scripts')
<script src="{{ asset('js/typeuser.js') }}"></script>
@endpush
