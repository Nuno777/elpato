@extends('layouts.master')

@section('title', 'All Orders Painel')

@section('content')
@section('page-title', 'All Orders Painel')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                {{-- filtro de pesquisa --}}
                <div class="row mb-3">
                    <div class="col-md-3">
                        <form action="{{ route('orders.filter') }}" method="GET" id="filterForm">
                            <div class="form-group">

                                <div class="input-group">
                                    <select class="form-control" name="userName" id="userName">
                                        <option value="">All Users</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" id="filterButton"
                                            disabled>Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var select = document.getElementById("userName");
                        var button = document.getElementById("filterButton");

                        select.addEventListener("change", function() {
                            if (this.value !== "") {
                                button.removeAttribute("disabled");
                            } else {
                                button.setAttribute("disabled", "disabled");
                            }
                        });
                    });
                </script>
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
                            <th>Tracking</th>
                            <th>Code</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @if (auth()->user()->id == $order->user_id || auth()->user()->admin == 'A_HaQD1SkWsGN0tYW8DOZLuTm61')
                                <tr
                                    style="background-color:
                                    @if ($order->status == 'Ready') #85f36e;
                                    @elseif ($order->status == 'Suspense') #838383;
                                    @elseif ($order->status == 'Dont send') #fff085;
                                    @elseif ($order->status == 'Problem') #ff9e8e; @endif
                                    color:
                                    @if ($order->status == 'Suspense') white; @else black; @endif">
                                    <td style="width: 5%" class="sorting_disabled">{{ $order->id_drop }}</td>
                                    <td style="width: 5%" class="sorting_disabled">{{ $order->user }}</td>
                                    <td style="width: 10%" class="sorting_disabled">{{ $order->product }}</td>
                                    <td style="width: 15%" class="sorting_disabled">{{ $order->name }}</td>
                                    <td style="width: 30%" class="sorting_disabled">{{ $order->address }}</td>
                                    <td class="sorting_disabled">{{ $order->tracking }}</td>
                                    <td class="sorting_disabled">{{ $order->code }}</td>
                                    <td style="width: 5%" class="sorting_disabled">{{ $order->quant }}</td>
                                    <td style="width: 5%" class="sorting_disabled">{{ $order->price }} </td>

                                    @if (auth()->check())
                                        <td style="width: 5%" class="sorting_disabled">
                                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                                data-target="#showorder{{ $order->id }}"> <i
                                                    class="mdi mdi-message-text-outline"></i>
                                            </button>

                                        </td>
                                        <td style="width: 5%" class="sorting_disabled">
                                            <form role="form" action="{{ route('orders.destroy', $order->id) }}"
                                                method="POST" onsubmit="return confirm('Delete order?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>

                                @include('modal.showorders', [
                                    'order' => $order,
                                    'id_drop' => $order->id,
                                    'courierName' => $order->name,
                                    'status' => $order->status,
                                    'address' => $order->address,
                                ])
                            @endif
                        @endforeach

                    </tbody>

                </table>
                <br>
                <a href="{{ route('orders.all') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

</div>


@endsection
