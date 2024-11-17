@extends('layouts.master')

@section('title', 'All Users')

@section('content')
@section('page-title', 'All Users')
<meta class="hidden" name="csrf-token" content="{{ csrf_token() }}">
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
                            <th></th>
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
                                    {{ $user->email_verified_at ? $user->email_verified_at->format('d-m-Y') . ' - ' . $user->email_verified_at->format('H:i:s') : 'N/A' }}
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
                                        <a href="{{ route('edituser.edit', trim($user->slug)) }}" style="width: 100%">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="mdi mdi-square-edit-outline text-white"></i>
                                            </button>
                                        </a>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <!-- Botão para abrir o modal -->
                                        <button type="button" class="btn btn-dark" data-toggle="modal"
                                            data-target="#resetPasswordModal{{ $user->slug }}">
                                            <i class="mdi mdi-key" data-toggle="tooltip"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="resetPasswordModal{{ $user->slug }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="resetPasswordModalLabel{{ $user->slug }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Cabeçalho do Modal -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="resetPasswordModalLabel{{ $user->slug }}">
                                                            Password Change
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- Corpo do Modal -->
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to reset this user's password? This
                                                            will assign a new default password.</p><br>
                                                        <p><strong>New Password:</strong> <span
                                                                id="generatedPassword{{ $user->slug }}">-----</span>
                                                        </p>
                                                    </div>
                                                    <!-- Rodapé do Modal -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-dark"
                                                            onclick="resetPassword('{{ route('user.setDefaultPassword', $user->slug) }}', '{{ $user->slug }}')">
                                                            Reset password
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        @if (auth()->check() && auth()->user()->slug !== $user->slug && $user->type !== 'admin')
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteUserModal{{ $user->slug }}">
                                                <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                            </button>
                                            <div class="modal fade" id="deleteUserModal{{ $user->slug }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="deleteUserModalLabel{{ $user->slug }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteUserModalLabel{{ $user->slug }}">Delete
                                                                User</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this user? This action
                                                            cannot be undone.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form role="form"
                                                                action="{{ route('user.destroy', trim($user->slug)) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">Create
                            User</button>

                        @include('panel.users.createuser')

                        <a href="{{ route('user.deleted') }}"><button class="btn btn-primary">Restore
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
<script src="{{ asset('js/user/generatePass.js') }}"></script>
@endpush
