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
                                <th style="width: 5%">Drop</th>
                                <th style="width: 25%" class="sorting_disabled">Name</th>
                                <th style="width: 25%" class="sorting_disabled">Address</th>
                                <th style="width: 10%" class="sorting_disabled">Courier Packages</th>
                                <th style="width: 15%" class="sorting_disabled">Notes</th>
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <th style="width: 5%">Type</th>
                                <th style="width: 5%">Expired At</th>
                                <th style="width: 5%">Personal Notes</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    @if (auth()->check())
                        <div>
                            <a href="{{ route('createdrops') }}"><button class="btn btn-primary">Create FTID</button></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
