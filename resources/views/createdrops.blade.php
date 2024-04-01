@extends('layouts.master')

@section('title', 'Dashboard Create Drop')

@section('content')
@section('page-title', 'Create Drops')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Create Drops</h2>
            </div>
            <div class="card-body">
                <form id="tablecreatedrop" method="POST" action="{{ route('createdrops.store') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="id-drop">ID</label>
                                <input type="text" name="id_drop" class="form-control" placeholder="Id Drop"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <input type="text" name="notes" class="form-control" placeholder="Notes" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="personalnotes">Personal Notes</label>
                                <input type="text" name="personalnotes" class="form-control"
                                    placeholder="Personal Notes" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="packages">Packages</label>
                                        <input type="text" name="packages" class="form-control"
                                            placeholder="Packages" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected value="Default" style="background-color: #fff; color: black; " disabled>
                                                Default</option>
                                            <option value="Ready" style="background-color: #82FB6A; color: black; ">
                                                Ready</option>
                                            <option value="Problem" style="background-color: #FF7059; color: white;">
                                                Problem</option>
                                            <option value="Dont send" style="background-color: #F1DD50; color: black;">
                                                Dont send</option>
                                            <option option value="Suspense"
                                                style="background-color: #424945; color: white;">Suspense</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" name="type" class="form-control" placeholder="Type"
                                            value="All" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired At</label>
                                        <input type="date" name="expired" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span></span>
                    <button type="submit" class="btn btn-primary">Insert Drop</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#status').change(function() {
            var selectedValue = $(this).val();
            var backgroundColor;
            var textColor;

            switch (selectedValue) {
                case 'Ready':
                    backgroundColor = '#82FB6A';
                    textColor = 'black';
                    break;
                case 'Suspense':
                    backgroundColor = '#424945';
                    textColor = 'white';
                    break;
                case 'Dont send':
                    backgroundColor = '#F1DD50';
                    textColor = 'black';
                    break;
                case 'Problem':
                    backgroundColor = '#FF7059';
                    textColor = 'white';
                    break;
            }

            $(this).css('background-color', backgroundColor);
            $(this).css('color', textColor);
        });
    });
</script>
@endsection
