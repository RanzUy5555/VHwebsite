@extends('layouts.user.app')

@section('title', 'Virgilio Handicraft | Order Invoice')

@section('content')
    {{-- CONTAINER --}}
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">All Orders</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order #{{ $orders[0]->transaction_no }}</li>
                    </ol>
                </nav>

                <div class="row">
                    @foreach ($orders as $order)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    @if ($order->product_id)
                                        {{-- Content --}}
                                        <div class="row align-items-center">
                                            {{-- Logo --}}
                                            <div class="col-3">
                                                <img class="d-block mx-auto rounded img-fluid" width="250"
                                                    src="{{ handleNullFeaturedPhoto($order->product->featured_photo) }}"
                                                    alt="{{ $order->product->name }}">
                                            </div>

                                            {{-- product Info --}}
                                            <div class="col-9">

                                                <h3 class="font-weight-normal">
                                                    <a href="{{ route('main.products.show', $order->product) }}">
                                                        {{ $order->product->name }}
                                                        |
                                                        {{ $order->product->category->name }}
                                                        | {{ $order->name }}
                                                    </a>
                                                </h3>
                                                <h5 class="font-weight-normal">
                                                    {{ $order->product->is_available ? 'In Stock' : 'Out of Stock' }}
                                                </h5>
                                                <h5 class="font-weight-normal">
                                                    Shipped From: {{ config('app.name') }}
                                                </h5>
                                                <h4 class="text-dark product_price">
                                                    ₱{{ number_format($order->product->price, 2) }} x
                                                    {{ $order->qty }}
                                                </h4>

                                                {{-- <h5 class="font-weight-normal text-right text-primary">
                                                {{ $order->product->qty }}
                                                <a href="{{ route('main.products.show', $order->product) }}">
                                                    Items left
                                                </a>
                                            </h5> --}}
                                            </div>
                                        </div>
                                    @else
                                        {{-- Content --}}
                                        <div class="row align-items-center">
                                            {{-- Logo --}}
                                            <div class="col-3">
                                                <img class="d-block mx-auto rounded "
                                                    src="{{ handleNullFeaturedPhoto($order->product_variety->product->featured_photo) }}"
                                                    width="100" alt="{{ $order->product_variety->product->name }}">
                                            </div>

                                            {{-- product Info --}}
                                            <div class="col-9">
                                                <h3 class="font-weight-normal">
                                                    <a
                                                        href="{{ route('main.products.show', $order->product_variety->product) }}">
                                                        {{ $order->product_variety->product->name }}
                                                        |
                                                        {{ $order->product_variety->product->category->name }}
                                                        | {{ $order->product_variety->name }}
                                                    </a>
                                                </h3>
                                                <h5 class="font-weight-normal">
                                                    {{ $order->product_variety->product->is_available ? 'In Stock' : 'Out of Stock' }}
                                                </h5>
                                                <h5 class="font-weight-normal">
                                                    Shipped From: {{ config('app.name') }}
                                                </h5>
                                                <h4 class="text-dark product_price">
                                                    ₱{{ number_format($order->product_variety->price, 2) }} x
                                                    {{ $order->qty }}
                                                </h4>
                                                {{-- <h5 class="font-weight-normal text-right text-primary">
                                                    {{ $order->product_variety->qty }}
                                                    <a
                                                        href="{{ route('main.products.show', $order->product_variety->product) }}">
                                                        Items left
                                                    </a>
                                                </h5> --}}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                    {{-- Display Credentials --}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-gray">
                                <span class="card-title text-white">
                                    Billing Address
                                </span>
                            </div>
                            <div class="card-body">

                                <h4 class="font-weight-normal">
                                    Customer: {{ $order->user->full_name }}
                                </h4>
                                <h4 class="font-weight-normal">
                                    Shipping Address: {{ $order->user->address }}
                                </h4>
                                <h4 class="font-weight-normal">
                                    Municipality: {{ $order->municipality->name }}
                                </h4>

                                <h4 class="font-weight-normal">
                                    Contact: {{ $order->user->contact }}
                                </h4>

                                <h4 class="font-weight-normal">
                                    Email: <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                                </h4>

                            </div>
                        </div>
                    </div>

                    {{-- Payment Details --}}
                    <div class="col-md-12">

                        @php
                            $sub_total = $orders->reduce(function ($carry, $item) {
                                if ($item->product_id) {
                                    return $carry + $item->product->price * $item->qty;
                                } else {
                                    return $carry + $item->product_variety->price * $item->qty;
                                }
                            });

                        @endphp


                        <div class="row">

                            {{-- Invoice --}}
                            <div class="col-md-6 d-flex align-self-stretch">

                                <div class="card w-100">
                                    <div class="card-header bg-gray">
                                        <span class="card-title text-white">
                                            Order Summary
                                        </span>
                                    </div>
                                    <div class="card-body d-flex and flex-column">


                                        <h4 class="font-weight-normal">
                                            Sub Total (₱): {{ number_format($sub_total, 2) }}
                                        </h4>

                                        <h4 class="font-weight-normal">
                                            Delivery Fee (₱): {{ number_format($orders[0]->municipality->fee, 2) }}
                                        </h4>

                                        <h4 class="font-weight-normal">
                                            Grand Total (₱):
                                            {{ number_format($sub_total + $orders[0]->municipality->fee, 2) }}
                                        </h4>

                                        <h4 class="font-weight-normal">
                                            Transaction No. {{ $order->transaction_no }}
                                        </h4>


                                        <h4 class="font-weight-normal">
                                            Paid Via: <span class="badge badge-success">
                                                {{ $order->payment_method->type }} <i
                                                    class="fas fa-check-circle ms-1"></i></span>
                                        </h4>

                                        <h4 class="font-weight-normal">
                                            Order Status: {!! handleOrderStatus($order->status) !!}
                                        </h4>

                                        @if ($orders[0]->remark)
                                            <h4 class="font-weight-normal">
                                                Remark: {{ $orders[0]->remark }}
                                            </h4>
                                        @endif

                                        @if ($orders[0]->status == \App\Models\Order::ON_DELIVERY || \App\Models\Order::DELIVERED)
                                            <h4 class="font-weight-normal">
                                                Expected Delivery Date:
                                                {{ $orders[0]->to_be_delivered_at ? formatDate($orders[0]->to_be_delivered_at) : 'N/A' }}
                                            </h4>
                                        @endif


                                        <a class="text-primary" data-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            View Payment Receipt
                                        </a>

                                        <div class="collapse mt-3" id="collapseExample">
                                            <a class="glightbox" href="{{ handleNullImage($order->payment_receipt) }}">
                                                <img class="img-thumbnail"
                                                    src="{{ handleNullImage($order->payment_receipt) }}" width="100"
                                                    alt="payment receipt">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- Display Image By Order Status --}}
                            <div class="col-md-6 text-center d-flex align-self-stretch">
                                <div class="card w-100">
                                    <div class="card-body d-flex and flex-column">
                                        {{-- If the order in on delivery --}}
                                        @if ($orders[0]->status == \App\Models\Order::PENDING)
                                            <img class="img-fluid d-block mx-auto"
                                                src="{{ asset('img/order/pending.svg') }}" width="450" alt="pending">
                                            <h3>Your order waiting to being processed ...</h3>
                                        @elseif($orders[0]->status == \App\Models\Order::APPROVED)
                                            <img class="img-fluid d-block mx-auto"
                                                src="{{ asset('img/order/approved.svg') }}" width="450" alt="approved">
                                            <h3>Your order has been approved it is now being processed ...</h3>
                                        @elseif($orders[0]->status == \App\Models\Order::REJECTED)
                                            <img class="img-fluid d-block mx-auto"
                                                src="{{ asset('img/order/rejected.png') }}" width="450" alt="rejected">
                                            <h3>Your order has been rejected ...</h3>
                                        @elseif($orders[0]->status == \App\Models\Order::ON_DELIVERY)
                                            <img class="img-fluid d-block mx-auto"
                                                src="{{ asset('img/order/on_delivery.svg') }}" width="450"
                                                alt="on_delivery">
                                            <h3>Your order now is on delivery ...</h3>
                                        @elseif($orders[0]->status == \App\Models\Order::DELIVERED)
                                            <img class="img-fluid" src="{{ asset('img/order/delivered.svg') }}"
                                                alt="delivered">
                                            <h3> Status: Your order has been delivered ...</h3>
                                        @else
                                            <img class="img-fluid d-block mx-auto"
                                                src="{{ asset('img/order/rejected.png') }}" width="450"
                                                alt="canceled">
                                            <h3 class="text-center"> Your order has been canceled ...</h3>
                                            <h3 class="text-center"> Remark: {{ $orders[0]->remark ?? 'N/A' }}</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
