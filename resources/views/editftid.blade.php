@extends('layouts.master')

@section('title', 'Edit FTID')

@section('content')
@section('page-title', 'Edit FTID')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Edit FTID</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('ftid.update', $ftid->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="id">ID FTID</label>
                                        <input type="text" name="id" class="form-control"
                                            value="{{ old('id') ?? $ftid->id }}" placeholder="ID FTID" readonly
                                            required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">User</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ Auth::user()->name }}" placeholder="ID FTID" readonly required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="carrier">Carrier</label>
                                        <input type="text" name="carrier" class="form-control"
                                            value="{{ old('carrier') ?? $ftid->carrier }}" readonly
                                            placeholder="Carrier" required>

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tracking"> </label>
                                        <input type="text" name="tracking" class="form-control"
                                            value="{{ old('tracking') ?? $ftid->tracking }}" readonly
                                            placeholder="Tracking Code" required>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="store">Store</label>
                                <input type="text" name="store" class="form-control"
                                    value="{{ old('store') ?? $ftid->store }}" readonly placeholder="Store" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="method">Method</label>
                                <input type="text" name="method" class="form-control"
                                    value="{{ old('method') ?? $ftid->method }}" readonly placeholder="Method" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="comments">Comments</label>
                                <input type="text" name="comments" class="form-control"
                                    value="{{ old('comments') ?? $ftid->comments }}" readonly placeholder="Comments"
                                    value="N/A">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="label_creation_date">Label Creation Date</label>
                                        <input type="date" name="label_creation_date" class="form-control"
                                            value="{{ old('label_creation_date') ?? $ftid->label_creation_date }}"
                                            readonly required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="label_payment_date">Label Payment Date</label>
                                        <input type="date" name="label_payment_date" class="form-control"
                                            value="{{ $ftid->label_payment_date }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected disabled>Choose Status</option>
                                            <option value="FTID Created"
                                                style="background-color: #85f36e; color: black;"
                                                {{ $ftid->status == 'FTID Created' ? 'selected' : '' }}>FTID Created
                                            </option>
                                            <option value="FTID Paid" style="background-color: #bfddf3; color: black;"
                                                {{ $ftid->status == 'FTID Paid' ? 'selected' : '' }}>FTID Paid</option>
                                            <option value="FTID Dropped"
                                                style="background-color: #cf9bcc; color: black;"
                                                {{ $ftid->status == 'FTID Dropped' ? 'selected' : '' }}>FTID Dropped
                                            </option>
                                            <option value="FTID Error"
                                                style="background-color: #ff9e8e; color: black;"
                                                {{ $ftid->status == 'FTID Error' ? 'selected' : '' }}>FTID Error
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit FTID</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('label_payment_date').addEventListener('change', function() {
            var labelPaymentDate = this.value;
            var statusElement = document.getElementById('status');

            // Verifica se a data do pagamento foi preenchida
            if (labelPaymentDate) {
                // Atualiza o valor do campo de status para 'FTID Paid'
                statusElement.value = 'FTID Paid';
            }
        });
    });
</script>
@endsection
