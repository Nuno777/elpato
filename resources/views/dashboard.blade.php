@extends('layouts.master')

@section('title', 'Main Panel')

@section('content')
@section('page-title', 'Main Panel')

<div class="content-wrapper">
    <div class="content">
        <div class="alert alert-warning alert-icon" role="alert">
            <i class="mdi mdi-bell-outline"></i> <b style="color:#000;">Our latest update, Telegram bot for receiving
                updates on drops, click <a href="https://t.me/elpatomessagebot" target="_blank">here</a> to go directly to
                the bot!</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
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

        @if ($messages->isNotEmpty())
            <div class="email-wrapper rounded border bg-white">
                <div class="row no-gutters ">
                    <div class="col-lg-8 col-xl-9 col-xxl-12">
                        <div class="email-right-column p-4 p-xl-5">
                            <div class="email-right-header mb-5">
                                <div class="head-left-options">
                                    <h1>Your Messages</h1>
                                </div>
                            </div>
                            <div class="border border-top-0 rounded table-responsive email-list">
                                <table class="table mb-0 table-email">
                                    <tbody>
                                        @foreach ($messages as $message)
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
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- modal --}}
            @foreach ($messages as $message)
                <div class="modal fade" id="viewmessage{{ $message->drop->slug }}" tabindex="-1" role="dialog"
                    aria-labelledby="viewmessageLabel" aria-hidden="true">

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
            @endforeach

        @endif

    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/analytics/analytics_main.js') }}"></script>
@endpush
