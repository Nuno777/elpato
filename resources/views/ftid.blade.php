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
                                <th style="width: 10%">User</th>
                                <th style="width: 25%" class="sorting_disabled">Carrier</th>
                                <th style="width: 25%" class="sorting_disabled">Tracking</th>
                                <th style="width: 10%" class="sorting_disabled">Store</th>
                                <th style="width: 10%" class="sorting_disabled">Label</th>
                                <th style="width: 15%" class="sorting_disabled">Status</th>
                                <th style="width: 10%" class="sorting_disabled">Method</th>
                                <th style="width: 5%">Label Creation</th>
                                <th style="width: 5%">Label Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ftids as $ftid)
                                <tr>
                                    <td>{{ $ftid->id }}</td>
                                    <td>{{ $ftid->user }}</td>
                                    <td>{{ $ftid->carrier }}</td>
                                    <td>{{ $ftid->tracking }}</td>
                                    <td>{{ $ftid->store }}</td>
                                    <td>{{ $ftid->status }}</td>
                                    <td>{{ $ftid->method }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (auth()->check())
                    <div>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#createftid">Create FTID</button>
                        </td>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('modal.createftid')

@endsection
