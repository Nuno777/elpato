@extends('layouts.master')

@section('title', 'User FTIDs')

@section('content')
@section('page-title', 'User FTIDs')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <h2>FTIDs for {{ $user->name }}</h2>
                <div class="collapse" id="collapse-data-tables">
                </div>
                <div class="table-responsive">
                    <table id="productsTable" class="table table-active table-product" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">User</th>
                                <th style="width: 5%" class="sorting_disabled">Carrier</th>
                                <th style="width: 15%" class="sorting_disabled">Tracking</th>
                                <th style="width: 10%" class="sorting_disabled">Store</th>
                                <th style="width: 8%">Label</th>
                                <th style="width: 5%">Label Creation</th>
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <th style="width: 5%" class="sorting_disabled">Method</th>
                                <th style="width: 5%">Comments</th>
                                <th style="width: 5%">Label Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ftids as $ftid)
                                <tr
                                    style="background-color:
                                        @if ($ftid->status == 'FTID Created') #85f36e;
                                        @elseif ($ftid->status == 'FTID Paid') #bfddf3;
                                        @elseif ($ftid->status == 'FTID Dropped') #cf9bcc;
                                        @elseif ($ftid->status == 'FTID Error') #ff9e8e; @endif ">
                                    <td>{{ $ftid->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $ftid->carrier }}</td>
                                    <td>
                                        @if ($ftid->carrier == 'Fedex')
                                            <a href="https://www.fedex.com/fedextrack/no-results-found?trknbr={{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'UPS')
                                            <a href="https://www.ups.com/track?track=yes&trackNums={{ $ftid->tracking }}&loc=en_US&requester=ST/trackdetails"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'USPS')
                                            <a href="https://www.usps.com/search/results.htm?keyword={{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'Ontrac')
                                            <a href="https://www.ontrac.com/tracking/?number={{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'Lasership')
                                            <a href="https://www.ordertracker.com/track/{{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'DHL')
                                            <a href="https://www.dhl.com/us-en/home/tracking/tracking-global-forwarding.html?submit=1&tracking-id={{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'Canadapost')
                                            <a href="https://www.canadapost-postescanada.ca/track-reperage/en#/search?searchFor={{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'Purolator')
                                            <!-- Corrigido o nome do carrier -->
                                            <a href="https://www.purolator.com/en/shipping/tracker?pins={{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'Australian')
                                            <a href="https://auspost.com.au/mypost/track/details/{{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @elseif ($ftid->carrier == 'Amazon')
                                            <a href="https://track.amazon.com/tracking/{{ $ftid->tracking }}"
                                                target="_blank">{{ $ftid->tracking }}</a>
                                        @endif
                                    </td>
                                    <td>{{ $ftid->store }}</td>
                                    <td><a href="{{ asset('/storage/labels/' . $ftid->label) }}" target="_blank">Open
                                            Label</a></td>
                                    <td>{{ $ftid->label_creation_date }}</td>
                                    <td><b>{{ $ftid->status }}</b></td>
                                    <td>{{ $ftid->method }}</td>
                                    <td>{{ $ftid->comments }}</td>
                                    <td>{{ $ftid->label_payment_date }}</td>
                                    <td>
                                        <a href="{{ route('editftidstatus.edit', $ftid->id) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-dark">
                                                <i class="mdi mdi-square-edit-outline text-white"></i>
                                            </button>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
