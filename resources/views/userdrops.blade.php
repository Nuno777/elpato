@extends('layouts.master')

@section('title', 'Assigned Drop')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-default">
                <div class="card-body">
                    <h1>Assigned Drop for {{ $user->name }}</h1>
                    @if ($drop)
                        <div class="collapse" id="collapse-data-tables">
                        </div>
                        <div class="table-responsive">
                            <table id="productsTable" class="table table-active table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Drop</th>
                                        <th style="width: 20%" class="sorting_disabled">Courier</th>
                                        <th style="width: 25%" class="sorting_disabled">Address</th>
                                        <th style="width: 5%" class="sorting_disabled">Courier <br> Package</th>
                                        <th style="width: 5%" class="sorting_disabled">Status</th>
                                        <th style="width: 15%" class="sorting_disabled">Notes</th>
                                        <th style="width: 5%">Type</th>
                                        <th style="width: 5%">Expired At</th>
                                        <th style="width: 5%">Personal <br> Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $drop->id_drop }}</td>
                                        <td>{{ $drop->name }}</td>
                                        <td>{{ $drop->address }}</td>
                                        <td>{{ $drop->packages }}</td>
                                        <td><b>{{ $drop->status }}</b></td>
                                        <td>{{ $drop->notes }}</td>
                                        <td>{{ $drop->type }}</td>
                                        <td>{{ $drop->expired }}</td>
                                        <td>{{ $drop->personalnotes }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p>No drop assigned to this user.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

