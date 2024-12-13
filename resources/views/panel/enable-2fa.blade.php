@extends('layouts.master')

@section('title', 'Two-Factor Authentication')

@section('content')
@section('page-title', 'Two-Factor Authentication')

<div class="content-wrapper">
    <div class="content">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enable2faModalTitle">Enable Two-Factor Authentication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Enter the code sent to your Telegram in the form below:</p><br>
                    <form action="{{ route('verify-2fa.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">Verification Code:</label>
                            <input type="text" class="form-control" name="code" id="code"
                                placeholder="Enter Verification Code" autofocus="on" maxlength="6" minlength="6"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
