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
                            <th>Roles</th>
                            <th>Create Check</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="width: 5%" class="sorting_disabled">{{ $user->id }}</td>
                                <td style="width: 25%" class="sorting_disabled">{{ $user->name }}</td>
                                <td style="width: 35%" class="sorting_disabled">{{ $user->email }}</td>
                                <td style="width: 20%" class="sorting_disabled">
                                    @if ($user->admin == 'A_HaQD1SkWsGN0tYW8DOZLuTm61')
                                        Admin
                                    @elseif ($user->admin == 0)
                                        Worker
                                    @else
                                        {{ $user->admin }}
                                    @endif
                                </td>
                                <td style="width: 20%" class="sorting_disabled">{{ $user->email_verified_at }}</td>
                                @if (auth()->check() && auth()->user()->admin == 'A_HaQD1SkWsGN0tYW8DOZLuTm61')
                                    <td style="width: 5%" class="sorting_disabled">
                                        <a href="" style="width: 100%">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="mdi mdi-square-edit-outline text-white"></i>
                                            </button>
                                        </a>
                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <button class="btn btn-primary" type="button" data-toggle="modal"> <i
                                                class="mdi mdi-message-text-outline"></i>
                                        </button>

                                    </td>

                                    <td style="width: 5%" class="sorting_disabled">
                                        <form role="form" action="{{ route('user.destroy', $user->id) }}"
                                            method="POST" onsubmit="return confirm('Delete User?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">
                                                <i class="mdi mdi-trash-can" data-toggle="tooltip"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                @if (auth()->check() && auth()->user()->admin == 'A_HaQD1SkWsGN0tYW8DOZLuTm61')
                    <div>
                        <a href="{{ route('createuser') }}"><button class="btn btn-primary">Create
                                User</button></a>
                                <a href="{{ route('user.all') }}"><button class="btn btn-secondary">Back</button></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
