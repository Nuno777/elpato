{{-- <style>
    #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #loader img {
        width: 250px;
        height: 250px;
    }

    #loader img {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .custom-button {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        /* equivalente a px-4 py-2 */
        background-color: #12871A !important;
        /* bg-gray-800 */
        border: 1px solid transparent;
        border-radius: 0.375rem;
        /* rounded-md */
        font-weight: 600;
        /* font-semibold */
        font-size: 0.75rem;
        /* text-xs */
        color: #fff;
        /* text-white */
        text-transform: uppercase;
        /* uppercase */
        letter-spacing: 0.05em;
        /* tracking-widest */
        transition: background-color 0.15s ease-in-out, ring 0.15s ease-in-out;
    }

    .custom-button:hover {
        background-color: #59ab5e !important;
        /* hover:bg-gray-700 */
    }


</style>
<title>Login 💸 ELPato</title>
<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <!-- name Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <br>
        <div class="g-recaptcha" data-sitekey="6LfIvMMpAAAAAMyq68S6_XTjd_bJnZopR1brbTSY" data-callback="onSubmit"></div>
        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input style="color: #12871A;" id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="login-button" class="ms-3 btn-lg custom-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
<script async src="https://www.google.com/recaptcha/api.js"></script>

<!-- Loader -->
<div id="loader" style="display: none;">
    <img src="{{ asset('images/loader.gif') }}" alt="Loading...">
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', function() {
        document.getElementById('loader').style.display = 'block';
        // Oculta o loader após 5 segundos
        setTimeout(function() {
            document.getElementById('loader').style.display = 'none';
        }, 20000); // 5000 milissegundos = 5 segundos
    });
</script> --}}


{{-- LOGIN DO SITE ANTIGO
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ELPato Painel</title>
    <link rel="icon" href="{{ asset('/images/icon.png') }}" type="image/x-icon">

    <style>
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #loader img {
            width: 250px;
            height: 250px;
        }

        #loader img {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

       .custom-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            /* equivalente a px-4 py-2 */
            background-color: #12871A !important;
            /* bg-gray-800 */
            border: 1px solid transparent;
            border-radius: 0.375rem;
            /* rounded-md */
            font-weight: 600;
            /* font-semibold */
            font-size: 0.75rem;
            /* text-xs */
            color: #fff;
            /* text-white */
            text-transform: uppercase;
            /* uppercase */
            letter-spacing: 0.05em;
            /* tracking-widest */
            transition: background-color 0.15s ease-in-out, ring 0.15s ease-in-out;
        }

        .custom-button:hover {
            background-color: #59ab5e !important;
            /* hover:bg-gray-700 */
        }

        .custom-button:focus {
            background-color: #59ab5e !important;
            /* focus:bg-gray-700 */
            outline: none;
            box-shadow: 0 0 0 2px #6366f1;
            /* focus:ring-2 focus:ring-indigo-500 */
        }

        .custom-button:active {
            background-color: #1a202c;
            /* active:bg-gray-900 */
        }

        /* Dark mode styles */
        .custom-button.dark {
            background-color: #edf2f7;
            /* dark:bg-gray-200 */
            color: #1a202c;
            /* dark:text-white-800 */
        }

        .custom-button.dark:hover {
            background-color: #fff;
            /* dark:hover:bg-white */
        }

        .custom-button.dark:focus {
            background-color: #fff;
            /* dark:focus:bg-white */
        }

        .custom-button.dark:active {
            background-color: #e2e8f0;
            /* dark:active:bg-gray-300 */
        }
    </style>
</head>
<body>
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <!-- Mensagem de erro para o campo e-mail -->
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <!-- Mensagem de erro para o campo senha -->
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <br>
            <!-- Google reCAPTCHA -->
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            <!-- Mensagem de erro para o reCAPTCHA -->
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input style="color: #12871A" id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4 center">
                <x-primary-button id="login-button" class="ms-3 btn-lg custom-button">
                    Login
                </x-primary-button>



            </div>
        </form>
    </x-guest-layout>

    <!-- Loader -->
    <div id="loader" style="display: none;">
        <img src="{{ asset('images/loader.gif') }}" alt="Loading...">
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function() {
            document.getElementById('loader').style.display = 'block'; // Exibe o loader
        });
    </script>
</body>
</html>
 --}}

@extends('layouts.masterlogin')

@section('title', 'Login 💸 ELPato Painel')

@section('content')
@section('page-title', 'Login 💸 ELPato Painel')

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
                            <h3 class="mb-4">Login</h3>
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

                        <!-- Campo de Senha -->
                        <div class="form-group mb-3">
                            <label class="label" for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>

                            <!-- Exibição do erro de Senha -->
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Google reCAPTCHA -->
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}

                        <!-- Mensagem de erro para o reCAPTCHA -->
                        @error('g-recaptcha-response')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <br>

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
                    <img src="{{ asset('/images/Elpatologin.gif') }}" alt="Side Image" width="480px" height="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
