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
        @endif

    </div>
</div>
@endsection
