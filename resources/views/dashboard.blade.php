@extends('layouts.master')

@section('title', 'Main Panel')

@section('content')
@section('page-title', 'Main Panel')

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
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.80443 5.60156C7.59109 5.60156 6.60749 6.58517 6.60749 7.79851C6.60749 9.01185 7.59109 9.99545 8.80443 9.99545C10.0178 9.99545 11.0014 9.01185 11.0014 7.79851C11.0014 6.58517 10.0178 5.60156 8.80443 5.60156ZM5.10749 7.79851C5.10749 5.75674 6.76267 4.10156 8.80443 4.10156C10.8462 4.10156 12.5014 5.75674 12.5014 7.79851C12.5014 9.84027 10.8462 11.4955 8.80443 11.4955C6.76267 11.4955 5.10749 9.84027 5.10749 7.79851ZM4.86252 15.3208C4.08769 16.0881 3.70377 17.0608 3.51705 17.8611C3.48384 18.0034 3.5211 18.1175 3.60712 18.2112C3.70161 18.3141 3.86659 18.3987 4.07591 18.3987H13.4249C13.6343 18.3987 13.7992 18.3141 13.8937 18.2112C13.9797 18.1175 14.017 18.0034 13.9838 17.8611C13.7971 17.0608 13.4132 16.0881 12.6383 15.3208C11.8821 14.572 10.6899 13.955 8.75042 13.955C6.81096 13.955 5.61877 14.572 4.86252 15.3208ZM3.8071 14.2549C4.87163 13.2009 6.45602 12.455 8.75042 12.455C11.0448 12.455 12.6292 13.2009 13.6937 14.2549C14.7397 15.2906 15.2207 16.5607 15.4446 17.5202C15.7658 18.8971 14.6071 19.8987 13.4249 19.8987H4.07591C2.89369 19.8987 1.73504 18.8971 2.05628 17.5202C2.28015 16.5607 2.76117 15.2906 3.8071 14.2549ZM15.3042 11.4955C14.4702 11.4955 13.7006 11.2193 13.0821 10.7533C13.3742 10.3314 13.6054 9.86419 13.7632 9.36432C14.1597 9.75463 14.7039 9.99545 15.3042 9.99545C16.5176 9.99545 17.5012 9.01185 17.5012 7.79851C17.5012 6.58517 16.5176 5.60156 15.3042 5.60156C14.7039 5.60156 14.1597 5.84239 13.7632 6.23271C13.6054 5.73284 13.3741 5.26561 13.082 4.84371C13.7006 4.37777 14.4702 4.10156 15.3042 4.10156C17.346 4.10156 19.0012 5.75674 19.0012 7.79851C19.0012 9.84027 17.346 11.4955 15.3042 11.4955ZM19.9248 19.8987H16.3901C16.7014 19.4736 16.9159 18.969 16.9827 18.3987H19.9248C20.1341 18.3987 20.2991 18.3141 20.3936 18.2112C20.4796 18.1175 20.5169 18.0034 20.4837 17.861C20.2969 17.0607 19.913 16.088 19.1382 15.3208C18.4047 14.5945 17.261 13.9921 15.4231 13.9566C15.2232 13.6945 14.9995 13.437 14.7491 13.1891C14.5144 12.9566 14.262 12.7384 13.9916 12.5362C14.3853 12.4831 14.8044 12.4549 15.2503 12.4549C17.5447 12.4549 19.1291 13.2008 20.1936 14.2549C21.2395 15.2906 21.7206 16.5607 21.9444 17.5202C22.2657 18.8971 21.107 19.8987 19.9248 19.8987Z"
                        fill />
                </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Customers</span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                        3,782
                    </h4>
                </div>

                <span
                    class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432C6.1236 1.37432 6.12391 1.37432 6.12422 1.37432C6.31631 1.37415 6.50845 1.44731 6.65505 1.59381L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z"
                            fill />
                    </svg>

                    11.01%
                </span>
            </div>
        </div>
        <!-- Metric Item End -->

        <!-- Metric Item Start -->
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                        fill />
                </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Orders</span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                        5,359
                    </h4>
                </div>

                <span
                    class="flex items-center gap-1 rounded-full bg-error-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257C5.8736 10.6257 5.8739 10.6257 5.87421 10.6257C6.0663 10.6259 6.25845 10.5527 6.40505 10.4062L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z"
                            fill />
                    </svg>

                    9.05%
                </span>
            </div>
        </div>
        <!-- Metric Item End -->

        <!-- Metric Item Start -->
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                        fill />
                </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Orders</span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                        5,359
                    </h4>
                </div>

                <span
                    class="flex items-center gap-1 rounded-full bg-error-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257C5.8736 10.6257 5.8739 10.6257 5.87421 10.6257C6.0663 10.6259 6.25845 10.5527 6.40505 10.4062L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z"
                            fill />
                    </svg>

                    9.05%
                </span>
            </div>
        </div>
        <!-- Metric Item End -->

        <!-- Metric Item Start -->
        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.665 3.75621C11.8762 3.65064 12.1247 3.65064 12.3358 3.75621L18.7807 6.97856L12.3358 10.2009C12.1247 10.3065 11.8762 10.3065 11.665 10.2009L5.22014 6.97856L11.665 3.75621ZM4.29297 8.19203V16.0946C4.29297 16.3787 4.45347 16.6384 4.70757 16.7654L11.25 20.0366V11.6513C11.1631 11.6205 11.0777 11.5843 10.9942 11.5426L4.29297 8.19203ZM12.75 20.037L19.2933 16.7654C19.5474 16.6384 19.7079 16.3787 19.7079 16.0946V8.19202L13.0066 11.5426C12.9229 11.5844 12.8372 11.6208 12.75 11.6516V20.037ZM13.0066 2.41456C12.3732 2.09786 11.6277 2.09786 10.9942 2.41456L4.03676 5.89319C3.27449 6.27432 2.79297 7.05342 2.79297 7.90566V16.0946C2.79297 16.9469 3.27448 17.726 4.03676 18.1071L10.9942 21.5857L11.3296 20.9149L10.9942 21.5857C11.6277 21.9024 12.3732 21.9024 13.0066 21.5857L19.9641 18.1071C20.7264 17.726 21.2079 16.9469 21.2079 16.0946V7.90566C21.2079 7.05342 20.7264 6.27432 19.9641 5.89319L13.0066 2.41456Z"
                        fill />
                </svg>
            </div>

            <div class="mt-5 flex items-end justify-between">
                <div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Orders</span>
                    <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                        5,359
                    </h4>
                </div>

                <span
                    class="flex items-center gap-1 rounded-full bg-error-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                    <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257C5.8736 10.6257 5.8739 10.6257 5.87421 10.6257C6.0663 10.6259 6.25845 10.5527 6.40505 10.4062L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z"
                            fill />
                    </svg>

                    9.05%
                </span>
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
                        placeholder="Select dates" data-class="flatpickr-right"
                        readonly="readonly" />
                    <div
                        class="pointer-events-none absolute inset-0 left-4 right-auto flex items-center">
                        <svg class="fill-gray-700 dark:fill-gray-400" width="20"
                            height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
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

<div class="col-span-12">
    <!-- Table Four -->
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-4 flex flex-col gap-5 px-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Recent Orders
                </h3>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <form>
                    <div class="relative">
                        <button class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="fill-gray-500 dark:fill-gray-400" width="20"
                                height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z"
                                    fill />
                            </svg>
                        </button>
                        <input type="text" placeholder="Search..."
                            class="dark:bg-dark-900 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[300px]" />
                    </div>
                </form>
                <div>
                    <button
                        class="inline-flex h-10 items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                        <svg class="fill-white stroke-current dark:fill-gray-800" width="20"
                            height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.29004 5.90393H17.7067" stroke stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17.7075 14.0961H2.29085" stroke stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M12.0826 3.33331C13.5024 3.33331 14.6534 4.48431 14.6534 5.90414C14.6534 7.32398 13.5024 8.47498 12.0826 8.47498C10.6627 8.47498 9.51172 7.32398 9.51172 5.90415C9.51172 4.48432 10.6627 3.33331 12.0826 3.33331Z"
                                fill stroke stroke-width="1.5" />
                            <path
                                d="M7.91745 11.525C6.49762 11.525 5.34662 12.676 5.34662 14.0959C5.34661 15.5157 6.49762 16.6667 7.91745 16.6667C9.33728 16.6667 10.4883 15.5157 10.4883 14.0959C10.4883 12.676 9.33728 11.525 7.91745 11.525Z"
                                fill stroke stroke-width="1.5" />
                        </svg>

                        Filter
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-full overflow-x-auto">
            <div class="min-w-[1102px]">
                <!-- table header start -->
                <div
                    class="grid grid-cols-8 border-t border-gray-100 bg-gray-50 px-6 py-3 dark:border-gray-800 dark:bg-gray-900">
                    <div class="col-span-1 flex items-center">
                        <div x-data="{ checked: false }" class="flex items-center gap-3">
                            <div>
                                <span
                                    class="block text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                    Deal ID
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center">
                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                            Customer
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                            Product/Service
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                            Deal Value
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                            Close Date
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                            Status
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                            Action
                        </p>
                    </div>
                </div>
                <!-- table header end -->

                <!-- table body start -->
                <!-- table item -->
                <div
                    class="grid grid-cols-8 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                    <div class="col-span-1 flex items-center">
                        <div x-data="{ checked: false }" class="flex items-center gap-3">
                            <div>
                                <span
                                    class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    DE124321
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-100">
                                <span class="text-xs font-semibold text-brand-500"> JD
                                </span>
                            </div>
                            <div>
                                <span
                                    class="mb-0.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    John Doe
                                </span>
                                <span class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="d4bebbbcbab0b1bb94b3b9b5bdb8fab7bbb9">[email&#160;protected]</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            Software License
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            $18,50.34
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            2024-06-15
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p
                            class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-600 dark:bg-success-500/15 dark:text-success-500">
                            Complete
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <svg class="cursor-pointer fill-gray-700 hover:fill-error-500 dark:fill-gray-400 dark:hover:fill-error-500"
                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z"
                                fill />
                        </svg>
                    </div>
                </div>

                <!-- table item -->
                <div
                    class="grid grid-cols-8 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                    <div class="col-span-1 flex items-center">
                        <div x-data="{ checked: false }" class="flex items-center gap-3">
                            <div>
                                <span
                                    class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    DE124321
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-[#fdf2fa]">
                                <span class="text-xs font-semibold text-[#dd2590]"> KF
                                </span>
                            </div>

                            <div>
                                <span
                                    class="mb-0.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    Kierra Franci
                                </span>
                                <span class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="412a282433332001262c20282d6f222e2c">[email&#160;protected]</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            Software License
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            $18,50.34
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            2024-06-15
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p
                            class="rounded-full bg-error-50 px-2 py-0.5 text-theme-xs font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                            Canceled
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <svg class="cursor-pointer fill-gray-700 hover:fill-error-500 dark:fill-gray-400 dark:hover:fill-error-500"
                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z"
                                fill />
                        </svg>
                    </div>
                </div>

                <!-- table item -->
                <div
                    class="grid grid-cols-8 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:px-6">
                    <div class="col-span-1 flex items-center">
                        <div x-data="{ checked: false }" class="flex items-center gap-3">
                            <div>
                                <span
                                    class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    DE124321
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-[#f0f9ff]">
                                <span class="text-xs font-semibold text-[#0086c9]"> EW
                                </span>
                            </div>

                            <div>
                                <span
                                    class="mb-0.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    Emerson Workman
                                </span>
                                <span class="text-theme-sm text-gray-500 dark:text-gray-400">
                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="cfaaa2aabdbca0a18fa8a2aea6a3e1aca0a2">[email&#160;protected]</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            Software License
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            $18,50.34
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p class="text-theme-sm text-gray-700 dark:text-gray-400">
                            2024-06-15
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <p
                            class="rounded-full bg-warning-50 px-2 py-0.5 text-theme-xs font-medium text-warning-600 dark:bg-warning-500/15 dark:text-warning-400">
                            Pending
                        </p>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <svg class="cursor-pointer fill-gray-700 hover:fill-error-500 dark:fill-gray-400 dark:hover:fill-error-500"
                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z"
                                fill />
                        </svg>
                    </div>
                </div>

                <!-- table body end -->
            </div>
        </div>
    </div>
    <!-- Table Four -->
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/analytics/analytics_main.js') }}"></script>
@endpush
