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
                                        <input type="text" name="status" class="form-control" placeholder="Status"
                                            required>
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
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expired">Expired AT</label>
                                        <input type="text" name="expired" class="form-control"
                                            placeholder="Expired AT" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Insert Drop</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
