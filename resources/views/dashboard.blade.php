@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@section('page-title','dashboard')

    <div class="content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card-mini">
                        <div class="card-header">
                            <h2>$18,699</h2>
                            <div class="sub-title">
                                <span class="mr-1">Sales of this year</span>
                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card-mini">
                        <div class="card-header">
                            <h2>$14,500</h2>
                            <div class="sub-title">
                                <span class="mr-1">Expense of this year</span>

                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card-mini">
                        <div class="card-header">
                            <h2>$4199</h2>
                            <div class="sub-title">
                                <span class="mr-1">Profit of this year</span>
                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card-mini">
                        <div class="card-header">
                            <h2>$20,199</h2>
                            <div class="sub-title">
                                <span class="mr-1">Revenue of this year</span>
                            </div>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
