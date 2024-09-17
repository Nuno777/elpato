@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
@section('page-title', 'Edit User')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit User {{ $user->name }}</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')

                    <label for="name">Profile Image</label>
                    <div class="row">
                        <div class="col-6">
                            @if ($user->profile_image)
                                <img class="rounded-circle"
                                    src="{{ asset('storage/profile_img/' . $user->profile_image) }}" width="80px"
                                    alt="Profile Image">
                            @else
                                <img class="rounded-circle" src="{{ asset('/images/user/user.png') }}" width="80px"
                                    alt="Default Profile Image">
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="hidden" name="id" class="form-control"
                                            value="{{ old('id') ?? $user->id }}" placeholder="ID" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') ?? $user->name }}" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email') ?? $user->email }}" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="telegram">Telegram</label>
                                        <input type="text" name="telegram" class="form-control" maxlength="20"
                                            value="{{ old('telegram') ?? $user->telegram }}" placeholder="Telegram"
                                            required>
                                    </div>
                                </div>

                                <div class="col-2">
                                    @if (auth()->user()->id == $user->id)
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="type">Role</label>
                                                <input type="text" name="type" class="form-control"
                                                    value="{{ $user->type == 'worker' ? 'Worker' : ($user->type == 'general' ? 'General' : 'Admin') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="type">Role</label>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="worker"
                                                        {{ (old('type') ?? $user->type) == 'worker' ? 'selected' : '' }}>
                                                        Worker
                                                    </option>
                                                    <option value="general"
                                                        {{ (old('type') ?? $user->type) == 'general' ? 'selected' : '' }}>
                                                        General
                                                    </option>
                                                    <option value="admin"
                                                        {{ (old('type') ?? $user->type) == 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>


                                <div class="col-5">
                                    @if (auth()->user()->id == $user->id)
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="blocked">Blocked</label>
                                                <input type="text" name="blocked" class="form-control"
                                                    value="{{ $user->blocked == 1 ? 'Unblocked' : 'Blocked' }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="blocked">Blocked</label>
                                                <select name="blocked" id="blocked" class="form-control" required>
                                                    <option value="0"
                                                        {{ old('blocked', $user->blocked) == '0' ? 'selected' : '' }}>
                                                        Blocked
                                                    </option>
                                                    <option value="1"
                                                        {{ old('blocked', $user->blocked) == '1' ? 'selected' : '' }}>
                                                        Unblocked
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="email_verified_at">Create Check</label>
                                <input type="text" name="email_verified_at" class="form-control"
                                    value="{{ old('email_verified_at') ?? $user->email_verified_at }}"
                                    placeholder="Create Check" readonly required>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Edit User</button>
                    <a href="{{ route('user.all') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    var previousType = '{{ old('type') ?? $user->type }}';
    var previousBlocked = '{{ old('blocked') ?? $user->type }}';
</script>

@push('scripts')
<script src="{{ asset('js/checkperm.js') }}"></script>
@endpush
