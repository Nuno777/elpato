@extends('layouts.master')

@section('title', 'Profile')

@section('content')
@section('page-title', 'Profile')

<div class="content-wrapper">
    <div class="content">
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
                <ul class="nav nav-profile-follow"></ul>
                <div class="profile-button"></div>
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
                                <a class="nav-link @if (Request::is('profile')) active @endif" href="{{ route('profile') }}">
                                    <i class="mdi mdi-account-outline mr-1"></i> Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (Request::is('profile-settings')) active @endif" href="{{ route('profile.settings') }}">
                                    <i class="mdi mdi-settings-outline mr-1"></i> Account Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="mb-5">Profile Settings</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-6">
                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">Profile Image</label>
                                <div class="col-sm-8 col-lg-10">
                                    <div class="custom-file mb-1">
                                        <input type="file" class="custom-file-input" id="label"
                                            name="profile_image" accept=".png,.jpg,.jpeg">
                                        <label class="custom-file-label" for="label">
                                            <div class="drag-text">
                                                Drag and drop the file here (or click to choose)
                                            </div>
                                        </label>
                                    </div>

                                    <span class="d-block">Upload a new image, JPG, JPEG, PNG</span>
                                </div>
                            </div>

                            <h4 class="mb-5">Social Networks</h4>
                            <div class="d-flex mb-5">
                                <button type="button" class="btn btn-icon twitter mr-2">
                                    <i class="mdi mdi-telegram"></i>
                                </button>
                                <input type="text" class="form-control" name="telegram"
                                    value="{{ old('telegram') ?? Auth::user()->telegram }}"
                                    placeholder="Telegram username" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Profile</button>
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
<script src="{{ asset('js/namelabel.js') }}"></script>
@endpush
