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
                <table id="ordersTable" class="table table-active table-order" style="width:100%">
                    <thead>
                        <tr>
                            <th>Drop</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Holder Name</th>
                            <th>Address</th>
                            <th style="width: 5%" class="sorting_disabled">Tracking</th>
                            <th style="width: 15%" class="sorting_disabled">Code</th>
                            <th>Shop</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Quant</th>
                            <th>Price</th>
                            <th>Delivery</th>
                            <th>Option</th>
                            <th>Pickup</th>
                            <th>Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr
                                style="background-color:
                                    @if ($order->status == 'Ready') #85f36e;
                                    @elseif ($order->status == 'Suspense') #838383;
                                    @elseif ($order->status == 'Dont send') #fff085;
                                    @elseif ($order->status == 'Problem') #ff9e8e; @endif
                                    color:
                                    @if ($order->status == 'Suspense') white; @else black; @endif
                                    ">
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
                                <td style="width: 5%" class="sorting_disabled">{{ $order->shop }}</td>
                                <td style="width: 5%" class="sorting_disabled"><b>{{ $order->status }}</b></td>
                                <td style="width: 15%" class="sorting_disabled">{{ $order->comments }} </td>
                                <td style="width: 15%" class="sorting_disabled">{{ $order->quant }} </td>
                                <td style="width: 15%" class="sorting_disabled">{{ $order->price }} </td>
                                <td style="width: 10%" class="sorting_disabled">{{ $order->delivery }} </td>
                                <td style="width: 15%" class="sorting_disabled">{{ $order->option }} </td>
                                <td style="width: 5%" class="sorting_disabled">{{ $order->pickup ? 'yes' : 'no' }}
                                </td>
                                <td style="width: 5%" class="sorting_disabled">{{ $order->signature ? 'yes' : 'no' }}
                                </td>

                            </tr>
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
