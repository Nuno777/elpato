@extends('layouts.master')

@section('title', 'Edit Order')

@section('content')
@section('page-title', 'Edit Order')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit Order</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('order.update', $order->id) }}">
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
                                    value="{{ old('product') ?? $order->product }}" required>
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
                                        <select name="tracking" id="tracking" class="form-control" required>
                                            <option value="Fedex" {{ $order->tracking == 'Fedex' ? 'selected' : '' }}>
                                                Fedex</option>
                                            <option value="UPS" {{ $order->tracking == 'UPS' ? 'selected' : '' }}>
                                                UPS</option>
                                            <option value="USPS" {{ $order->tracking == 'USPS' ? 'selected' : '' }}>
                                                USPS</option>
                                            <option value="Ontrac" {{ $order->tracking == 'Ontrac' ? 'selected' : '' }}>
                                                Ontrac</option>
                                            <option value="Lasership"
                                                {{ $order->tracking == 'Lasership' ? 'selected' : '' }}>Lasership
                                            </option>
                                            <option value="DHL" {{ $order->tracking == 'DHL' ? 'selected' : '' }}>
                                                DHL</option>
                                            <option value="Canadapost"
                                                {{ $order->tracking == 'Canadapost' ? 'selected' : '' }}>Canadapost
                                            </option>
                                            <option value="Porulator"
                                                {{ $order->tracking == 'Porulator' ? 'selected' : '' }}>Porulator
                                            </option>
                                            <option value="Australian"
                                                {{ $order->tracking == 'Australian' ? 'selected' : '' }}>Australian
                                                post</option>
                                            <option value="Amazon"
                                                {{ $order->tracking == 'Amazon' ? 'selected' : '' }}>Amazon</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" name="code" class="form-control" placeholder="Code"
                                            value="{{ old('code') ?? $order->code }}" required>
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
                                            value="{{ old('shop') ?? $order->shop }}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="quant">Q-TY</label>
                                        <select name="quant" id="quant" class="form-control" required>
                                            <option value="0" disabled
                                                {{ $order->quant == 0 ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ $order->quant == 1 ? 'selected' : '' }}>1
                                            </option>
                                            <option value="2" {{ $order->quant == 2 ? 'selected' : '' }}>2
                                            </option>
                                            <option value="3" {{ $order->quant == 3 ? 'selected' : '' }}>3
                                            </option>
                                            <option value="4" {{ $order->quant == 4 ? 'selected' : '' }}>4
                                            </option>
                                            <option value="5" {{ $order->quant == 5 ? 'selected' : '' }}>5
                                            </option>
                                            <option value="6" {{ $order->quant == 6 ? 'selected' : '' }}>6
                                            </option>
                                            <option value="7" {{ $order->quant == 7 ? 'selected' : '' }}>7
                                            </option>
                                            <option value="8" {{ $order->quant == 8 ? 'selected' : '' }}>8
                                            </option>
                                            <option value="9" {{ $order->quant == 9 ? 'selected' : '' }}>9
                                            </option>
                                            <option value="10" {{ $order->quant == 10 ? 'selected' : '' }}>10
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" class="form-control"
                                            placeholder="Price" value="{{ old('price') ?? $order->price }}" required>
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
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="option">Options</label>
                                        <select name="option" id="option" class="form-control" required>
                                            <option value="Sell" {{ $order->option == 'Sell' ? 'selected' : '' }}>
                                                Sell</option>
                                            <option value="Forward"
                                                {{ $order->option == 'Forward' ? 'selected' : '' }}>Forward</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">Need Pickup</span>
                                            <label
                                                class="switch switch-icon switch-info switch-pill form-control-label">
                                                <input type="checkbox" name="pickup"
                                                    class="switch-input form-check-input" value="1"
                                                    {{ $order->pickup ? 'checked' : '' }}>
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
                                                    {{ $order->signature ? 'checked' : '' }}>
                                                <span class="switch-label"></span>
                                                <span class="switch-handle"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Order</button>
                    <a href="{{ route('orders') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
