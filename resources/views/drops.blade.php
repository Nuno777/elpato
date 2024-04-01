@extends('layouts.master')

@section('title', 'Dashboard Drops')

@section('content')
@section('page-title', 'Drops Painel')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">
                </div>
                <div class="table-responsive">
                    <table id="productsTable" class="table table-product" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 25%" class="sorting_disabled">Name</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 25%" class="sorting_disabled">Address</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 10%" class="sorting_disabled">Courier Packages</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 10%" class="sorting_disabled">Notes</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 5%">Type</th>
                                <th style="width: 5%">Expired At</th>
                                <th style="width: 5%">Personal Notes</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drops as $drop)
                                <tr
                                    style="background-color:
                                    @if ($drop->status == 'Ready') #85f36e;
                                    @elseif ($drop->status == 'Suspense') #838383;
                                    @elseif ($drop->status == 'Dont send') #fff085;
                                    @elseif ($drop->status == 'Problem') #ff9e8e; @endif
                                    color:
                                    @if ($drop->status == 'Suspense') white; @else black; @endif">
                                    <td>{{ $drop->id_drop }}</td>
                                    <td>{{ $drop->name }}</td>
                                    <td>{{ $drop->address }}</td>
                                    <td>{{ $drop->packages }}</td>
                                    <td>{{ $drop->notes }}</td>
                                    <td>{{ $drop->status }}</td>
                                    <td>{{ $drop->type }}</td>
                                    <td>{{ $drop->expired }}</td>
                                    <td>{{ $drop->personalnotes }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#exampleModalForm">
                                            <i class="mdi mdi-package-variant text-primary"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="{{ route('editdrops.edit', $drop->id) }}" style="width: 100%">
                                            <i class="mdi mdi-pencil text-warning"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form role="form" action="{{ route('drops.destroy', $drop->id) }}"
                                            method="POST" onsubmit="return confirm('Delete Drop?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="link"
                                                style="background-color: transparent; border:none">
                                                <i class="mdi mdi-trash-can text-danger" data-toggle="tooltip"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <a href="{{ route('createdrops') }}"><button class="btn btn-primary">Create Drop</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFormTitle">Create Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
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
                                <label for="notes">Courier</label>
                                <input type="text" name="notes" class="form-control" placeholder="Notes"
                                    value="{{ old('name') ?? $drop->name }}" disabled required>
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
                                        <small class="form-text text-muted">quantity of product</small>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" class="form-control"
                                            placeholder="Price" required>
                                        <small class="form-text text-muted">product price in dollar</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Tracking</label>
                                        <select name="tracking" id="tracking" class="form-control" required>
                                            <option selected value="default" disabled>Unknown
                                            </option>
                                            <option value="fedex">Fedex</option>
                                            <option value="ups">UPS</option>
                                            <option value="usps">USPS</option>
                                            <option value="ontrac">Ontrac</option>
                                            <option value="lasership">Lasership</option>
                                            <option value="dhl">DHL</option>
                                            <option value="canadapost">Canadapost</option>
                                            <option value="porulator">Porulator</option>
                                            <option value="australian">Australian post</option>
                                            <option value="amazon">Amazon</option>
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
                                <input type="text" name="holder" class="form-control" placeholder="Holder Name"
                                    required>
                                <small class="form-text text-muted">Name on package</small>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input type="text" name="comments" class="form-control" placeholder="Comments"
                                    required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Options</label>
                                        <select name="tracking" id="tracking" class="form-control" required>
                                            <option selected value="default" disabled>Default
                                            </option>
                                            <option value="Option1">Option 1</option>
                                            <option value="Option2">Option 2</option>
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
                                        <input type="checkbox" class="switch-input form-check-input" value="off">
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
                                        <input type="checkbox" class="switch-input form-check-input" value="off">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-pill">Create Order</button>
            </div>
        </div>
    </div>
</div>

@endsection
