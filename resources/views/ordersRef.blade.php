@extends('layouts.master')

@section('title', 'Orders Refund')

@section('content')
@section('page-title', 'Orders Refund')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">
                </div>
                <table id="productsTable" class="table table-active table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Product</th>
                            <th>Shop</th>
                            <th style="width: 5%" class="sorting_disabled">Tracking</th>
                            <th style="width: 15%" class="sorting_disabled">Code</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderRef as $orderRef)
                            @if (auth()->user()->id == $orderRef->user_id)
                                <tr
                                    style="background-color:
                                    @if ($orderRef->status == 'Ready') #85f36e;
                                    @elseif ($orderRef->status == 'Suspense') #838383;
                                    @elseif ($orderRef->status == 'Dont send') #fff085;
                                    @elseif ($orderRef->status == 'Problem') #ff9e8e;
                                    @elseif ($orderRef->status == 'Received') #b491c8;
                                    @elseif ($orderRef->status == 'Sent to buyer') #ffb74d;
                                    @elseif ($orderRef->status == 'Waiting payment') #99d18f; @endif">
                                    <td class="sorting_disabled">{{ $orderRef->user }}</td>
                                    <td class="sorting_disabled">{{ $orderRef->product }}</td>
                                    <td class="sorting_disabled">{{ $orderRef->shop }}</td>
                                    <td class="sorting_disabled">{{ $orderRef->tracking }}</td>
                                    <td class="sorting_disabled">{{ $orderRef->code }}</td>
                                    <td class="sorting_disabled"><b>{{ $orderRef->status }}</b></td>
                                    <td class="sorting_disabled">{{ $orderRef->comments }} </td>
                                    <td style="width: 5%" class="sorting_disabled">
                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#showorder{{ $orderRef->slug }}"> <i
                                                class="mdi mdi-message-text-outline"></i>
                                        </button>
                                    </td>
                                    <td style="width: 5%" class="sorting_disabled">
                                        <a href="{{ route('editorder.edit', $orderRef->slug) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="mdi mdi-square-edit-outline text-white"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td style="width: 5%" class="sorting_disabled">
                                        <form role="form" action="{{ route('orders.destroy', $orderRef->slug) }}"
                                            method="POST" onsubmit="return confirm('Delete order?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOrderRef">
                        Create Order Refund
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('order_ref.modalcreateref')
@endsection
@push('scripts')
<script src="{{ asset('js/colortabledrops.js') }}"></script>
@endpush
