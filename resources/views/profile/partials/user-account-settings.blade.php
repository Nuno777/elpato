@extends('layouts.master')

@section('title', 'Profile')

@section('content')
@section('page-title', 'Account Settings')

<div class="content-wrapper">
    <div class="content">
        <!-- Card Profile -->
        <div class="card card-default card-profile">
            <div class="card-header-bg" style="background-image"></div>
            <div class="card-body card-profile-body">
                <div class="profile-avata">
                    @if (Auth::user()->profile_image)
                        <img class="rounded-circle"
                            src="{{ asset('storage/profile_img/' . Auth::user()->profile_image) }}" width="120px"
                            alt="Profile Image">
                    @else
                        <img class="rounded-circle" src="{{ asset('/images/user/user.png') }}" width="120px"
                            alt="Default Profile Image">
                    @endif
                    <div class="h5 d-block mt-3 mb-2">{{ Auth::user()->name }}</div>
                    <div class="d-block text-color">{{ Auth::user()->email }}</div>
                </div>
                <ul class="nav nav-profile-follow">
                </ul>
                <div class="profile-button">
                    {{-- <a class="btn btn-primary btn-pill" href="#">Upgrade Plan</a> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3">
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Settings</h2>
                    </div>
                    <div class="card-body pt-0">
                        <ul class="nav nav-settings">
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('profile')) active @endif"
                                    href="{{ route('profile') }}">
                                    <i class="mdi mdi-account-outline mr-1"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('profile-settings')) active @endif"
                                    href="{{ route('profile.settings') }}">
                                    <i class="mdi mdi-settings-outline mr-1"></i> Account Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <!-- Account Settings -->
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="mb-5">Change Password</h2>
                        <span>Ensure your account is using a long, random password to stay secure.</span>
                    </div>

                    <div class="card-body">
                        <!-- Mensagens de Sucesso e Erro -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('account.change.password') }}" method="POST">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="current">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="current" name="current"
                                        placeholder="Current Password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="newPassword">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                                        placeholder="New Password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="conPassword">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="conPassword"
                                        placeholder="Confirm Password" name="newPassword_confirmation" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="mdi mdi-eye-off"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-6">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/changepass.js') }}"></script>
@endpush
