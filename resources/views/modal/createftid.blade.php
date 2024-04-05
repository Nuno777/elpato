<!-- Modal Form -->
<div class="modal fade" id="createftid{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalForm">Create FTID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ftid.store', $id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" readonly required> --}}
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
                                <input type="text" name="comments" class="form-control" placeholder="Comments">
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
                                        <label for="status">Status</label>
                                        <input type="text" name="status" class="form-control" placeholder="Status"
                                            value="FTID created" required readonly>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
