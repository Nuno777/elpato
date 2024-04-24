<!-- Modal Form -->
<div class="modal fade" id="createorder{{ $id_drop }}" tabindex="-1" role="dialog"
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
                <form action="{{ route('orders.store', $id_drop) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" type="text" name="status" class="form-control" placeholder="status"
                        value="{{ old('status') ?? $status }}" readonly required>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" readonly required>
                    <input type="hidden" name="user" value="{{ Auth::user()->name }}" readonly required>

                    <input type="hidden" name="address" value="{{ old('address') ?? $address }}" readonly required>

                    @if ($status == 'Ready')
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @if (isset($drop))
                                        <label for="id_drop">Drop</label>
                                        <input name="id_drop" value="{{ old('id_drop') ?? $id_drop }}"
                                            class="form-control" placeholder="ID Drop" readonly required>
                                    @else
                                        <label for="id_drop">ID Drop</label>
                                        <input type="hidden" name="id_drop" class="form-control"
                                            placeholder="ID Drop Error" readonly required>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product">Product Name</label>
                                    <input type="text" name="product" class="form-control" placeholder="Product"
                                        required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    @if (isset($drop))
                                        <label for="name">Courier</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Courier Name" value="{{ old('name') ?? $courierName }}"
                                            readonly required>
                                    @else
                                        <label for="name">Courier Error</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Courier Error" readonly required>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="quant">Q-TY</label>
                                            <select name="quant" id="quant" class="form-control" required>
                                                <option selected value="0" disabled>0
                                                </option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <small class="form-text text-muted">quantity of
                                                product</small>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" class="form-control"
                                                placeholder="Price" required>
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
                                            <select name="tracking" id="tracking" class="form-control" required>
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
                                            <label for="code"> </label>
                                            <input type="text" name="code" class="form-control"
                                                placeholder="Tracking Code" required>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="holder">Holder Name</label>
                                    <input type="text" name="holder" class="form-control"
                                        placeholder="Holder Name" required>
                                    <small class="form-text text-muted">Name on
                                        package</small>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="comments">Notes</label>
                                    <textarea style="resize: none;" type="text" name="comments" class="form-control" placeholder="Comments" cols="43" rows="5" required>{{ old('notes') ?? $notes }}</textarea>

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="personalnotes">Personal Notes</label>
                                    <input type="text" name="personalnotes" class="form-control"
                                        placeholder="Example (Email Order:Pass)">
                                        <small class="form-text text-muted"></small>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="option">Options</label>
                                            <select name="option" id="option" class="form-control" required>
                                                <option selected value="default" disabled>
                                                    Default
                                                </option>
                                                <option value="Sell">Sell</option>
                                                <option value="Forward">Forward</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="delivery">Delivery Date</label>
                                            <input type="date" name="delivery" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="shop">Shop</label>
                                    <input type="text" name="shop" class="form-control" placeholder="Shop"
                                        required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">Need Pickup</span>
                                        <label class="switch switch-icon switch-info switch-pill form-control-label">
                                            <input type="checkbox" name="pickup"
                                                class="switch-input form-check-input" value="1">
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
                                                class="switch-input form-check-input" value="1">
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create Order</button>
                        </div>
                    @else
                        <div style="margin-top:15px;" class="alert alert-danger alert-icon" role="alert">
                            <i class="mdi mdi-alert"></i>You cannot create orders on drops with problems, please wait
                            for the problems to be resolved.
                        </div>

                    @endif
                </form>
            </div>
            <!-- Modal footer -->
        </div>
    </div>
</div>
