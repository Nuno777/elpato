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
                                    <form role="form" action="{{ route('orders.forceDelete', $order->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Do you really want to delete this order forever?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            <i class="mdi mdi-delete-forever" data-toggle="tooltip"></i>
                                        </button>
                                    </form>
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
