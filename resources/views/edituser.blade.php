@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
@section('page-title', 'Edit User')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit User</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" name="id" class="form-control"
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
                                    value="{{ old('carrier') ?? $user->email }}" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Role</label>
                                        <select name="type" class="form-control" required>
                                            <option value="admin"
                                                {{ (old('type') ?? $user->type) == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="general"
                                                {{ (old('type') ?? $user->type) == 'general' ? 'selected' : '' }}>General
                                            </option>
                                            <option value="worker"
                                                {{ (old('type') ?? $user->type) == 'worker' ? 'selected' : '' }}>Worker
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email_verified_at">Create Check</label>
                                        <input type="text" name="email_verified_at" class="form-control"
                                            value="{{ old('email_verified_at') ?? $user->email_verified_at }}"
                                            placeholder="Create Check" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit FTID</button>
                    <a href="{{ route('user.all') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
