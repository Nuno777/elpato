@extends('layouts.master')

@section('title', 'Drops')

@section('content')
@section('page-title', 'Drops')

{{-- <div class="content-wrapper">
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
                                            @if ($drop->status == 'Problem' || $drop->status == 'Suspense' || $drop->status == 'Dont send' || $drop->status == 'Going to die')
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#requestDropModal{{ $drop->slug }}">
                                                    <i class="mdi mdi-autorenew"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        @if (auth()->user()->type == 'worker')
                                            @if ($drop->status == 'Problem' || $drop->status == 'Suspense' || $drop->status == 'Dont send' || $drop->status == 'Going to die')
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
@include('drops.createdrops') --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="mb-4 flex flex-col  gap-5 px-6 sm:flex-row col-span-12">

    @if (auth()->check() && auth()->user()->type == 'admin')

        <div x-data="{ createdrop: false }">
            <button
                class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                @click="createdrop = !createdrop">
                Create Drop
            </button>

            @include('drops.createdrops')

        </div>

        @if (count($drops) > 0)
            <button data-toggle="modal" data-target="#assigndrop"
                class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                Assign Drop
            </button>
        @endif
    @endif

    <button data-toggle="modal" data-target="#showdrop"
        class="px-4 py-3 text-sm font-medium text-white rounded-lg bg-blue-light-500 shadow-theme-xs hover:bg-blue-light-600">
        <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M23.1117 4.49449C23.4296 2.94472 21.9074 1.65683 20.4317 2.227L2.3425 9.21601C0.694517 9.85273 0.621087 12.1572 2.22518 12.8975L6.1645 14.7157L8.03849 21.2746C8.13583 21.6153 8.40618 21.8791 8.74917 21.968C9.09216 22.0568 9.45658 21.9576 9.70712 21.707L12.5938 18.8203L16.6375 21.8531C17.8113 22.7334 19.5019 22.0922 19.7967 20.6549L23.1117 4.49449ZM3.0633 11.0816L21.1525 4.0926L17.8375 20.2531L13.1 16.6999C12.7019 16.4013 12.1448 16.4409 11.7929 16.7928L10.5565 18.0292L10.928 15.9861L18.2071 8.70703C18.5614 8.35278 18.5988 7.79106 18.2947 7.39293C17.9906 6.99479 17.4389 6.88312 17.0039 7.13168L6.95124 12.876L3.0633 11.0816ZM8.17695 14.4791L8.78333 16.6015L9.01614 15.321C9.05253 15.1209 9.14908 14.9366 9.29291 14.7928L11.5128 12.573L8.17695 14.4791Z"
                fill />
        </svg>
    </button>
</div>
<div class="col-span-12">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        <!-- Table Four -->
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

            <div class="mb-4 flex flex-col gap-5 px-6 sm:flex-row sm:items-center sm:justify-between">
                <form action="{{ route('drops.filter') }}" method="GET" class="flex gap-2 w-full">
                    <div class="relative bg-transparent w-1/2">
                        <select
                            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <option value="">Select Type</option>
                            <option value="All" {{ request('type') == 'All' ? 'selected' : '' }}>All</option>
                            <option value="Salaried" {{ request('type') == 'Salaried' ? 'selected' : '' }}>Salaried
                            </option>
                            <option value="Nonsalaried" {{ request('type') == 'Nonsalaried' ? 'selected' : '' }}>
                                Nonsalaried</option>
                        </select>
                    </div>

                    <div class="relative bg-transparent w-1/2">
                        <select name="status" id="status"
                            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            <option value="">Select Status</option>
                            <option value="Ready" {{ request('status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                            <option value="Problem" {{ request('status') == 'Problem' ? 'selected' : '' }}>Problem
                            </option>
                            <option value="Suspense" {{ request('status') == 'Suspense' ? 'selected' : '' }}>Suspense
                            </option>
                            <option value="Dont send" {{ request('status') == 'Dont send' ? 'selected' : '' }}>Dont send
                            </option>
                            <option value="Going to die" {{ request('status') == 'Going to die' ? 'selected' : '' }}>
                                Going to die</option>
                        </select>
                    </div>

                    <button type="submit" id="filter-button"
                        class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        Filter
                    </button>

                    <a href="{{ route('drops') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
                        Clear Filters
                    </a>
                </form>
            </div>

            <div class="mb-4 flex flex-col gap-5 px-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <form>
                        <div class="relative">
                            <button class="absolute left-4 top-1/2 -translate-y-1/2">
                                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z"
                                        fill="" />
                                </svg>
                            </button>
                            <input type="text" placeholder="Search..."
                                class="dark:bg-dark-900 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[300px]" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="max-w-full overflow-x-auto">
                <div class="min-w-[1102px]">
                    <!-- table header start -->
                    <div
                        class="grid grid-cols-12 border-t border-gray-100 bg-gray-50 px-6 py-3 dark:border-gray-800 dark:bg-gray-900">
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Drop
                            </p>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Courier
                            </p>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Address
                            </p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Courier Package
                            </p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Status
                            </p>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Notes
                            </p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Type
                            </p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Expired At
                            </p>
                        </div>
                        <div class="col-span-1 flex items-center justify-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                Action
                            </p>
                        </div>
                    </div>
                    <!-- table header end -->

                    @if ($drops->isEmpty())
                        <div class="grid grid-cols-8 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                            <div class="col-span-2 flex items-center">
                                <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                    There are currently no recent Drops.
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- table item -->
                        @foreach ($drops as $d)
                            <div
                                class="grid grid-cols-12 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                                <div class="col-span-1 flex items-center">
                                    <span
                                        class="mb-0.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                        {{ $d->id_drop }}
                                    </span>
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <div class="flex items-center">
                                        <span
                                            class="mb-0.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                            {{ $d->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->address }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->packages }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    @php
                                        $dropStatus = strtolower(trim($d->status));
                                    @endphp

                                    @if ($dropStatus === 'ready')
                                        <p
                                            class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                                            {{ $d->status }}
                                        </p>
                                    @elseif ($dropStatus === 'problem')
                                        <p
                                            class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                            {{ $d->status }}
                                        </p>
                                    @elseif ($dropStatus === 'suspense')
                                        <p
                                            class="rounded-full bg-secondary-50 px-2 py-0.5 text-theme-xs font-medium text-secondary-600 dark:bg-secondary-500/15 dark:text-secondary-500">
                                            {{ $d->status }}
                                        </p>
                                    @elseif ($dropStatus === 'pending')
                                        <p
                                            class="rounded-full bg-warning-50 px-2 py-0.5 text-theme-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-400">
                                            {{ $d->status }}
                                        </p>
                                    @elseif ($dropStatus === 'canceled')
                                        <p
                                            class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                            {{ $d->status }}
                                        </p>
                                    @else
                                        <p
                                            class="rounded-full bg-gray-50 px-2 py-0.5 text-theme-xs font-medium text-gray-600 dark:bg-gray-500/15 dark:text-gray-400">
                                            {{ $d->status }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->notes }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->type }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ date('d-m-Y', strtotime($d->expired)) }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center justify-center">
                                    <div class="gap-4">
                                        @if ($d->status == 'Ready')
                                            <button type="button"
                                                class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90"
                                                data-toggle="modal" data-target="#createorder{{ $d->id_drop }} ">
                                                <svg class="fill-current" width="21" height="21"
                                                    viewBox="0 0 21 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                                                        fill />
                                                </svg>
                                            </button>
                                        @endif

                                        <button
                                            class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90">
                                            <svg class="fill-current" width="21" height="21"
                                                viewBox="0 0 21 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z"
                                                    fill=""></path>
                                            </svg>
                                        </button>

                                        <button
                                            class="text-gray-500 hover:text-error-500 dark:text-gray-400 dark:hover:text-error-500">
                                            <svg class="fill-current" width="21" height="21"
                                                viewBox="0 0 21 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.04142 4.29199C7.04142 3.04935 8.04878 2.04199 9.29142 2.04199H11.7081C12.9507 2.04199 13.9581 3.04935 13.9581 4.29199V4.54199H16.1252H17.166C17.5802 4.54199 17.916 4.87778 17.916 5.29199C17.916 5.70621 17.5802 6.04199 17.166 6.04199H16.8752V8.74687V13.7469V16.7087C16.8752 17.9513 15.8678 18.9587 14.6252 18.9587H6.37516C5.13252 18.9587 4.12516 17.9513 4.12516 16.7087V13.7469V8.74687V6.04199H3.8335C3.41928 6.04199 3.0835 5.70621 3.0835 5.29199C3.0835 4.87778 3.41928 4.54199 3.8335 4.54199H4.87516H7.04142V4.29199ZM15.3752 13.7469V8.74687V6.04199H13.9581H13.2081H7.79142H7.04142H5.62516V8.74687V13.7469V16.7087C5.62516 17.1229 5.96095 17.4587 6.37516 17.4587H14.6252C15.0394 17.4587 15.3752 17.1229 15.3752 16.7087V13.7469ZM8.54142 4.54199H12.4581V4.29199C12.4581 3.87778 12.1223 3.54199 11.7081 3.54199H9.29142C8.87721 3.54199 8.54142 3.87778 8.54142 4.29199V4.54199ZM8.8335 8.50033C9.24771 8.50033 9.5835 8.83611 9.5835 9.25033V14.2503C9.5835 14.6645 9.24771 15.0003 8.8335 15.0003C8.41928 15.0003 8.0835 14.6645 8.0835 14.2503V9.25033C8.0835 8.83611 8.41928 8.50033 8.8335 8.50033ZM12.9168 9.25033C12.9168 8.83611 12.581 8.50033 12.1668 8.50033C11.7526 8.50033 11.4168 8.83611 11.4168 9.25033V14.2503C11.4168 14.6645 11.7526 15.0003 12.1668 15.0003C12.581 15.0003 12.9168 14.6645 12.9168 14.2503V9.25033Z"
                                                    fill=""></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                    <!-- table body end -->
                </div>
            </div>
            <!-- Table Four -->
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/drop/filterbutton.js') }}"></script>
@endpush
