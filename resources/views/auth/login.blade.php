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
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button id="login-button" class="ms-3 btn-lg">
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
</script>
