@extends('layouts.master')

@section('title', 'Dashboard Orders')

@section('content')
@section('page-title', 'Orders Painel')

<div class="content-wrapper">
    <div class="content">

        <div class="card card-default">
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">

                </div>
                <table id="productsTable" class="table table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Drop ID</th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Tracking</th>
                            <th>Code</th>
                            <th>Holder</th>
                            <th>Comments</th>
                            <th>Option</th>
                            <th>Delivery Date</th>
                            <th>Shop</th>
                            <th>Need Pickup</th>
                            <th>Signature Required</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->id_drop }}</td>
                            <td>{{ $order->product }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->quant }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->tracking }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->holder }}</td>
                            <td>{{ $order->comments }}</td>
                            <td>{{ $order->option }}</td>
                            <td>{{ $order->delivery }}</td>
                            <td>{{ $order->shop }}</td>
                            <td>{{ $order->need_pickup ? 'Yes' : 'No' }}</td>
                            <td>{{ $order->signature_required ? 'Yes' : 'No' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
