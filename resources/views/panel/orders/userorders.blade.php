@extends('layouts.master')

@section('title', 'User Orders')

@section('content')
@section('page-title', 'User Orders')

<div class="content-wrapper">
    <div class="content">

        <div class="card card-default">
            <div class="card-body">
                <h2>Orders for {{ $user->name }}</h2>
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
                            <th style="width: 15%" class="sorting_disabled">Code</th>
                            <th>Status</th>
                            <th>Comments</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr
                                style="background-color:
                                @if ($order->status == 'Ready') #85f36e;
                                @elseif ($order->status == 'Suspense') #838383;
                                @elseif ($order->status == 'Dont send') #fff085;
                                @elseif ($order->status == 'Problem') #ff9e8e;
                                @elseif ($order->status == 'Received') #b491c8;
                                @elseif ($order->status == 'Sent to buyer') #ffb74d;
                                @elseif ($order->status == 'Waiting payment') #99d18f; @endif
                                color:
                                @if ($order->status == 'Suspense') white;
                                @elseif (in_array($order->status, ['Received', 'Sent to buyer', 'Waiting payment'])) white;
                                @else black; @endif">
                                <td style="width: 5%" class="sorting_disabled">{{ $order->id_drop }}</td>
                                <td style="width: 5%" class="sorting_disabled">{{ $order->user }}</td>
                                <td style="width: 10%" class="sorting_disabled">{{ $order->product }}</td>
                                <td style="width: 15%" class="sorting_disabled">{{ $order->name }}</td>
                                <td style="width: 25%" class="sorting_disabled">{{ $order->address }}</td>
                                <td class="sorting_disabled">{{ $order->tracking }}</td>
                                <td class="sorting_disabled">
                                    @if ($order->tracking == 'Fedex')
                                        <a href="https://www.fedex.com/fedextrack/no-results-found?trknbr={{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'UPS')
                                        <a href="https://www.ups.com/track?track=yes&trackNums={{ $order->code }}&loc=en_US&requester=ST/trackdetails"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'USPS')
                                        <a href="https://www.usps.com/search/results.htm?keyword={{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'Ontrac')
                                        <a href="https://www.ontrac.com/tracking/?number={{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'Lasership')
                                        <a href="https://www.ordertracker.com/track/{{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'DHL')
                                        <a href="https://www.dhl.com/us-en/home/tracking/tracking-global-forwarding.html?submit=1&tracking-id={{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'Canadapost')
                                        <a href="https://www.canadapost-postescanada.ca/track-reperage/en#/search?searchFor={{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'Porulator')
                                        <a href="https://www.purolator.com/en/shipping/tracker?pins={{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'Australian')
                                        <a href="https://auspost.com.au/mypost/track/details/{{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @elseif ($order->tracking == 'Amazon')
                                        <a href="https://track.amazon.com/tracking/{{ $order->code }}"
                                            target="_blank">{{ $order->code }}</a>
                                    @endif
                                </td>
                                <td style="width: 5%" class="sorting_disabled">{{ $order->status }}</td>
                                <td style="width: 15%" class="sorting_disabled">{{ $order->comments }} </td>
                                <td style="width: 5%" class="sorting_disabled">
                                    <button class="btn btn-primary" type="button" data-toggle="modal"
                                        data-target="#showorder{{ $order->id }}">
                                        <i class="mdi mdi-message-text-outline"></i>
                                    </button>
                                </td>
                                <td>
                                    @if (auth()->check() && auth()->user()->type == 'admin')
                                        <a href="{{ route('editorderstatus.edit', $order->uuid) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="mdi mdi-square-edit-outline text-white"></i>
                                            </button>
                                        </a>
                                    @endif
                                </td>
                                <td style="width: 5%" class="sorting_disabled">
                                    <form role="form" action="{{ route('orders.destroy', $order->uuid) }}"
                                        method="POST" onsubmit="return confirm('Delete order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal para exibir os detalhes do pedido -->
                            @include('modal.showorders', [
                                'order' => $order,
                                'id_drop' => $order->uuid,
                                'courierName' => $order->name,
                                'status' => $order->status,
                                'address' => $order->address,
                            ])
                        @endforeach
                    </tbody>
                </table>
                <br>
                <a href="{{ route('user.all') }}" type="submit" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
