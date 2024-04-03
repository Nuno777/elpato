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
                <table id="productsTable" class="table table-active table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>Drop</th>
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
                            <th>Signature</th>
                            <th style="width: 10%" class="sorting_disabled">Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @if (auth()->user()->id == $order->user_id || auth()->user()->admin == 6)
                                <tr
                                    style="background-color:
                                        @if ($order->status == 'Ready') #85f36e;
                                        @elseif ($order->status == 'Suspense') #838383;
                                        @elseif ($order->status == 'Dont send') #fff085;
                                        @elseif ($order->status == 'Problem') #ff9e8e; @endif
                                        color:
                                        @if ($order->status == 'Suspense') white; @else black; @endif">
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
                                    <td>{{ $order->pickup ? 'Yes' : 'No' }}</td>
                                    <td>{{ $order->signature ? 'Yes' : 'No' }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->admin == 5)
                                        <form role="form" action="{{ route('orders.destroy', $order->id) }}"
                                            method="POST" onsubmit="return confirm('Delete order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="link"
                                                style="background-color: transparent; border:none">
                                                <i class="mdi mdi-trash-can text-danger" data-toggle="tooltip"></i>
                                            </button>
                                        </form>
                                    @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>

@endsection
