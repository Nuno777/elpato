<!-- Modal para Criar Ordem -->
<div class="modal fade" id="createOrderRef" tabindex="-1" role="dialog" aria-labelledby="createOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOrderModalLabel">Create New Order Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulário para Criar Ordem -->
                <form action="{{ route('ordersRef.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->slug }}" readonly required>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="user">User</label>
                                <input type="text" name="user" class="form-control"
                                    value="{{ Auth::user()->name }}"placeholder="User" readonly required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="product">Product Name</label>
                                <input type="text" name="product" class="form-control" placeholder="Product"
                                    required>
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
                                        <input type="text" name="price" class="form-control" placeholder="Price"
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
                                        <select name="tracking" id="tracking" class="form-control" required>
                                            <option selected value="default" disabled>
                                                Unknown
                                            </option>
                                            <option value="CTT">CTT</option>
                                            <option value="DPD">DPD</option>
                                            <option value="Fedex">Fedex</option>
                                            <option value="UPS">UPS</option>
                                            <option value="DHL">DHL</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <small class="form-text text-muted">If you choose the "Other" option, put the
                                            link in the code</small>
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
                                <label for="shop">Shop</label>
                                <input type="text" name="shop" class="form-control" placeholder="Shop" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" value="Place Order" placeholder="Status" readonly required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="comments">Notes</label>
                                        <textarea style="resize: none;" type="text" name="comments" class="form-control"
                                            placeholder="Example: email/phone or other information" cols="43" rows="5">N/A</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create Order</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
