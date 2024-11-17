@extends('layouts.master')

@section('title', 'Restore Users')

@section('content')
@section('page-title', 'Restore Users')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">
                </div>
                <table id="productsTable" class="table table-active table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telegram</th>
                            <th>Roles</th>
                            <th>Blocked</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deletedUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telegram }}</td>
                                <td>
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
                                <td>
                                    @if ($user->blocked == '0')
                                        Blocked
                                    @elseif ($user->blocked == '1')
                                        Unblocked
                                    @else
                                        {{ $user->blocked }}
                                    @endif
                                </td>
                                <td style="width: 7%" class="sorting_disabled">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#restoreUserModal{{ $user->slug }}">
                                        <i class="mdi mdi-restore" data-toggle="tooltip"></i>
                                    </button>
                                    <div class="modal fade" id="restoreUserModal{{ $user->slug }}" tabindex="-1"
                                        role="dialog" aria-labelledby="restoreUserModalLabel{{ $user->slug }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="restoreUserModalLabel{{ $user->slug }}">Restore User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>To confirm the restoration of this user, type:</p>
                                                    <p><strong>restore-{{ $user->name }}</strong></p>
                                                    <br>
                                                    <input type="text" id="restoreInput{{ $user->slug }}"
                                                        class="form-control" placeholder="Type here to confirm"
                                                        oninput="validateRestoreInput('{{ $user->slug }}', '{{ $user->name }}')">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('user.restore', trim($user->slug)) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="confirmation_text"
                                                            id="confirmationText{{ $user->slug }}">
                                                        <button type="submit" id="restoreButton{{ $user->slug }}"
                                                            class="btn btn-success" disabled>Restore</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>


                                <td style="width: 7%" class="sorting_disabled">
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#forceDeleteUserModal{{ $user->slug }}">
                                        <i class="mdi mdi-delete-forever" data-toggle="tooltip"></i>
                                    </button>
                                    <div class="modal fade" id="forceDeleteUserModal{{ $user->slug }}" tabindex="-1"
                                        role="dialog" aria-labelledby="forceDeleteUserModalLabel{{ $user->slug }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="forceDeleteUserModalLabel{{ $user->slug }}">
                                                        Permanently delete the user
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>To confirm the permanent deletion of this user, type:</p>
                                                    <p><strong>delete-{{ $user->name }}</strong></p>
                                                    <br>
                                                    <input type="text" id="deleteInput{{ $user->slug }}"
                                                        class="form-control" placeholder="Type here to confirm"
                                                        oninput="validateInput('{{ $user->slug }}', '{{ $user->name }}')">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <form role="form"
                                                        action="{{ route('user.forceDelete', $user->slug) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="confirmation_text"
                                                            id="confirmationText{{ $user->slug }}">
                                                        <button type="submit" id="deleteButton{{ $user->slug }}"
                                                            class="btn btn-danger" disabled>
                                                            Permanently delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('user.all') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/user/deleteinput.js') }}"></script>
@endpush
