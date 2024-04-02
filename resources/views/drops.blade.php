@extends('layouts.master')

@section('title', 'Dashboard Drops')

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
                                <th style="width: 5%">ID</th>
                                <th style="width: 25%" class="sorting_disabled">Name</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 25%" class="sorting_disabled">Address</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 10%" class="sorting_disabled">Courier Packages</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 10%" class="sorting_disabled">Notes</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 10%" class="sorting_disabled">Status</th>
                                <!-- Adicionando a classe sorting_disabled -->
                                <th style="width: 5%">Type</th>
                                <th style="width: 5%">Expired At</th>
                                <th style="width: 5%">Personal Notes</th>
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
                                    <td>{{ $drop->notes }}</td>
                                    <td>{{ $drop->status }}</td>
                                    <td>{{ $drop->type }}</td>
                                    <td>{{ $drop->expired }}</td>
                                    <td>{{ $drop->personalnotes }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal"
                                            data-target="#createorder{{ $drop->id_drop }}">
                                            <i class="mdi mdi-package-variant text-primary"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->admin == 5)
                                            <a href="{{ route('editdrops.edit', $drop->id) }}" style="width: 100%">
                                                <i class="mdi mdi-pencil text-warning"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->admin == 5)
                                            <form role="form" action="{{ route('drops.destroy', $drop->id) }}"
                                                method="POST" onsubmit="return confirm('Delete Drop?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="link"
                                                    style="background-color: transparent; border:none">
                                                    <i class="mdi mdi-trash-can text-danger" data-toggle="tooltip"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @include('modal.createorders', ['courierName' => $drop->name])
                            @endforeach
                        </tbody>
                    </table>
                    @if (auth()->check() && auth()->user()->admin == 5)
                        <div>
                            <a href="{{ route('createdrops') }}"><button class="btn btn-primary">Create
                                    Drop</button></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
