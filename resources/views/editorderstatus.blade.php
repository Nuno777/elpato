@extends('layouts.master')

@section('title', 'Edit Order Status')

@section('content')
@section('page-title', 'Edit Order Status')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit Order Status</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('orderstatus.update', $order->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="id-drop">Drop</label>
                                <input type="text" name="id_drop" class="form-control" placeholder="Drop"
                                    value="{{ old('id_drop') ?? $order->id_drop }}" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="user">User</label>
                                <input type="text" name="user" class="form-control" placeholder="User"
                                    value="{{ old('user') ?? $order->user }}" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="product">Product</label>
                                <input type="text" name="product" class="form-control" placeholder="Product"
                                    value="{{ old('product') ?? $order->product }}"readonly required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Holder Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                    value="{{ old('name') ?? $order->name }}" readonly required>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address"
                                    value="{{ old('address') ?? $order->address }}" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tracking">Tracking</label>
                                        <input type="text" name="tracking" class="form-control"
                                            placeholder="Tracking" value="{{ old('tracking') ?? $order->tracking }}"
                                            readonly required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" name="code" class="form-control" placeholder="Code"
                                            value="{{ old('code') ?? $order->code }}" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="comments">Notes</label>
                                <input type="text" name="comments" class="form-control" placeholder="Notes"
                                    value="{{ old('comments') ?? $order->comments }}" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="shop">Shop</label>
                                        <input type="text" name="shop" class="form-control" placeholder="Shop"
                                            value="{{ old('shop') ?? $order->shop }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="quant">Q-TY</label>
                                        <input type="text" name="quant" class="form-control" placeholder="Q-TY"
                                            value="{{ old('quant') ?? $order->quant }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" class="form-control" placeholder="Price"
                                            value="{{ old('price') ?? $order->price }} $" readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="delivery">Delivery</label>
                                        <input type="date" name="delivery" class="form-control"
                                            placeholder="Delivery" value="{{ old('delivery') ?? $order->delivery }}"
                                            readonly required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="updatestatus" class="form-control" required>
                                            <option value="Received" style="background-color: #b491c8; color: black;"
                                                {{ $order->status == 'Received' ? 'selected' : '' }}>Received</option>
                                            <option value="Sent to buyer"
                                                style="background-color: #ffb74d; color: black;"
                                                {{ $order->status == 'Sent to buyer' ? 'selected' : '' }}>Sent to buyer
                                            </option>
                                            <option value="Waiting payment"
                                                style="background-color: #99d18f; color: black;"
                                                {{ $order->status == 'Waiting payment' ? 'selected' : '' }}>Waiting
                                                payment
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="option">Options</label>
                                        <input type="text" name="option" id="option" class="form-control"
                                            placeholder="Option" value="{{ old('option') ?? $order->option }}"
                                            readonly required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">Need Pickup</span>
                                            <label
                                                class="switch switch-icon switch-info switch-pill form-control-label">
                                                <input type="checkbox" name="pickup"
                                                    class="switch-input form-check-input" value="1"
                                                    {{ $order->pickup ? 'checked' : '' }} disabled readonly required>
                                                <span class="switch-label"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">Signature Required</span>
                                            <label
                                                class="switch switch-icon switch-info switch-pill form-control-label">
                                                <input type="checkbox" name="signature"
                                                    class="switch-input form-check-input" value="1"
                                                    {{ $order->signature ? 'checked' : '' }} disabled readonly
                                                    required>
                                                <span class="switch-label"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span></span>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <a href="{{ route('user.all') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/colortabledrops.js') }}"></script>
@endpush
