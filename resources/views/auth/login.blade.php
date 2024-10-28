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
                        <!-- Campo de Email -->
                        <div class="form-group mb-3">
                            <label class="label" for="email">{{ __('Email') }}</label>
                            <input id="email" type="text" class="form-control" name="email"
                                value="{{ old('email') }}" required autofocus>

                            <!-- Exibição do erro de Email -->
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo de Senha com ícone de exibir/ocultar dentro do input -->
                        <div class="form-group mb-3 position-relative">
                            <label class="label" for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                            <!-- Exibição do erro de Senha -->
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-primary mb-0">{{ __('Remember Me') }}
                                    <input id="remember_me" type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <!-- Login Button -->
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
