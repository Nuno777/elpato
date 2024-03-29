@extends('layouts.master')

@section('title', 'Dashboard Drops')

@section('content')
@section('page-title', 'Drops Painel')

<div class="content-wrapper">
    <div class="content">

        <div class="card card-default">
            <div class="card-header">
                <a href="{{ route('createdrops') }}"><button class="btn btn-primary">Create Drop</button></a>
            </div>
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">
                </div>
                <table id="productsTable" class="table table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Courier Packages</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Expired At</th>
                            <th>Personal Notes</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drops as $drop)
                            <tr
                                style="background-color:
                                @if ($drop->status == 'Ready') #82FB6A;
                                @elseif ($drop->status == 'Suspense') #424945;
                                @elseif ($drop->status == 'DontSend') #F1DD50;
                                @elseif ($drop->status == 'Problem') #FF7059; @endif
                                ">
                                <td>{{ $drop->id_drop }}</td>
                                <td>{{ $drop->name }}</td>
                                <td>{{ $drop->address }}</td>
                                <td>{{ $drop->packages }}</td>
                                <td>{{ $drop->notes }}</td>
                                <td>{{ $drop->status }}</td>
                                <td>{{ $drop->type }}</td>
                                <td>{{ $drop->expired }}</td>
                                <td>{{ $drop->personalnotes }}</td>
                                <td><a href="#" style="width: 100%">
                                        <i class="mdi mdi-package-variant text-success"></i>
                                    </a>
                                </td>
                                <td>
                                    <form role="form" action="{{ route('drops.destroy', $drop->id) }}"
                                        method="POST" onsubmit="return confirm('Delete Drop?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link"
                                            style="background-color: transparent; border:none">
                                            <i class="mdi mdi-trash-can text-danger" data-toogle="tooltip"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
