@extends('layouts.master')

@section('title', 'All Users Painel')

@section('content')
@section('page-title', 'All Users Painel')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">
                </div>
                <table id="productsTable" class="table table-active table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telegram</th>
                            <th>Roles</th>
                            <th>Blocked</th>
                            <th>Create Check</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Default Pass</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="width: 5%" class="sorting_disabled">{{ $user->id }}</td>
                                <td style="width: 10%" class="sorting_disabled">{{ $user->name }}</td>
                                <td style="width: 20%" class="sorting_disabled">{{ $user->email }}</td>
                                <td style="width: 15%" class="sorting_disabled">{{ $user->telegram }}</td>
                                <td style="width: 10%" class="sorting_disabled">
                                    @if ($user->type == 'admin')
                                        Admin
                                    @elseif ($user->type == 'general')
                                        General
                                    @elseif ($user->type == 'worker')
                                        Worker
                                    @else
                                        {{ $user->type }}
                                    @endif
                                </td>
                                <td style="width: 10%" class="sorting_disabled">
                                    @if ($user->blocked == '0')
                                        Blocked
                                    @elseif ($user->blocked == '1')
                                        Unblocked
                                    @else
                                        {{ $user->blocked }}
                                    @endif
                                </td>
                                <td style="width: 15%" class="sorting_disabled">
                                    {{ $user->email_verified_at ? $user->email_verified_at->format('j/F/Y') . ' - ' . $user->email_verified_at->format('H:i:s') : 'N/A' }}
                                </td>


                                @if (auth()->check() && auth()->user()->type == 'admin')
                                    <td>
                                        @if ($user->type === 'worker')
                                            <a href="{{ route('user.drops', $user->id) }}"
                                                class="badge badge-pill badge-info">
                                                <i class="mdi mdi-bell-outline icon"></i>
                                                @if ($user->type == 'admin')
                                                    <span
                                                        class="badge badge-xs rounded-circle">{{ $messagesCount }}</span>
                                                @else
                                                    <?php
                                                    $userMessagesCount = $messages->where('user_id', $user->id)->count();
                                                    ?>
                                                    <span
                                                        class="badge badge-xs rounded-circle">{{ $userMessagesCount }}</span>
                                                @endif
                                            </a>
                                        @endif
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        @if ($user->type === 'worker')
                                            <a href="{{ route('user.drops', $user->id) }}" style="width: 100%">
                                                <button type="button" class="btn btn-success">
                                                    <i class="mdi mdi-truck notify-toggler custom-dropdown-toggler"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <a href="{{ route('user.orders', $user->id) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-package-variant-closed "></i>
                                            </button>
                                        </a>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <a href="{{ route('user.ftids', $user->id) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-file-pdf"></i>
                                            </button>
                                        </a>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <a href="{{ route('edituser.edit', $user->id) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="mdi mdi-square-edit-outline text-white"></i>
                                            </button>
                                        </a>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <form action="{{ route('user.setDefaultPassword', $user->id) }}" role="form"
                                            method="POST" onsubmit="return confirm('Change Password for this user?');">
                                            @csrf
                                            <button type="submit" class="btn btn-dark">
                                                <i class="mdi mdi-key" data-toggle="tooltip"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        @if (auth()->check() && auth()->user()->id !== $user->id)
                                            <form role="form" action="{{ route('user.destroy', $user->id) }}"
                                                method="POST" onsubmit="return confirm('Delete User?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                @if (auth()->check() && auth()->user()->type == 'admin')
                    <div>
                        <a href="{{ route('createuser') }}"><button class="btn btn-primary">Create
                                User</button></a>
                        <a href="{{ route('adminpainel') }}"><button class="btn btn-secondary">Back</button></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/checkpass.js') }}"></script>
@endpush
