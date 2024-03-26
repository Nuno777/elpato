@extends('layouts.master')

@section('title', 'Dashboard | Drops')

@section('content')
@section('page-title', 'dashboard Drops')

<div class="content-wrapper">
    <div class="content">

        <div class="card card-default">
            <div class="card-header">
                <h2>Drops Painel</h2>
            </div>
            <div class="card-body">
                <div class="collapse" id="collapse-data-tables">

                </div>
                <table id="productsTable" class="table table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Courier Packages</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Expired At</th>
                            <th>Personal Notes</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>dsa</td>
                            <td>24542</td>
                            <td>18</td>
                            <td>7</td>
                            <td>5</td>
                            <td>1</td>
                            <td>14</td>
                            <td>22</td>
                            <td>25</td>
                            <td><a href="#" style="width: 100%">
                                    <i class="mdi mdi-package-variant text-success"></i>
                                </a>
                            </td>
                            <td><a href="#" style="width: 100%">
                                <i class="mdi mdi-close text-danger"></i>
                            </a>
                        </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
@endsection
