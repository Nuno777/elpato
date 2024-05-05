@extends('layouts.master')

@section('title', 'Assigned Drop')

@section('content')
@section('page-title', 'Assigned Drop')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <h1>Assigned Drop for <b>{{ $user->name }}</b></h1>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    style="background-color:
                                    @if ($drop->status == 'Ready') #85f36e;
                                    @elseif ($drop->status == 'Suspense') #838383;
                                    @elseif ($drop->status == 'Dont send') #fff085;
                                    @elseif ($drop->status == 'Problem') #ff9e8e; @endif
                                    color:
                                    @if ($drop->status == 'Suspense') white; @else black; @endif">
                                    <td>{{ $drop->id_drop }}</td>
                                    <td>{{ $drop->name }}</td>
                                    <td>{{ $drop->address }}</td>
                                    <td>{{ $drop->packages }}</td>
                                    <td><b>{{ $drop->status }}</b></td>
                                    <td>{{ $drop->notes }}</td>
                                    <td>{{ $drop->type }}</td>
                                    <td>{{ $drop->expired }}</td>
                                    <td>{{ $drop->personalnotes }}</td>
                                    <td>
                                        <form action="{{ route('remove.drop.worker') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="drop_id" value="{{ $drop->id }}">
                                            <button type="submit" class="btn btn-danger"><i class="mdi mdi-trash-can"
                                                    data-toggle="tooltip"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <a href="{{ route('drops') }}">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#assigndrop">
                                Assign Drop
                            </button>
                        </a>
                    </div>
                @else
                    <br>
                    <p>No drop assigned to this user.</p>
                    @if (auth()->check() && auth()->user()->type == 'admin')
                        <div>
                            <a href="{{ route('drops') }}"><button class="btn btn-primary">Create
                                    Drop</button></a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
