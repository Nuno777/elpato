@extends('layouts.master')

@section('title', 'Admin Painel')

@section('content')
@section('page-title', 'Admin Painel')

<div class="content-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Create User</h2>
                        <div class="sub-title">
                            <a href="{{ route('createuser') }}" class="badge badge-pill badge-success"><span
                                    class="mr-1">Go
                                    to the Create User</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>All Users</h2>
                        <div class="sub-title">
                            <a href="{{ route('user.all') }}" class="badge badge-pill badge-success"><span
                                    class="mr-1">Go to the All Users</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All Users: {{ $userCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>All Orders</h2>
                        <div class="sub-title">
                            <a href="{{ route('orders.all') }}" class="badge badge-pill badge-success"><span
                                    class="mr-1">Go
                                    to the All Orders</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All Orders: {{ $ordersCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>All FTID</h2>
                        <div class="sub-title">
                            <a href="{{ route('ftid.all') }}" class="badge badge-pill badge-success"><span
                                    class="mr-1">Go to the
                                    All FTIDs</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All FTIDs: {{ $ftidCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->type == 'admin')
            <!-- Order Notifications Settings -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>New Orders Notifications</h2>
                </div>
                <div class="card-body">

                    @if ($orders->isEmpty())
                        <p>You currently have no Orders.</p>
                    @else
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white" scope="col" style="width: 5%" class="sorting_disabled">
                                        Drop</th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        User</th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        Product</th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        Status</th>
                                    <th style="color: white" scope="col" style="width: 15%" class="sorting_disabled">
                                        Notes</th>
                                    <th style="color: white" scope="col" style="width: 15%" class="sorting_disabled">
                                        created Drop</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td scope="row">{{ $order->id_drop }}</td>
                                        <td scope="row">{{ $order->user }}</td>
                                        <td scope="row">{{ $order->product }}</td>
                                        <td>
                                            @php
                                                $orderStatus = strtolower(trim($order->status));
                                            @endphp

                                            @if ($orderStatus === 'ready')
                                                <div class="badge badge-success">{{ $order->status }}</div>
                                            @elseif ($orderStatus === 'problem')
                                                <div class="badge badge-danger">{{ $order->status }}</div>
                                            @elseif ($orderStatus === 'suspense')
                                                <div class="badge badge-secondary">{{ $order->status }}</div>
                                            @else
                                                <div class="badge badge-warning" style="color: white">
                                                    {{ $order->status }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $order->comments }}</td>
                                        <td>{{ $order->created_at->format('j/F/Y - H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>


            <!-- FTID Notifications Settings -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>New FTID Notifications</h2>
                </div>
                <div class="card-body">

                    @if ($ftid->isEmpty())
                        <p>You currently have no FTID.</p>
                    @else
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="color: white" scope="col" style="width: 5%" class="sorting_disabled">#
                                    </th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        User
                                    </th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        Carrier</th>
                                    <th style="color: white" scope="col" style="width: 10%" class="sorting_disabled">
                                        label</th>
                                    <th style="color: white" scope="col" style="width: 5%" class="sorting_disabled">
                                        Status</th>
                                    <th style="color: white" scope="col" style="width: 10%"
                                        class="sorting_disabled">
                                        Label Payment</th>
                                    <th style="color: white" scope="col" style="width: 15%"
                                        class="sorting_disabled">
                                        created FTID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ftid as $ftid)
                                    <tr>
                                        <td scope="row">{{ $ftid->id }}</td>
                                        <td scope="row">{{ $ftid->user }}</td>
                                        <td scope="row">{{ $ftid->carrier }}</td>
                                        <td><a href="{{ asset('storage/labels/' . $ftid->label) }}"
                                                target="_blank">Open
                                                Label</a></td>
                                        <td>
                                            @php
                                                $ftidStatus = strtolower(trim($ftid->status));
                                            @endphp

                                            @if ($ftidStatus === 'ftid created')
                                                <div class="badge badge-success">{{ $ftid->status }}</div>
                                            @elseif ($ftidStatus === 'ftid paid')
                                                <div class="badge badge-success"
                                                    style="background-color: #bfddf3; color: black">
                                                    {{ $ftid->status }}
                                                </div>
                                            @elseif ($ftidStatus === 'ftid dropped')
                                                <div class="badge badge-success"
                                                    style="background-color: #cf9bcc; color: black">
                                                    {{ $ftid->status }}
                                                </div>
                                            @else
                                                <div class="badge badge-danger" style="color: white">
                                                    {{ $ftid->status }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($ftid->label_payment_date)->format('j/F') }}</td>
                                        <td>{{ $ftid->created_at->format('j/F/Y - H:i:s') }}</td>
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
                            <!-- Email Right Header -->
                            <div class="email-right-header mb-5">
                                <!-- head left option -->
                                <div class="head-left-options">
                                    <h2>All Message</h2>
                                </div>
                                <!-- head right option -->
                                <div class="head-right-options">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn border btn-pill">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </button>
                                        <button type="button" class="btn border btn-pill">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </button>
                                    </div>
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

                                                <td class="mark-mail">
                                                    {{ $message->user->name }}
                                                </td>

                                                <td class="mark-mail">
                                                    Telegram: {{ $message->user->telegram }}
                                                </td>

                                                <td>
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#viewmessage{{ $message->id }}"
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
                                                        data-target="#viewmessage{{ $message->id }}"
                                                        class="btn btn-primary">
                                                        <i class="mdi mdi-message-text-outline"></i>
                                                    </a>
                                                </td>

                                                <td>
                                                    <form
                                                        action="{{ route('messages.destroy', ['id' => $message->id]) }}"
                                                        method="POST" onsubmit="return confirm('Remove Message?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="mdi mdi-trash-can"
                                                                data-toggle="tooltip"></i></button>
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
            </div>

            {{-- modal --}}
            @foreach ($messages as $message)
                <div class="modal fade" id="viewmessage{{ $message->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="viewmessageLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewmessageLabel">Message Request New Drop</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" id="responseForm"
                                    action="{{ route('messages.update', ['message' => $message->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="6" type="text" style="resize: none"
                                            readonly required>{{ $message->message }}</textarea>
                                    </div>

                                    <a href="{{ route('user.all') }}" class="btn btn-primary">Page All Users</a>

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
