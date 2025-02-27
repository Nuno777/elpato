@extends('layouts.master')

@section('title', 'Panel')

@section('content')
@section('page-title', 'Panel')

{{-- <div class="content-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Drops</h2>
                        <div class="sub-title">
                            <a href="{{ route('drops') }}" class="badge badge-pill badge-primary">
                                <span class="mr-1">Go to the Drops</span>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ((auth()->check() && auth()->user()->type == 'admin') || auth()->user()->type == 'general')
                            <div class="text-left">
                                <span class="h1 d-block">{{ $dropCount }}</span>
                            </div>
                        @else
                            <div class="text-left">
                                <span class="h1 d-block">{{ $dropCount }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Orders</h2>
                        <div class="sub-title">
                            <a href="{{ route('orders') }}" class="badge badge-pill badge-primary"><span
                                    class="mr-1">Go to the Orders</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-left">
                            <span class="h1 d-block">{{ $orderCount }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ((auth()->check() && auth()->user()->type == 'admin') || auth()->user()->type == 'general')
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card-mini">
                        <div class="card-header">
                            <h2>FTID</h2>
                            <div class="sub-title">
                                <a href="{{ route('ftid') }}" class="badge badge-pill badge-primary"><span
                                        class="mr-1">Go
                                        to the FTIDs</span></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-left">
                                <span class="h1 d-block">{{ $ftidCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Analytics</h2>
                        <div class="sub-title">
                            <a href="" class="badge badge-pill badge-primary"><span class="mr-1">Go to the
                                    Analytics</span></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="text-left">
                            <span class="h1 d-block"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Daily Revenue (Last 7 Days) -->
            <div class="col-xl-4 col-sm-12">
                <div class="card card-default">
                    <div class="card-header border-bottom">
                        <h2>Daily Revenue (Last 7 Days)</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyRevenueChart"
                            data-daily-revenue="{{ json_encode($dailyRevenueData) }}"></canvas>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue (Current Year) -->
            <div class="col-xl-4 col-sm-12">
                <div class="card card-default">
                    <div class="card-header border-bottom">
                        <h2>Monthly Revenue (Current Year)</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyRevenueChart"
                            data-monthly-revenue="{{ json_encode($monthlyRevenueData) }}"></canvas>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-xl-4 col-sm-12">
                <div class="card card-default">
                    <div class="card-header border-bottom">
                        <h2>Total Revenue</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="totalRevenueChart" data-total-revenue="{{ $totalRevenue }}"></canvas>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->type == 'general' || auth()->user()->type == 'admin')
            <!-- Notifications Settings -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>New Drop Notifications</h2>
                </div>
                <div class="card-body">
                    @if ($drop->isEmpty())
                        <p>You currently have no Drops.</p>
                    @else
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white" scope="col" style="width: 5%" class="sorting_disabled">
                                        Drop
                                    </th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        Status</th>
                                    <th style="color: white" scope="col" style="width: 15%" class="sorting_disabled">
                                        Type</th>
                                    <th style="color: white" scope="col" style="width: 15%" class="sorting_disabled">
                                        Notes</th>
                                    <th style="color: white" scope="col" style="width: 15%" class="sorting_disabled">
                                        created Drop</th>
                                    <th style="color: white" scope="col" style="width: 15%"
                                        class="sorting_disabled">
                                        Expired Drop</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drop as $drop)
                                    <tr>
                                        <td scope="row"><b>{{ $drop->id_drop }}</b></td>
                                        <td>
                                            @php
                                                $dropStatus = strtolower(trim($drop->status));
                                            @endphp

                                            @if ($dropStatus === 'ready')
                                                <div class="badge badge-success">{{ $drop->status }}</div>
                                            @elseif ($dropStatus === 'problem')
                                                <div class="badge badge-danger">{{ $drop->status }}</div>
                                            @elseif ($dropStatus === 'suspense')
                                                <div class="badge badge-secondary">{{ $drop->status }}</div>
                                            @else
                                                <div class="badge badge-warning" style="color: white">
                                                    {{ $drop->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $drop->type }}</td>
                                        <td>{{ $drop->notes }}</td>

                                        <td>{{ $drop->created_at->format('j/F/Y') }}</td>
                                        <td>
                                            <div class="badge badge-danger">
                                                {{ \Carbon\Carbon::parse($drop->expired)->format('j/F/Y') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        @endif

        @if ($messages->isNotEmpty() && $messages->where('user_id', auth()->user()->id)->isNotEmpty())
            <!-- Verifica se o usuário logado tem mensagens -->
            <div class="email-wrapper rounded border bg-white">
                <div class="row no-gutters">
                    <div class="col-lg-8 col-xl-9 col-xxl-12">
                        <div class="email-right-column p-4 p-xl-5">
                            <div class="email-right-header mb-5">
                                <div class="head-left-options">
                                    <h1>Your Messages</h1> <!-- Só exibe este título se o usuário tiver mensagens -->
                                </div>
                            </div>
                            <div class="border border-top-0 rounded table-responsive email-list">
                                <table class="table mb-0 table-email">
                                    <tbody>
                                        @foreach ($messages as $message)
                                            @if ($message->user_id == auth()->user()->id)
                                                <!-- Exibe mensagens apenas do usuário logado -->
                                                <tr class="{{ $message->response ? 'read' : 'unread' }}">
                                                    <td class="mark-mail">
                                                        <i class="mdi mdi-truck"></i> {{ $message->drop->id_drop }}
                                                    </td>

                                                    <td>
                                                        <a type="button" data-toggle="modal"
                                                            data-target="#viewmessage{{ $message->drop->slug }}"
                                                            class="text-default d-inline-block text-smoke">
                                                            @if ($message->response)
                                                                <span
                                                                    class="badge {{ $message->response === 'yes' ? 'badge-success' : 'badge-danger' }}">
                                                                    {{ $message->response === 'yes' ? 'yes' : 'no' }}
                                                                </span>
                                                            @else
                                                                <span class="badge badge-primary">
                                                                    New
                                                                </span>
                                                            @endif
                                                            {{ $message->message }}
                                                        </a>
                                                    </td>

                                                    <td class="date">
                                                        {{ date('M d', strtotime($message->updated_at)) }}
                                                    </td>

                                                    <td class="date">
                                                        <p>Message Updated:
                                                            {{ date('H:i:s', strtotime($message->updated_at)) }}</p>
                                                    </td>
                                                    <td>
                                                        <a type="button" data-toggle="modal"
                                                            data-target="#viewmessage{{ $message->drop->slug }}"
                                                            class="btn btn-primary">
                                                            <i class="mdi mdi-message-text-outline"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->

            @foreach ($messages as $message)
                @if ($message->user_id == auth()->user()->id)
                    <!-- Verifica se a mensagem pertence ao usuário logado -->
                    <div class="modal fade" id="viewmessage{{ $message->drop->slug }}" tabindex="-1"
                        role="dialog" aria-labelledby="viewmessageLabel" aria-hidden="true">

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewmessageLabel">Message Reply</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" enctype="multipart/form-data" id="responseForm"
                                        action="{{ route('messages.update', ['message' => $message->drop->slug]) }}">

                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <textarea class="form-control" id="message" name="message" rows="6" type="text" style="resize: none"
                                                readonly required>{{ $message->message }}</textarea>
                                        </div>
                                        <label for="message">Response</label>
                                        <input class="form-control" type="text" name="response" id="response"
                                            readonly required
                                            value="{{ $message->response ? $message->response : 'Still no answer' }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div> --}}

<div class="col-span-12">
    <!-- Metric Group Four -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4">
        <!-- Metric Item Start -->
        <a href="{{ route('drops') }}">
            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                    <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3 3C1.34315 3 0 4.34315 0 6V15C0 16.3121 0.842366 17.4275 2.01581 17.8348C2.18436 19.6108 3.67994 21 5.5 21C7.26324 21 8.72194 19.6961 8.96456 18H15.0354C15.2781 19.6961 16.7368 21 18.5 21C20.3201 21 21.8156 19.6108 21.9842 17.8348C23.1576 17.4275 24 16.3121 24 15V10.7515C24 10.0248 23.7362 9.32283 23.2577 8.77596L20.8502 6.02449C20.2805 5.37344 19.4576 5 18.5925 5H16.8293C16.4175 3.83481 15.3062 3 14 3H3ZM4 17.4361V17.5639C4.03348 18.3634 4.69224 19.0013 5.5 19.0013C6.30776 19.0013 6.96652 18.3634 7 17.5639V17.4361C6.96652 16.6366 6.30776 15.9987 5.5 15.9987C4.69224 15.9987 4.03348 16.6366 4 17.4361ZM5.5 14C6.8962 14 8.10145 14.8175 8.66318 16H15.3368C15.8985 14.8175 17.1038 14 18.5 14C19.8245 14 20.9771 14.7357 21.5716 15.8207C21.8306 15.64 22 15.3398 22 15V11H17C15.8954 11 15 10.1046 15 9V6C15 5.44772 14.5523 5 14 5H3C2.44772 5 2 5.44772 2 6V15C2 15.3398 2.16945 15.64 2.42845 15.8207C3.02292 14.7357 4.17555 14 5.5 14ZM17 7V8C17 8.55229 17.4477 9 18 9H20.7962L19.345 7.34149C19.1552 7.12448 18.8808 7 18.5925 7H17ZM17 17.4361V17.5639C17.0335 18.3634 17.6922 19.0013 18.5 19.0013C19.3078 19.0013 19.9665 18.3634 20 17.5639V17.4361C19.9665 16.6366 19.3078 15.9987 18.5 15.9987C17.6922 15.9987 17.0335 16.6366 17 17.4361Z"
                            fill />
                    </svg>
                </div>

                <div class="mt-5 flex items-end justify-between">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Drops</span>
                        @if ((auth()->check() && auth()->user()->type == 'admin') || auth()->user()->type == 'general')
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                {{ $dropCount }}
                            </h4>
                        @else
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                {{ $dropCount }}
                            </h4>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        <!-- Metric Item End -->

        <!-- Metric Item Start -->
        <a href="{{ route('orders') }}">
            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                    <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                            fill />
                    </svg>
                </div>

                <div class="mt-5 flex items-end justify-between">
                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Orders</span>
                        <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                            {{ $orderCount }}
                        </h4>
                    </div>
                </div>
            </div>
        </a>
        <!-- Metric Item End -->

        <!-- Metric Item Start -->
        @if ((auth()->check() && auth()->user()->type == 'admin') || auth()->user()->type == 'general')
            <a href="{{ route('ftid') }}">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                        <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.29289 1.29289C9.48043 1.10536 9.73478 1 10 1H18C19.6569 1 21 2.34315 21 4V20C21 21.6569 19.6569 23 18 23H6C4.34315 23 3 21.6569 3 20V8C3 7.73478 3.10536 7.48043 3.29289 7.29289L9.29289 1.29289ZM18 3H11V8C11 8.55228 10.5523 9 10 9H5V20C5 20.5523 5.44772 21 6 21H18C18.5523 21 19 20.5523 19 20V4C19 3.44772 18.5523 3 18 3ZM6.41421 7H9V4.41421L6.41421 7ZM7 13C7 12.4477 7.44772 12 8 12H16C16.5523 12 17 12.4477 17 13C17 13.5523 16.5523 14 16 14H8C7.44772 14 7 13.5523 7 13ZM7 17C7 16.4477 7.44772 16 8 16H16C16.5523 16 17 16.4477 17 17C17 17.5523 16.5523 18 16 18H8C7.44772 18 7 17.5523 7 17Z"
                                fill />
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">FTID</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                {{ $ftidCount }}
                            </h4>
                        </div>
                    </div>
                </div>
            </a>
        @endif
        <!-- Metric Item End -->

        <!-- Metric Item Start -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 2C1 1.44772 1.44772 1 2 1C2.55228 1 3 1.44772 3 2V20C3 20.5523 3.44771 21 4 21L22 21C22.5523 21 23 21.4477 23 22C23 22.5523 22.5523 23 22 23H3C1.89543 23 1 22.1046 1 21V2Z"
                        fill />
                    <path
                        d="M19.9285 5.37139C20.1336 4.85861 19.8842 4.27664 19.3714 4.07152C18.8586 3.86641 18.2766 4.11583 18.0715 4.62861L14.8224 12.7513C14.6978 13.0628 14.3078 13.1656 14.0459 12.9561L11.0811 10.5843C10.3619 10.0089 9.29874 10.2116 8.84174 11.0114L5.13176 17.5039C4.85775 17.9834 5.02434 18.5942 5.50386 18.8682C5.98338 19.1423 6.59423 18.9757 6.86824 18.4961L9.9982 13.0187C10.1505 12.7521 10.5049 12.6846 10.7447 12.8764L13.849 15.3598C14.635 15.9886 15.805 15.6802 16.1788 14.7456L19.9285 5.37139Z"
                        fill />
                </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Analytics</span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">

                    </h4>
                </div>
            </div>
        </div>
        <!-- Metric Item End -->
    </div>
    <!-- Metric Group Four -->
</div>

<div class="col-span-12">
    <!-- ====== Chart Three Start -->
    <div
        class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
        <div class="mb-6 flex flex-col gap-5 sm:flex-row sm:justify-between">
            <div class="w-full">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Statistics
                </h3>
                <p class="mt-1 text-theme-sm text-gray-500 dark:text-gray-400">
                    Target you’ve set for each month
                </p>
            </div>

            <div class="flex w-full items-start gap-3 sm:justify-end">
                <div x-data="{ selected: 'overview' }"
                    class="inline-flex w-fit items-center gap-0.5 rounded-lg bg-gray-100 p-0.5 dark:bg-gray-900">
                    <button @click="selected = 'overview'"
                        :class="selected === 'overview' ?
                            'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="rounded-md px-3 py-2 text-theme-sm font-medium hover:text-gray-900 dark:hover:text-white">
                        Overview
                    </button>
                    <button @click="selected = 'sales'"
                        :class="selected === 'sales' ?
                            'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="rounded-md px-3 py-2 text-theme-sm font-medium hover:text-gray-900 dark:hover:text-white">
                        Sales
                    </button>
                    <button @click="selected = 'revenue'"
                        :class="selected === 'revenue' ?
                            'shadow-theme-xs text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="rounded-md px-3 py-2 text-theme-sm font-medium hover:text-gray-900 dark:hover:text-white">
                        Revenue
                    </button>
                </div>

                <div class="relative w-fit">
                    <input
                        class="datepicker h-10 w-full max-w-11 rounded-lg border border-gray-200 bg-white py-2.5 pl-[34px] pr-4 text-theme-sm font-medium text-gray-700 shadow-theme-xs focus:outline-none focus:ring-0 focus-visible:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 xl:max-w-fit xl:pl-11"
                        placeholder="Select dates" data-class="flatpickr-right" readonly="readonly" />
                    <div class="pointer-events-none absolute inset-0 left-4 right-auto flex items-center">
                        <svg class="fill-gray-700 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.66683 1.54199C7.08104 1.54199 7.41683 1.87778 7.41683 2.29199V3.00033H12.5835V2.29199C12.5835 1.87778 12.9193 1.54199 13.3335 1.54199C13.7477 1.54199 14.0835 1.87778 14.0835 2.29199V3.00033L15.4168 3.00033C16.5214 3.00033 17.4168 3.89576 17.4168 5.00033V7.50033V15.8337C17.4168 16.9382 16.5214 17.8337 15.4168 17.8337H4.5835C3.47893 17.8337 2.5835 16.9382 2.5835 15.8337V7.50033V5.00033C2.5835 3.89576 3.47893 3.00033 4.5835 3.00033L5.91683 3.00033V2.29199C5.91683 1.87778 6.25262 1.54199 6.66683 1.54199ZM6.66683 4.50033H4.5835C4.30735 4.50033 4.0835 4.72418 4.0835 5.00033V6.75033H15.9168V5.00033C15.9168 4.72418 15.693 4.50033 15.4168 4.50033H13.3335H6.66683ZM15.9168 8.25033H4.0835V15.8337C4.0835 16.1098 4.30735 16.3337 4.5835 16.3337H15.4168C15.693 16.3337 15.9168 16.1098 15.9168 15.8337V8.25033Z"
                                fill />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-scrollbar max-w-full overflow-x-auto">
            <div id="chartThree" class="-ml-4 -mr-5 min-w-[700px] pl-2"></div>
        </div>
    </div>
    <!-- ====== Chart Three End -->
</div>

@if (auth()->user()->type == 'general' || auth()->user()->type == 'admin')
    <div class="col-span-12">
        <!-- Table Four -->
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="mb-4 flex flex-col gap-5 px-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Recent Drops
                    </h3>
                </div>
            </div>

            <div class="max-w-full overflow-x-auto">
                <div class="min-w-[1102px]">
                    <!-- table header start -->
                    <div
                        class="grid grid-cols-8 border-t border-gray-100 bg-gray-50 px-6 py-3 dark:border-gray-800 dark:bg-gray-900">
                        <div class="col-span-1 flex items-center">
                            <span class="block text-theme-xs font-medium text-gray-500 dark:text-gray-400">Drop</span>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Status</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Type</p>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Notes</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Created Drop</p>
                        </div>
                        <div class="col-span-1 flex items-center">
                            <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Expired Drop</p>
                        </div>
                    </div>

                    @if ($drop->isEmpty())
                        <div
                            class="grid grid-cols-8 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                            <div class="col-span-2 flex items-center">
                                <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                    There are currently no recent Drops.
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- table body -->
                        @foreach ($drop as $d)
                            <div
                                class="grid grid-cols-8 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                                <div class="col-span-1 flex items-center">
                                    <span class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                        {{ $d->id_drop }}
                                    </span>
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

                                <div class="col-span-1 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->type }}
                                    </p>
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->notes }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                                        {{ $d->created_at->format('j/F/Y') }}
                                    </p>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    <p
                                        class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                                        {{ $d->expired ? \Carbon\Carbon::parse($d->expired)->format('j/F/Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
        <!-- Table Four -->
    </div>
@endif

@endsection
@push('scripts')
<script src="{{ asset('js/analytics/analytics_main.js') }}"></script>
@endpush
