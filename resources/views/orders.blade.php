@extends('layouts.master')

@section('title', 'Dashboard Orders')

@section('content')
@section('page-title', 'Orders Painel')

<div class="content-wrapper">
    <div class="content">

        <div class="card card-default">
            <div class="card-header">
                <h2>Orders Painel</h2>
            </div>
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">

                </div>
                <table id="productsTable" class="table table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Courier</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Profit</th>
                            <th>Delivery info</th>
                            <th>Label info</th>
                            <th>Pickup info    </th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>

                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
