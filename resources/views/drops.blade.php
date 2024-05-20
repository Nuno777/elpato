@extends('layouts.master')

@section('title', 'Drops Painel')

@section('content')
@section('page-title', 'Drops Painel')

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
                                <th style="width: 20%" class="sorting_disabled">Courier</th>
                                <th style="width: 25%" class="sorting_disabled">Address</th>
                                <th style="width: 5%" class="sorting_disabled">Courier <br> Package</th>
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <th style="width: 15%" class="sorting_disabled">Notes</th>
                                <th style="width: 5%">Type</th>
                                <th style="width: 5%">Expired At</th>
                                <th style="width: 5%">Personal <br> Notes</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drops as $drop)
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
                                    <td>{{ \Carbon\Carbon::parse($drop->expired)->format('j/F/Y') }}</td>
                                    <td>{{ $drop->personalnotes }}</td>

                                    <td>
                                        @if (auth()->user()->type == 'worker')
                                            @if ($drop->status == 'Problem' || $drop->status == 'Suspense' || $drop->status == 'Dont send')
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#requestDropModal{{ $drop->id }}">
                                                    <i class="mdi mdi-autorenew"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>


                                    <td>
                                        @if ($drop->status == 'Ready')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#createorder{{ $drop->id_drop }} ">
                                                <i class="mdi mdi-package-variant "></i>
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        @if (auth()->check() && auth()->user()->type == 'admin')
                                            <a href="{{ route('editdrops.edit', $drop->id) }}" style="width: 100%">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="mdi mdi-square-edit-outline text-white"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->type == 'admin')
                                            <form role="form" action="{{ route('drops.destroy', $drop->id) }}"
                                                method="POST" onsubmit="return confirm('Delete Drop?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>

                                </tr>
                                @include('modal.createorders', [
                                    'id_drop' => $drop->id_drop,
                                    'courierName' => $drop->name,
                                    'status' => $drop->status,
                                    'address' => $drop->address,
                                    'notes' => $drop->notes,
                                ])

                                @include('modal.assigndrop', [
                                    'id_drop' => $drop->id_drop,
                                ])

                                @include('modal.requestdrop', [
                                    'id_drop' => $drop->id_drop,
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    @if (auth()->check() && auth()->user()->type == 'admin')
                        <div>
                            <a href="{{ route('createdrops') }}"><button class="btn btn-primary">Create
                                    Drop</button></a>
                            @if (count($drops) > 0)
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#assigndrop">
                                    Assign Drop
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
