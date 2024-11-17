@extends('layouts.master')

@section('title', 'Restore Orders')

@section('content')
@section('page-title', 'Restore Orders')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">
                </div>
                <table id="productsTable" class="table table-active table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>Drop</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Courier</th>
                            <th>Address</th>
                            <th style="width: 5%" class="sorting_disabled">Tracking</th>
                            <th style="width: 13%" class="sorting_disabled">Code</th>
                            <th>Status</th>
                            <th>Comments</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deletedOrders as $order)
                            <tr>
                                <td>{{ $order->id_drop }}</td>
                                <td>{{ $order->user }}</td>
                                <td>{{ $order->product }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->tracking }}</td>
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->comments }}</td>
                                <td>
                                    <form action="{{ route('orders.restore', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Restore order?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-restore" data-toggle="tooltip"></i>
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#forceDeleteOrderModal{{ $order->slug }}">
                                        <i class="mdi mdi-delete-forever" data-toggle="tooltip"></i>
                                    </button>

                                    <div class="modal fade" id="forceDeleteOrderModal{{ $order->slug }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="forceDeleteOrderModalLabel{{ $order->slug }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="forceDeleteOrderModalLabel{{ $order->slug }}">
                                                        Permanently delete this order
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>To confirm the permanent deletion of this order, type:</p>
                                                    <p><strong>delete-{{ $order->id_drop }}</strong></p><br>
                                                    <input type="text" id="deleteInput{{ $order->slug }}"
                                                        class="form-control" placeholder="Type here to confirm"
                                                        oninput="validateInput('{{ $order->slug }}', '{{ $order->id_drop }}')">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <form role="form"
                                                        action="{{ route('orders.forceDelete', $order->slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="confirmation_text"
                                                            id="confirmationText{{ $order->slug }}">
                                                        <button type="submit" id="deleteButton{{ $order->slug }}"
                                                            class="btn btn-danger" disabled>
                                                            Permanently delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('orders.all') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/order/deleteinput.js') }}"></script>
@endpush
