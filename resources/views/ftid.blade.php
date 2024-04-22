@extends('layouts.master')

@section('title', 'FTID Painel')

@section('content')
@section('page-title', 'FTID Painel')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
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
                                <th style="width: 10%">Label</th>
                                <th style="width: 5%">Label Creation</th>
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <th style="width: 10%" class="sorting_disabled">Method</th>
                                <th style="width: 5%">Label Payment</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ftids as $ftid)
                                @if (auth()->user()->id == $ftid->user_id)
                                    <tr
                                        style="background-color:
                                        @if ($ftid->status == 'FTID Created') #85f36e;
                                        @elseif ($ftid->status == 'FTID Paid') #bfddf3;
                                        @elseif ($ftid->status == 'FTID Dropped') #cf9bcc;
                                        @elseif ($ftid->status == 'FTID Error') #ff9e8e; @endif ">
                                        <td>{{ $ftid->id }}</td>
                                        <td>{{ $ftid->user }}</td>
                                        <td>
                                            @if ($ftid->carrier == 'Fedex')
                                                <a href="https://www.fedex.com/en-us/home.html"
                                                    target="_blank">Fedex</a>
                                            @elseif ($ftid->carrier == 'UPS')
                                                <a href="https://www.ups.com" target="_blank">UPS</a>
                                            @elseif ($ftid->carrier == 'USPS')
                                                <a href="https://tools.usps.com" target="_blank">USPS</a>
                                            @elseif ($ftid->carrier == 'Ontrac')
                                                <a href="https://west.ontrac.com/tracking.asp"
                                                    target="_blank">Ontrac</a>
                                            @elseif ($ftid->carrier == 'Lasership')
                                                <a href="https://www.ordertracker.com/couriers/lasership"
                                                    target="_blank">Lasership</a>
                                            @elseif ($ftid->carrier == 'DHL')
                                                <a href="https://www.dhl.com/us-en/home/tracking.html?locale=true"
                                                    target="_blank">DHL</a>
                                            @elseif ($ftid->carrier == 'Canadapost')
                                                <a href="https://www.canadapost-postescanada.ca/track-reperage/en#/home"
                                                    target="_blank">Canadapost</a>
                                            @elseif ($ftid->carrier == 'Porulator')
                                                <a href="https://www.purolatormarketing.com/2017/tracker/tracking-details-single.html"
                                                    target="_blank">Porulator</a>
                                            @elseif ($ftid->carrier == 'Australian')
                                                <a href="https://auspost.com.au/mypost/track/search"
                                                    target="_blank">Australian post</a>
                                            @elseif ($ftid->carrier == 'Amazon')
                                                <a href="https://track.amazon.com/" target="_blank">Amazon</a>
                                            @endif
                                        </td>
                                        <td>{{ $ftid->tracking }}</td>
                                        <td>{{ $ftid->store }}</td>
                                        <td><a href="{{ asset('storage/labels/' . $ftid->label) }}" target="_blank">Open
                                                Label</a></td>
                                        <td>{{ $ftid->label_creation_date }}</td>
                                        <td><b>{{ $ftid->status }}</b></td>
                                        <td>{{ $ftid->method }}</td>
                                        <td>{{ $ftid->label_payment_date }}</td>
                                        <td>
                                            @if (auth()->check() && auth()->user()->admin == 'A_HaQD1SkWsGN0tYW8DOZLuTm61')
                                                <a href="{{ route('editftid.edit', $ftid->id) }}" style="width: 100%">
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="mdi mdi-square-edit-outline text-white"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if (auth()->check())
                                                <form role="form" action="{{ route('ftid.destroy', $ftid->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this FTID?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if (auth()->check())
                        <div>
                            <a href="{{ route('createftid') }}"><button class="btn btn-primary">Create
                                    FTID</button></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
