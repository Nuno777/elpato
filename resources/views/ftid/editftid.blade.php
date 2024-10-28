@extends('layouts.master')

@section('title', 'Edit FTID')

@section('content')
@section('page-title', 'Edit FTID')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit FTID</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('ftid.update', $ftid->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="carrier">Carrier</label>
                                        <select name="carrier" id="carrier" class="form-control" required>
                                            <option value="Fedex" {{ $ftid->carrier == 'Fedex' ? 'selected' : '' }}>Fedex</option>
                                            <option value="UPS" {{ $ftid->carrier == 'UPS' ? 'selected' : '' }}>UPS</option>
                                            <option value="USPS" {{ $ftid->carrier == 'USPS' ? 'selected' : '' }}>USPS</option>
                                            <option value="Ontrac" {{ $ftid->carrier == 'Ontrac' ? 'selected' : '' }}>Ontrac</option>
                                            <option value="Lasership" {{ $ftid->carrier == 'Lasership' ? 'selected' : '' }}>Lasership</option>
                                            <option value="DHL" {{ $ftid->carrier == 'DHL' ? 'selected' : '' }}>DHL</option>
                                            <option value="Canadapost" {{ $ftid->carrier == 'Canadapost' ? 'selected' : '' }}>Canadapost</option>
                                            <option value="Porulator" {{ $ftid->carrier == 'Porulator' ? 'selected' : '' }}>Porulator</option>
                                            <option value="Australian" {{ $ftid->carrier == 'Australian' ? 'selected' : '' }}>Australian post</option>
                                            <option value="Amazon" {{ $ftid->carrier == 'Amazon' ? 'selected' : '' }}>Amazon</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tracking"> </label>
                                        <input type="text" name="tracking" class="form-control"
                                            value="{{ old('tracking') ?? $ftid->tracking }}" placeholder="Tracking Code"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="store">Store</label>
                                <input type="text" name="store" class="form-control"
                                    value="{{ old('store') ?? $ftid->store }}" placeholder="Store" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="label_creation_date">Label Creation Date</label>
                                        <input type="date" name="label_creation_date" class="form-control"
                                            value="{{ old('label_creation_date') ?? $ftid->label_creation_date }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="method">Method</label>
                                        <input type="text" name="method" class="form-control"
                                            value="{{ old('method') ?? $ftid->method }}" placeholder="Method" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input type="text" name="comments" class="form-control"
                                    value="{{ old('comments') ?? $ftid->comments }}" placeholder="Comments"
                                    value="N/A">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit FTID</button>
                    <a href="{{ route('ftid') }}" type="submit" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/colortableftid.js') }}"></script>
@endpush
