@extends('layouts.master')

@section('title', 'Edit Drop')

@section('content')
@section('page-title', 'Edit Drops')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit Drops</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('drops.update', $drop->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id-drop">ID</label>
                                <input type="text" name="id_drop" class="form-control" placeholder="Id Drop"
                                    value="{{ old('id_drop') ?? $drop->id_drop }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    value="{{ old('name') ?? $drop->name }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <input type="text" name="notes" class="form-control" placeholder="Notes"
                                    value="{{ old('notes') ?? $drop->notes }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address"
                                    value="{{ old('address') ?? $drop->address }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <input type="text" name="personalnotes" class="form-control"
                                    placeholder="Personal Notes"
                                    value="{{ old('personalnotes') ?? $drop->personalnotes }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="packages">Packages</label>
                                        <input type="text" name="packages" class="form-control"
                                            placeholder="Packages" value="{{ old('packages') ?? $drop->packages }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="Ready" style="background-color: #82FB6A; color: black;"
                                                {{ $drop->status == 'Ready' ? 'selected' : '' }}>Ready</option>
                                            <option value="Problem" style="background-color: #FF7059; color: white;"
                                                {{ $drop->status == 'Problem' ? 'selected' : '' }}>Problem</option>
                                            <option value="Dont send" style="background-color: #F1DD50; color: black;"
                                                {{ $drop->status == 'Dont send' ? 'selected' : '' }}>Dont send</option>
                                            <option value="Suspense" style="background-color: #424945; color: white;"
                                                {{ $drop->status == 'Suspense' ? 'selected' : '' }}>Suspense</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" name="type" class="form-control" placeholder="Type"
                                            value="{{ old('type') ?? $drop->type }}" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired At</label>
                                        <input type="date" name="expired" class="form-control"
                                            value="{{ old('expired') ?? $drop->expired }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span></span>
                    <button type="submit" class="btn btn-primary">Update Drop</button>
                    <a href="{{ route('drops') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/colortabledrops.js') }}"></script>
@endpush
