@extends('layouts.master')

@section('title', 'Assigned Drop')

@section('content')
@section('page-title', 'Assigned Drop')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <h1>Assigned Drop for <b>{{ $user->name }}</b></h1>
                @if ($drop)
                    <div class="collapse" id="collapse-data-tables">
                    </div>
                    <div class="table-responsive">
                        <table id="productsTable" class="table table-active table-product" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Drop</th>
                                    <th style="width: 20%" class="sorting_disabled">Courier</th>
                                    <th style="width: 25%" class="sorting_disabled">Address</th>
                                    <th style="width: 5%" class="sorting_disabled">Courier <br> Package</th>
                                    <th style="width: 10%" class="sorting_disabled">Status</th>
                                    <th style="width: 15%" class="sorting_disabled">Notes</th>
                                    <th style="width: 5%">Type</th>
                                    <th style="width: 5%">Expired At</th>
                                    <th style="width: 5%">Personal <br> Notes</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    style="background-color:
                                    @if ($drop->status == 'Ready') #85f36e;
                                    @elseif ($drop->status == 'Suspense') #838383;
                                    @elseif ($drop->status == 'Dont send') #fff085;
                                    @elseif ($drop->status == 'Problem') #ff9e8e; @endif
                                    color:
                                    @if ($drop->status == 'Suspense') white; @else black; @endif">
                                    <td>{{ $drop->id_drop }}</td>
                                    <td>{{ $drop->name }}</td>
                                    <td>{{ $drop->address }}</td>
                                    <td>{{ $drop->packages }}</td>
                                    <td><b>{{ $drop->status }}</b></td>
                                    <td>{{ $drop->notes }}</td>
                                    <td>{{ $drop->type }}</td>
                                    <td>{{ $drop->expired }}</td>
                                    <td>{{ $drop->personalnotes }}</td>
                                    <td>
                                        <form action="{{ route('remove.drop.worker') }}" method="POST"
                                            onsubmit="return confirm('Delete Drop?');">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="drop_id" value="{{ $drop->id }}">
                                            <button type="submit" class="btn btn-danger"><i class="mdi mdi-trash-can"
                                                    data-toggle="tooltip"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="{{ route('drops') }}">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#assigndrop">
                                Assign Drop
                            </button>
                            <a href="{{ route('user.all') }}"><button class="btn btn-secondary">Back</button></a>
                        </a>
                    </div>
                @else
                    <br>
                    <p>No drop assigned to this user.</p>
                    @if (auth()->check() && auth()->user()->type == 'admin')
                        <div>
                            <br>
                            <a href="{{ route('user.all') }}"><button class="btn btn-secondary">Back</button></a>
                        </div>
                    @endif
                @endif
            </div>
        </div>


        {{-- message --}}
        <div class="row">
            <div class="col-xl-4">
                <!-- Chat -->
                <div class="card card-default chat">
                    <div class="card-header">
                        <div class="media media-chat">
                            <img src="{{ asset('/images/user/user.png') }}" style="width:30px; height: 30px;"
                                alt="User Image">
                            <h4 class="username">{{ $user->name }}</h4>
                        </div>

                    </div>
                    <div class="card-body pb-0" data-simplebar style="height: 387px;">
                        <!-- Media Chat Left -->
                        @foreach ($messages as $message)
                            <div class="media media-chat">
                                <img src="{{ asset('/images/user/user.png') }}" style="width:30px; height: 30px;"
                                    class="rounded-circle" alt="Avatar Image">
                                <div class="media-body">
                                    <div class="text-content">
                                        <span class="message">{{ $message->message }}</span>
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>

                            <!-- Media Chat Right -->
                            <div class="media media-chat media-chat-right">
                                <div class="media-body">
                                    <div class="text-content">
                                        <span class="message">{{ $message->response }}</span>
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                                <img src="{{ asset('/images/user/user.png') }}" style="width:30px; height: 30px;"
                                    class="rounded-circle" alt="Avatar Image">
                            </div>
                        @endforeach
                    </div>
                    <div class="chat-footer">
                        <form action="{{ route('messages.update', $message->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-chat">
                                <div class="input-group-prepend">
                                    <span class="emoticon-icon mdi mdi-send"></span>
                                </div>
                                <input type="text" class="form-control" name="response"
                                    value="{{ $message->response }}" aria-label="Text input with dropdown button">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        {{-- end message --}}






    </div>
</div>
@endsection
