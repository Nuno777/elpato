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
                                <label for="fname">First name</label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" class="form-control" placeholder="Smith">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" placeholder="City Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="State">State</label>
                                        <input type="text" class="form-control" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="Zip">Zip</label>
                                        <input type="text" class="form-control" placeholder="Zip">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary btn-pill">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
