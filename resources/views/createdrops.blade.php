@extends('layouts.master')

@section('title', 'Dashboard | Drops')

@section('content')
@section('page-title', 'Create Drops')

<div class="content-wrapper">
    <div class="content">
        <div class="card card-default">
            <div class="card-header">
                <h2>Create Drops</h2>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="fname">Name</label>
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="lname">Address</label>
                                <input type="text" class="form-control" placeholder="Address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city">Notes</label>
                                <input type="text" class="form-control" placeholder="Notes">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="State">Packages</label>
                                        <input type="text" class="form-control" placeholder="Packages">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Zip">Status</label>
                                        <input type="text" class="form-control" placeholder="Status">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city">Personal Notes</label>
                                <input type="text" class="form-control" placeholder="Personal Notes">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="State">Type</label>
                                        <input type="text" class="form-control" placeholder="Type">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Zip">Expired AT</label>
                                        <input type="text" class="form-control" placeholder="Expired AT">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-pill">Insert Drop</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
