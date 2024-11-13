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
                                <td>
                                    <form action="{{ route('user.restore', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Restore user?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-restore" data-toggle="tooltip"></i>
                                        </button>
                                    </form>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#forceDeleteUserModal{{ $user->id }}">
                                        <i class="mdi mdi-delete-forever" data-toggle="tooltip"></i>
                                    </button>
                                    <div class="modal fade" id="forceDeleteUserModal{{ $user->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="forceDeleteUserModalLabel{{ $user->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="forceDeleteUserModalLabel{{ $user->id }}">Permanently
                                                        delete the user</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this user permanently? This action
                                                    cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <form role="form"
                                                        action="{{ route('user.forceDelete', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Permanently
                                                            delete</button>
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
