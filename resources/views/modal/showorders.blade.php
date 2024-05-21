<!-- Modal Form -->
<div class="modal fade" id="showorder{{ $order->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalForm">Show Info Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="id_drop">Drop</label>
                                <input name="id_drop" value="{{ old('id_drop') ?? $order->id_drop }}"
                                    class="form-control" placeholder="Drop" readonly required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="user">User</label>
                                <input name="user" value="{{ old('user') ?? $order->user }}" class="form-control"
                                    placeholder="User" readonly required>
                            </div>
                        </div>

                        <div class="col-sm-7">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input name="address" value="{{ old('address') ?? $order->address }}"
                                    class="form-control" placeholder="Address" readonly required>
                            </div>
                        </div>
                    </div>

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
                                        <small class="form-text text-muted">Quantity of
                                            Product</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" class="form-control" placeholder="Price"
                                            value="{{ old('price') ?? $order->price }} $" readonly required>
                                        <small class="form-text text-muted">Product
                                            Price in Dollar</small>
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
                                        <!-- Usando um link direto no campo de código -->
                                        @if ($order->tracking == 'Fedex')
                                            <a href="https://www.fedex.com/fedextrack/no-results-found?trknbr={{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'UPS')
                                            <a href="https://www.ups.com/track?track=yes&trackNums={{ $order->code }}&loc=en_US&requester=ST/trackdetails"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'USPS')
                                            <a href="https://www.usps.com/search/results.htm?keyword={{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'Ontrac')
                                            <a href="https://www.ontrac.com/tracking/?number={{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'Lasership')
                                            <a href="https://www.ordertracker.com/track/{{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'DHL')
                                            <a href="https://www.dhl.com/us-en/home/tracking/tracking-global-forwarding.html?submit=1&tracking-id={{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'Canadapost')
                                            <a href="https://www.canadapost-postescanada.ca/track-reperage/en#/search?searchFor={{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'Porulator')
                                            <a href="https://www.purolator.com/en/shipping/tracker?pins={{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'Australian')
                                            <a href="https://auspost.com.au/mypost/track/details/{{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @elseif ($order->tracking == 'Amazon')
                                            <a href="https://track.amazon.com/tracking/{{ $order->code }}"
                                                class="form-control" readonly required
                                                target="_blank">{{ $order->code }}</a>
                                        @endif
                                        <small class="form-text text-muted">Link to Tracking</small>
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
                                <label for="comments">Notes</label>
                                <textarea style="resize: none;" type="text" name="comments" class="form-control" placeholder="Comments"
                                    cols="43" rows="4" readonly required>{{ $order->comments }}</textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <input type="text" name="personalnotes" class="form-control"
                                    placeholder="Example (Email Order:Pass)"
                                    value="{{ old('personalnotes') ?? $order->personalnotes }}" readonly>
                                <small class="form-text text-muted"></small>
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
                                        <input type="checkbox" name="pickup" class="switch-input form-check-input"
                                            value="1" {{ $order->pickup ? 'checked' : '' }} disabled required>
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
                                        <input type="checkbox" name="signature" class="switch-input form-check-input"
                                            value="1" {{ $order->signature ? 'checked' : '' }} disabled required>
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <!-- Modal footer -->
        </div>
    </div>
</div>
