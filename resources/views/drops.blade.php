@extends('layouts.master')

@section('title', 'Drops')

@section('content')
@section('page-title', 'Drops')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="row">
                    <div class="filter-container mb-3">
                        <form action="{{ route('drops.filter') }}" method="GET" class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="type" class="sr-only">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Filter Type</option>
                                    <option value="All" {{ request('type') == 'All' ? 'selected' : '' }}>All</option>
                                    <option value="Salaried" {{ request('type') == 'Salaried' ? 'selected' : '' }}>
                                        Salaried</option>
                                    <option value="Nonsalaried"
                                        {{ request('type') == 'Nonsalaried' ? 'selected' : '' }}>Nonsalaried</option>
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="status" class="sr-only">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Filter Status</option>
                                    <option value="Ready" {{ request('status') == 'Ready' ? 'selected' : '' }}>Ready
                                    </option>
                                    <option value="Problem" {{ request('status') == 'Problem' ? 'selected' : '' }}>
                                        Problem</option>
                                    <option value="Suspense" {{ request('status') == 'Suspense' ? 'selected' : '' }}>
                                        Suspense</option>
                                    <option value="Dont send" {{ request('status') == 'Dont send' ? 'selected' : '' }}>
                                        Dont send</option>
                                    <option value="Going to die"
                                        {{ request('status') == 'Going to die' ? 'selected' : '' }}>Going to die
                                    </option>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mb-2" id="filter-button"
                                    disabled>Filter</button>
                                <a href="{{ route('drops') }}" class="btn btn-secondary mb-2">Clear Filters</a>
                            </div>
                        </form>
                    </div>
                </div>

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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drops as $drop)
                                <tr
                                    style="background-color:
                                @if ($drop->status == 'Ready') #00CB38;
                                @elseif ($drop->status == 'Suspense') #515151;
                                @elseif ($drop->status == 'Dont send') #FFEA51;
                                @elseif ($drop->status == 'Problem') #FF7760;
                                @elseif ($drop->status == 'Going to die') #F8ABEE; @endif
                                color:
                                @if ($drop->status == 'Suspense') white; @else black; @endif">
                                    <td>{{ $drop->id_drop }}</td>
                                    <td>{{ $drop->name }}</td>
                                    <td>{{ $drop->address }}</td>
                                    <td>{{ $drop->packages }}</td>
                                    <td><b>{{ $drop->status }}</b></td>
                                    <td>{{ $drop->notes }}</td>
                                    <td>{{ $drop->type }}</td>
                                    <td>{{ date('d-m-Y', strtotime($drop->expired)) }}</td>
                                    <td>{{ $drop->personalnotes }}</td>
                                    <td>
                                        @if ($drop->status == 'Ready')
                                            <button type="button" class="btn btn-main" data-toggle="modal"
                                                data-target="#createorder{{ $drop->id_drop }} ">
                                                <i class="mdi mdi-package-variant "></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->type == 'admin')
                                            <a href="{{ route('editdrops.edit', $drop->slug) }}" style="width: 100%">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="mdi mdi-square-edit-outline text-white"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->check() && auth()->user()->type == 'admin')
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteModal{{ $drop->slug }}">
                                                <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                            </button>
                                            <div class="modal fade" id="deleteModal{{ $drop->slug }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $drop->slug }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $drop->slug }}">Delete Drop
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>To confirm the deletion of this drop, type:</p>
                                                            <p><strong>delete-{{ $drop->id_drop }}</strong></p>
                                                            <br>
                                                            <input type="text" id="deleteInput{{ $drop->slug }}"
                                                                class="form-control" placeholder="Type here to confirm"
                                                                oninput="validateInput('{{ $drop->slug }}', '{{ $drop->id_drop }}')">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form role="form"
                                                                action="{{ route('drops.destroy', $drop->slug) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="confirmation_text"
                                                                    id="confirmationText{{ $drop->slug }}">
                                                                <button type="submit"
                                                                    id="deleteButton{{ $drop->slug }}"
                                                                    class="btn btn-danger" disabled>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        @if (auth()->user()->type == 'worker')
                                            @if (
                                                $drop->status == 'Problem' ||
                                                    $drop->status == 'Suspense' ||
                                                    $drop->status == 'Dont send' ||
                                                    $drop->status == 'Going to die')
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#requestDropModal{{ $drop->slug }}">
                                                    <i class="mdi mdi-autorenew"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        @if (auth()->user()->type == 'worker')
                                            @if (
                                                $drop->status == 'Problem' ||
                                                    $drop->status == 'Suspense' ||
                                                    $drop->status == 'Dont send' ||
                                                    $drop->status == 'Going to die')
                                                <a tabindex="0" class="btn btn-info" role="button"
                                                    data-toggle="popover" data-trigger="focus"
                                                    title="Problems with the Drop?"
                                                    data-content="You have a package on the way, and the drop is having issues? Send a message on Telegram to @ElPato_drops , and they'll help you recover the package to the fullest."><i
                                                        class="mdi mdi-comment-question-outline"></i></a>
                                            @endif
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

                                @include('modal.showdrops', [
                                    'id_drop' => $drop->id_drop,
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        @if (auth()->check() && auth()->user()->type == 'admin')
                            <button class="btn btn-primary" data-toggle="modal" data-target="#createDropModal">Create
                                Drop</button>
                            @if (count($drops) > 0)
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#assigndrop">
                                    Assign Drop
                                </button>
                            @endif
                        @endif
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#showdrop">
                            <i class="mdi mdi-telegram"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('drops.createdrops')

@endsection
@push('scripts')
<script src="{{ asset('js/drop/filterbutton.js') }}"></script>
@endpush
