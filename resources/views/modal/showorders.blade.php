<!-- Modal Form -->
<div class="modal fade" id="showorder{{ $order->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalForm">Create Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" type="text" name="status" class="form-control" placeholder="status"
                        value="{{ old('status') ?? $status }}" readonly required>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id_drop">Drop</label>
                                <input name="id_drop" value="{{ old('id_drop') ?? $order->id_drop }}"
                                    class="form-control" placeholder="ID Drop" readonly required>
                            </div>
                        </div>
                    </div>

                    @if ($status == 'Ready')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product">Product Name</label>
                                    <input type="text" name="product" class="form-control" placeholder="Product"
                                        value="{{ old('product') ?? $order->product }}" readonly required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Courier</label>
                                    <input type="text" name="name" class="form-control" placeholder="Courier Name"
                                        value="{{ old('name') ?? $courierName }}" readonly required>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="quant">Q-TY</label>
                                            <input type="text" name="quant" id="quant" class="form-control"
                                                placeholder="Q-TY" value="{{ old('quant') ?? $order->quant }}" readonly
                                                required>
                                            <small class="form-text text-muted">quantity of
                                                product</small>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" class="form-control"
                                                placeholder="Price" value="{{ old('price') ?? $order->price }}" readonly
                                                required>
                                            <small class="form-text text-muted">product
                                                price in dollar</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tracking">Tracking</label>
                                            <input type="text" name="tracking" id="tracking" class="form-control"
                                                placeholder="Tracking" value="{{ old('tracking') ?? $order->tracking }}"
                                                readonly required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="code"> </label>
                                            <input type="text" name="code" class="form-control"
                                                placeholder="Tracking Code" value="{{ old('code') ?? $order->code }}"
                                                readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="holder">Holder Name</label>
                                    <input type="text" name="holder" class="form-control" placeholder="Holder Name"
                                        value="{{ old('holder') ?? $order->holder }}" readonly required>
                                    <small class="form-text text-muted">Name on
                                        package</small>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <input type="text" name="comments" class="form-control"
                                        placeholder="Comments" value="{{ old('comments') ?? $order->comments }}"
                                        readonly required>
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="delivery">Delivery Date</label>
                                            <input type="date" name="delivery" class="form-control"
                                                value="{{ old('delivery') ?? $order->delivery }}" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="shop">Shop</label>
                                    <input type="text" name="shop" class="form-control" placeholder="Shop"
                                        value="{{ old('shop') ?? $order->shop }}" readonly required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">Need Pickup</span>
                                        <label class="switch switch-icon switch-info switch-pill form-control-label">
                                            <input type="checkbox" name="pickup"
                                                class="switch-input form-check-input" value="1"
                                                {{ $order->pickup ? 'checked' : '' }} disabled required>
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">Signature Required</span>
                                        <label class="switch switch-icon switch-info switch-pill form-control-label">
                                            <input type="checkbox" name="signature"
                                                class="switch-input form-check-input" value="1"
                                                {{ $order->signature ? 'checked' : '' }} disabled required>
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif
                </form>
            </div>
            <!-- Modal footer -->
        </div>
    </div>
</div>
