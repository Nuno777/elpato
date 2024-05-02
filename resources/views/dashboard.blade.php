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
                            <a href="{{ route('drops') }}" class="badge badge-pill badge-success"><span class="mr-1">Go
                                    to the Drops</span></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>All Drops: {{ $dropCount }}</p>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Orders</h2>
                        <div class="sub-title">
                            <a href="{{ route('orders') }}" class="badge badge-pill badge-success"><span
                                    class="mr-1">Go to the Orders</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Your Orders: {{ $orderCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>FTID</h2>
                        <div class="sub-title">
                            <a href="{{ route('ftid') }}" class="badge badge-pill badge-success"><span class="mr-1">Go
                                    to the FTIDs</span></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Your FTIDs: {{ $ftidCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card card-default card-mini">
                    <div class="card-header">
                        <h2>Analytics</h2>
                        <div class="sub-title">
                            <a href="" class="badge badge-pill badge-success"><span class="mr-1">Go to the
                                    Analytics</span></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>Your Analytics:</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- code skeleton --}}
        @if (Auth::check() && Auth::user()->id == '1')
            <div class="row">
                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/skeleton/skeleton.webp') }}"
                            style="width: 250px">
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6">
                    <div class="h-100 mb-4">

                    </div>
                </div>

                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/skeleton/eutentei.gif') }}"
                            style="width: 350px">
                    </div>
                </div>
            </div>
            {{-- code pekka --}}
        @elseif (Auth::check() && Auth::user()->id == '2')
            <div class="row">
                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/pekka/minipekka.webp') }}"
                            style="width: 400px">
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6">
                    <div class="h-100 mb-4">

                    </div>
                </div>

                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/pekka/airfryer.png') }}" style="width: 400px">
                    </div>
                </div>
            </div>
            {{-- code et --}}
        @elseif (Auth::check() && Auth::user()->id == '3')
            <div class="row">
                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/et/et.webp') }}" style="width: 400px">
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6">
                    <div class="h-100 mb-4">

                    </div>
                </div>

                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/et/naopode.jpg') }}" style="width: 400px">
                    </div>
                </div>
            </div>
            {{-- code calvo --}}
        @elseif (Auth::check() && Auth::user()->id == '4')
            <div class="row">
                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/calvo/calvo.webp') }}" style="width: 400px">
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6">
                    <div class="h-100 mb-4">

                    </div>
                </div>

                <div class="col-lg-6 col-xl-3">
                    <div class="h-100 mb-4">
                        <img class="card-img-top" src="{{ asset('/images/calvo/pernapau.png') }}" style="width: 400px">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
