@extends('layouts.master')

@section('title', 'Create FTID')

@section('content')
@section('page-title', 'Create FTID')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Create FTID</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('ftid.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" readonly required>
                    <input type="hidden" name="user" value="{{ Auth::user()->name }}" readonly required>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="carrier">Carrier</label>
                                        <select name="carrier" id="carrier" class="form-control" required>
                                            <option selected value="default" disabled>
                                                Unknown
                                            </option>
                                            <option value="Fedex">Fedex</option>
                                            <option value="UPS">UPS</option>
                                            <option value="USPS">USPS</option>
                                            <option value="Ontrac">Ontrac</option>
                                            <option value="Lasership">Lasership
                                            </option>
                                            <option value="DHL">DHL</option>
                                            <option value="Canadapost">Canadapost
                                            </option>
                                            <option value="Porulator">Porulator
                                            </option>
                                            <option value="Australian">Australian post
                                            </option>
                                            <option value="Amazon">Amazon</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tracking"> </label>
                                        <input type="text" name="tracking" class="form-control"
                                            placeholder="Tracking Code" required>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="store">Store</label>
                                <input type="text" name="store" class="form-control" placeholder="Store" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="method">Method</label>
                                <input type="text" name="method" class="form-control" placeholder="Method" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input type="text" name="comments" class="form-control" placeholder="Comments"
                                    value="N/A">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="label_creation_date">Label Creation Date</label>
                                        <input type="date" name="label_creation_date" class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        @if (auth()->check() && auth()->user()->type == 'admin')
                                            <label for="status">Status</label>
                                            <input type="text" name="status" class="form-control"
                                                placeholder="Status" value="FTID Created"
                                                style="background-color: #82FB6A; color: black; " required readonly>
                                        @elseif(auth()->check() && auth()->user()->type == 'general')
                                            <label for="status"></label>
                                        @endif
                                        <input type="hidden" name="status" class="form-control" placeholder="Status"
                                            value="FTID Created" style="background-color: #82FB6A; color: black; "
                                            required readonly>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="label">Label (PDF, PNG, JPEG)</label>
                                        <div class="custom-file" style="margin-bottom: 20px;">
                                            <input type="file" class="custom-file-input" id="label"
                                                name="label" accept=".pdf,.png,.jpg,.jpeg" required>
                                            <label class="custom-file-label" for="label">
                                                <div class="drag-text">
                                                    Drag and drop the file here (or click to choose)
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Insert FTID</button>
                    <a href="{{ route('ftid') }}" type="submit" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/namelabel.js') }}"></script>
@endpush
