@extends('layouts.master')

@section('title', 'Edit Drop')

@section('content')
@section('page-title', 'Edit Drop')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit Drop</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('drops.update', $drop->slug) }}">
                    @csrf
                    @method('PUT')


                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id_drop">Drop</label>
                                <input type="text" name="id_drop" id="id_drop" class="form-control"
                                    value="{{ old('id_drop') ?? $drop->id_drop }}" placeholder="Drop" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') ?? $drop->name }}" placeholder="Name" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') ?? $drop->address }}" placeholder="Address" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="packages">Packages</label>
                                        <input type="text" name="packages" id="packages" class="form-control"
                                            value="{{ old('packages') ?? $drop->packages }}" placeholder="Packages"
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" id="type" required>
                                            <option value="All"
                                                {{ old('type') == 'All' || $drop->type == 'All' ? 'selected' : '' }}>
                                                All</option>
                                            <option value="Salaried"
                                                {{ old('type') == 'Salaried' || $drop->type == 'Salaried' ? 'selected' : '' }}>
                                                Salaried</option>
                                            <option value="Nonsalaried"
                                                {{ old('type') == 'Nonsalaried' || $drop->type == 'Nonsalaried' ? 'selected' : '' }}>
                                                Nonsalaried</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
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
                                            <option value="Going to die"
                                                style="background-color: #F8ABEE; color: black;"
                                                {{ $drop->status == 'Going to die' ? 'selected' : '' }}>Going to die
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired At</label>
                                        <input type="date" name="expired" id="expired" class="form-control"
                                            value="{{ old('expired') ?? $drop->expired }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea style="resize: none;" name="notes" id="notes" class="form-control" placeholder="Notes" cols="43"
                                    rows="5" required>{{ old('notes') ?? $drop->notes }}</textarea>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <textarea style="resize: none;" type="text" name="personalnotes" id="personalnotes" class="form-control"
                                    placeholder="Personal Notes" cols="43" rows="5" required>{{ old('personalnotes') ?? $drop->personalnotes }}</textarea>
                            </div>
                        </div>
                    </div>
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
