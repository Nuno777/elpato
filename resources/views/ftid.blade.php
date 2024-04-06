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
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <th style="width: 10%" class="sorting_disabled">Method</th>
                                <th style="width: 5%">Label Creation</th>
                                <th style="width: 5%">Label Payment</th>
                                <th style="width: 5%">Label</th>
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
                                        <td>{{ $ftid->carrier }}</td>
                                        <td>{{ $ftid->tracking }}</td>
                                        <td>{{ $ftid->store }}</td>
                                        <td>{{ $ftid->status }}</td>
                                        <td>{{ $ftid->method }}</td>
                                        <td>{{ $ftid->label_creation_date }}</td>
                                        <td>{{ $ftid->label_payment_date }}</td>
                                        <td><a href="{{ asset('storage/labels/' . $ftid->label) }}">Abrir PDF</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @if (auth()->check())
                        <div>
                            <a href="{{ route('createftid') }}"><button class="btn btn-primary">Create FTID</button></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
