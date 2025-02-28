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
        <button data-toggle="modal" data-target="#createDropModal"
            class="inline-flex items-center gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
            Create Drop
        </button>
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
                                    <svg class="cursor-pointer fill-gray-700 hover:fill-error-500 dark:fill-gray-400 dark:hover:fill-error-500"
                                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z"
                                            fill="" />
                                    </svg>
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
