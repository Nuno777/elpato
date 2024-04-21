@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@section('page-title', 'Dashboard')

<div class="content-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Drops</h2>
                        <div class="sub-title">
                            <a href="{{ route('drops') }}" class="badge badge-pill badge-success"><span class="mr-1">Go to the Drops</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All Drops:</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Orders</h2>
                        <div class="sub-title">
                            <a href="{{ route('orders') }}" class="badge badge-pill badge-success"><span class="mr-1">Go to the Orders</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Your Orders:</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>FTID</h2>
                        <div class="sub-title">
                            <a href="{{ route('ftid') }}" class="badge badge-pill badge-success"><span class="mr-1">Go to the FTIDs</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Your FTIDs:</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Analytics</h2>
                        <div class="sub-title">
                            <a href="/analytics" class="badge badge-pill badge-success"><span class="mr-1">Go to the Analytics</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Your Analytics:</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
