@extends('layouts.master')

@section('title', 'Send Message')

@section('content')
@section('page-title', 'Send Message to Telegram')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Send Message</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sendMessage') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect12">User</label>
                                        <select class="form-control" id="exampleFormControlSelect12" name="chat_id">
                                            <option value="all">For All Users</option>
                                            @if (count($chatIds) > 0)
                                                @foreach ($chatIds as $chatId)
                                                    <option value="{{ $chatId->chat_id }}">
                                                        {{ $chatId->name }} (Chat ID: {{ $chatId->chat_id }})
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No users available</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="8" style="resize: none" required></textarea>
                            </div>
                            <div class="form-footer mt-6">
                                <button type="submit" class="btn btn-primary">Send</button>
                                <a href="{{ route('adminpainel') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-default">
                    <div class="card-body">
                        <h3>Total Users Connected: <span id="userCount">{{ $connectedCount }}</span></h3>
                        <canvas id="connectedUsersChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.connectedCount = {!! json_encode($connectedCount) !!};
</script>
<script src="{{ asset('js/analytics/analytic_panel_dashboard.js') }}"></script>
@endpush
