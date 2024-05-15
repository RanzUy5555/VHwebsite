@extends('layouts.user.app')

@section('title', 'Virgilio Handicraft | Order History')

@section('styles')
    <style>
        body {
            background: #ffff !important;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        .card-header {
            background: #eaedf0 !important;
        }
    </style>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container pt-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">Shopping</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order History</li>
                    </ol>
                </nav>
                {{-- Start ROW --}}
                <div class="row">

                    @if ($orders->isNotEmpty())
                        @foreach ($orders as $order)
                            {{--  Order without Product variety --}}
                            @if ($order->product_id)
                                <div class="col-md-12" id="cart_row-{{ $order->id }}">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h4 class="font-weight-normal">ORDER PLACED</h4>
                                                    <h5 class="font-weight-normal"> {{ formatDate($order->created_at) }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <h4 class="font-weight-normal">TOTAL</h4>
                                                    <h5 class="font-weight-normal">
                                                        ₱{{ number_format($order->product->price * $order->qty, 2) }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <h4 class="font-weight-normal">SHIP TO</h4>
                                                    <h5 class="font-weight-normal">
                                                        {{ $order->user->full_name }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <h4 class="font-weight-normal">ORDER # {{ $order->transaction_no }}
                                                    </h4>
                                                    <h5>
                                                        <a href="{{ route('user.orders.show', $order) }}">View order
                                                            details</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            {{-- Content --}}
                                            <div class="row align-items-center mt-2">
                                                {{-- Logo --}}
                                                <div class="col-3">
                                                    <img class="rounded"
                                                        src="{{ handleNullFeaturedPhoto($order->product->featured_photo) }}"
                                                        width="150" alt="{{ $order->product->name }}">
                                                </div>

                                                {{-- product Info --}}
                                                <div class="col-9">
                                                    <h3 class="text-primary font-weight-normal">
                                                        <a href="{{ route('user.orders.show', $order) }}">
                                                            {{ $order->product->name }} |
                                                            {{ $order->name }}
                                                        </a>
                                                    </h3>
                                                    <h3 class="font-weight-normal">
                                                        {{ textTruncate($order->product->description) }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Order with Product Variety --}}
                                <div class="col-md-12" id="cart_row-{{ $order->id }}">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h4 class="font-weight-normal">ORDER PLACED</h4>
                                                    <h5 class="font-weight-normal"> {{ formatDate($order->created_at) }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <h4 class="font-weight-normal">TOTAL</h4>
                                                    <h5 class="font-weight-normal">
                                                        ₱{{ number_format($order->product_variety->price * $order->qty, 2) }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-2">
                                                    <h4 class="font-weight-normal">SHIP TO</h4>
                                                    <h5 class="font-weight-normal">
                                                        {{ $order->user->full_name }}
                                                    </h5>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <h4 class="font-weight-normal">ORDER # {{ $order->transaction_no }}
                                                    </h4>
                                                    <h5>
                                                        <a href="{{ route('user.orders.show', $order) }}">View order
                                                            details</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            {{-- Content --}}
                                            <div class="row align-items-center mt-2">
                                                {{-- Logo --}}
                                                <div class="col-3">
                                                    <img class="rounded"
                                                        src="{{ handleNullFeaturedPhoto($order->product_variety->product->featured_photo) }}"
                                                        width="150" alt="{{ $order->product_variety->product->name }}">
                                                </div>

                                                {{-- product Info --}}
                                                <div class="col-9">
                                                    <h3 class="text-primary font-weight-normal">
                                                        <a href="{{ route('user.orders.show', $order) }}">
                                                            {{ $order->product_variety->product->name }} |
                                                            {{ $order->product_variety->name }}
                                                        </a>
                                                    </h3>
                                                    <h3 class="font-weight-normal">
                                                        {{ textTruncate($order->product_variety->product->description) }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <figure>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('img/cart/empty.svg') }}"
                                alt="empty"><br>
                            <figcaption>
                                <p class="text-center">Oops! History Not found</p>
                            </figcaption>
                        </figure>

                    @endif

                </div>

                {{-- End ROW --}}
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        $('#order_history_nav').addClass('active')
    </script>
@endsection
