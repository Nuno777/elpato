@extends('layouts.master')

@section('title', 'Assigned Drop')

@section('content')
@section('page-title', 'Assigned Drop')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-body">
                <h1>Assigned Drop for <b>{{ $user->name }}</b></h1>

                @if ($user->drops->isNotEmpty())
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
                                @foreach ($user->drops as $drop)
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
                                        <td>{{ \Carbon\Carbon::parse($drop->expired)->format('j/F/Y') }}</td>
                                        <td>{{ $drop->personalnotes }}</td>
                                        <td>
                                            <form action="{{ route('remove.drop.worker') }}" method="POST"
                                                onsubmit="return confirm('Remove Drop from User?');">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="drop_id" value="{{ $drop->id }}">
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="mdi mdi-trash-can" data-toggle="tooltip"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('user.all') }}" class="btn btn-secondary">Back</a>
                @else
                    <br>
                    <p>No drop assigned to this user.</p>
                    <br>
                    <a href="{{ route('user.all') }}"><button class="btn btn-secondary">Back</button></a>
                @endif
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
                                    <h1>Message for <b>{{ $user->name }}</b></h1>
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

                                                <td>
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#viewmessage{{ $drop->id }}"
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
                                                    {{ date('M d', strtotime($message->created_at)) }}
                                                </td>

                                                <td class="date">
                                                    <p>Message Created:
                                                        {{ date('H:i:s', strtotime($message->created_at)) }}</p>
                                                </td>
                                                <td>
                                                    <a type="button" data-toggle="modal"
                                                        data-target="#viewmessage{{ $drop->id }}"
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
                <div class="modal fade" id="viewmessage{{ $drop->id }}" tabindex="-1" role="dialog"
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
                                    <input type="hidden" name="response" id="response">

                                    <button type="button" class="btn btn-success"
                                        onclick="submitResponse('yes')">Yes</button>
                                    <button type="button" class="btn btn-danger"
                                        onclick="submitResponse('no')">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

<script>
    function submitResponse(response) {
        document.getElementById('response').value = response;
        document.getElementById('responseForm').submit();
    }
</script>
@endsection
