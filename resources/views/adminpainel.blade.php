@extends('layouts.master')

@section('title', 'Admin Painel')

@section('content')
@section('page-title', 'Admin Painel')

<div class="content-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Create User</h2>
                        <div class="sub-title">
                            <a href="{{ route('createuser') }}" class="badge badge-pill badge-success"><span class="mr-1">Go
                                    to the Create User</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>All Users</h2>
                        <div class="sub-title">
                            <a href="{{ route('user.all') }}" class="badge badge-pill badge-success"><span
                                    class="mr-1">Go to the All Users</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All Users: {{ $userCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>All Orders</h2>
                        <div class="sub-title">
                            <a href="{{ route('orders.all') }}" class="badge badge-pill badge-success"><span class="mr-1">Go
                                    to the All Orders</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All Orders: {{ $ordersCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>All FTID</h2>
                        <div class="sub-title">
                            <a href="{{ route('ftid.all') }}" class="badge badge-pill badge-success"><span class="mr-1">Go to the
                                    All FTIDs</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>All FTIDs: {{ $ftidCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
