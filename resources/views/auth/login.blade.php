@extends('layouts.master-login')

@section('title', 'Login - ELPato Panel')

@section('content')
@section('page-title', 'Login - ELPato Panel')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">

                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <br>
                        </div>
                    </div>
                    <form id="login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="label" for="email">{{ __('Email') }}</label>
                            <input id="email" type="text" class="form-control" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 position-relative">
                            <label class="label" for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-primary mb-0">{{ __('Remember Me') }}
                                    <input id="remember_me" type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="img">
                    <img src="{{ asset('/images/Elpatologin.gif') }}" alt="Side Image" width="500px" height="">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


{{-- <form id="login-form" method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <div class="form-group mb-3">
        <label class="label" for="email">{{ __('Email') }}</label>
        <input id="email" type="text" class="form-control" name="email"
            value="{{ old('email') }}" required autofocus autocomplete="off">
        @error('email')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group mb-3 position-relative">
        <label class="label" for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control" name="password" required autocomplete="off">
        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        @error('password')
            <span class="error-message">{{ $message }}</span>
        @enderror
    </div>

    {!! NoCaptcha::renderJs() !!}
    {!! NoCaptcha::display() !!}
    @error('g-recaptcha-response')
        <span class="error-message">{{ $message }}</span>
    @enderror
    <br>

    <div class="form-group d-md-flex">
        <div class="w-50 text-left">
            <label class="checkbox-wrap checkbox-primary mb-0">{{ __('Remember Me') }}
                <input id="remember_me" type="checkbox" name="remember">
                <span class="checkmark"></span>
            </label>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary rounded submit px-3">
            {{ __('Login') }}
        </button>
    </div>
</form>
 --}}
