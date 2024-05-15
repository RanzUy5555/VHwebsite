@extends('layouts.admin.app')

@section('title', 'Admin | Order Invoice')

@section('content')
    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">All Orders</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Order #{{ $orders[0]->transaction_no }}</li>
            </ol>
        </nav>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i
                            class="fas fa-info-circle mr-2"></i>Order Invoice</a>
                </li>

                @if (
                    $orders[0]->status == \App\Models\Order::PENDING ||
                        $orders[0]->status == \App\Models\Order::APPROVED ||
                        $orders[0]->status == \App\Models\Order::ON_DELIVERY)
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                            href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                            aria-selected="false"><i class="fas fa-cog mr-2"></i>Manage Order</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                        href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i
                            class="fas fa-print mr-2"></i>Print Invoice</a>
                </li>

            </ul>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div class="row justify-content-center">
                    <div class="col-md-7 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    @foreach ($orders as $order)
                                        <div class="col-md-12">
                                            {{-- Content --}}
                                            @if ($order->product_id)
                                                <div class="row align-items-center">
                                                    {{-- Logo --}}
                                                    <div class="col-3">
                                                        <img class="d-block mx-auto rounded w-100 h-100"
                                                            src="{{ handleNullFeaturedPhoto($order->product->featured_photo) }}"
                                                            alt="{{ $order->product->name }}">
                                                    </div>

                                                    {{-- product Info --}}
                                                    <div class="col-9">
                                                        <h5 class="font-weight-normal">{{ $order->product->name }} |
                                                            {{ $order->product->category->name }}</h5>
                                                        <h4 class="text-primary product_price">₱
                                                            {{ $order->product->price }} x {{ $order->qty }}
                                                        </h4>
                                                        <h5 class="font-weight-normal text-right text-primary">
                                                            <a href="{{ route('admin.products.show', $order->product) }}">
                                                                {{ $order->product->qty == 0 ? 'Sold Out' : 'Items left' }}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                </div>

                                                {{-- If Order with Product Variety --}}
                                            @else
                                                <div class="row align-items-center">
                                                    {{-- Logo --}}
                                                    <div class="col-3">
                                                        <img class="d-block mx-auto rounded w-100 h-100"
                                                            src="{{ handleNullFeaturedPhoto($order->product_variety->product->featured_photo) }}"
                                                            alt="{{ $order->product_variety->product->name }}">
                                                    </div>

                                                    {{-- product Info --}}
                                                    <div class="col-9">
                                                        <h5 class="font-weight-normal">
                                                            {{ $order->product_variety->product->name }} |
                                                            {{ $order->product_variety->product->category->name }}
                                                        </h5>
                                                        <h4 class="text-primary product_price">₱
                                                            {{ $order->product_variety->price }} x {{ $order->qty }}
                                                        </h4>
                                                        <h5 class="font-weight-normal text-right text-primary">
                                                            {{ $order->product_variety->product->qty }}
                                                            <a
                                                                href="{{ route('admin.products.show', $order->product_variety->product) }}">
                                                                {{ $order->product_variety->qty == 0 ? 'Sold Out' : 'Items left' }}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (!$loop->last)
                                                <hr>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5  d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                {{-- Display Credentials --}}
                                <div>
                                    <h3 class="font-weight-normal">Customer Details <i class="fas fa-user-check ml-1"></i>
                                    </h3> <br>

                                    <h4 class="font-weight-normal">
                                        Name: {{ $order->user->full_name }}
                                    </h4>
                                    <h4 class="font-weight-normal">
                                        Address: {{ $order->user->address }}
                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Contact: {{ $order->user->contact }}
                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Email: <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a>
                                    </h4>
                                </div>
                                <hr>
                                {{-- Payment Details --}}
                                <div>
                                    <h3 class="font-weight-normal">Invoice <i
                                            class="fas fa-credit-card ml-1 text-primary"></i>
                                    </h3>

                                    @php
                                        $sub_total = $orders->reduce(function ($carry, $item) {
                                            if ($item->product_id) {
                                                return $carry + $item->product->price * $item->qty;
                                            } else {
                                                return $carry + $item->product_variety->price * $item->qty;
                                            }
                                        });

                                    @endphp


                                    <h3 class="font-weight-normal">
                                        Grand Total (₱): {{ number_format($sub_total + $orders[0]->municipality->fee, 2) }}
                                    </h3>


                                    <h4 class="font-weight-normal">
                                        Sub Total (₱): {{ number_format($sub_total, 2) }}
                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Delivery Fee (₱): {{ number_format($orders[0]->municipality->fee, 2) }}
                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Order No. {{ $order->transaction_no }}
                                    </h4>
                                    {{-- Only show if the order type is online --}}
                                    <h4 class="font-weight-normal">
                                        Reference No. {{ $order->reference_no }}
                                    </h4>
                                    <h4 class="font-weight-normal">
                                        Paid Via: <span
                                            class="badge badge-success">{{ $order->payment_method->type }}</span>
                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Order Status: {!! handleOrderStatus($order->status) !!}
                                    </h4>

                                    <a class="text-primary text-small" data-toggle="collapse" href="#collapseExample"
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
                    </div>
                </div>
            </div>

            {{-- Only show if the order type is online --}}
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="row justify-content-center">
                    {{-- Display only if its not delivered Options --}}

                    @if (
                        $orders[0]->status == \App\Models\Order::PENDING ||
                            $orders[0]->status == \App\Models\Order::APPROVED ||
                            $orders[0]->status == \App\Models\Order::ON_DELIVERY)
                        <div class="col-md-8">

                            <div class="card card-body">
                                <h2 class="text-primary">Manage Order *</h2>

                                <div class="text-center">
                                    @if ($orders[0]->status == \App\Models\Order::PENDING)
                                        <img class="img-fluid" src="{{ asset('img/order/pending.svg') }}" width="300"
                                            alt="pending">
                                        <h3> Status: order waiting to being processed ...</h3>
                                    @elseif($orders[0]->status == \App\Models\Order::APPROVED)
                                        <img class="img-fluid" src="{{ asset('img/order/approved.svg') }}"
                                            width="300" alt="approved">
                                        <h3> Status: order has been approved it is now being processed ...</h3>
                                    @elseif($orders[0]->status == \App\Models\Order::REJECTED)
                                        <img class="img-fluid" src="{{ asset('img/order/rejected.png') }}"
                                            width="300" alt="rejected">
                                        <h3 class="text-center"> order has been rejected ...</h3>
                                    @elseif($orders[0]->status == \App\Models\Order::ON_DELIVERY)
                                        <img class="img-fluid" src="{{ asset('img/order/on_delivery.svg') }}"
                                            width="300" alt="on_delivery">
                                        <h3> Status: order is now on delivery ...</h3>
                                    @elseif($orders[0]->status == \App\Models\Order::DELIVERED)
                                        <img class="img-fluid" src="{{ asset('img/order/delivered.svg') }}"
                                            width="300" alt="delivered">
                                        <h3> Status: order has been delivered ...</h3>
                                    @else
                                        <img class="img-fluid" src="{{ asset('img/order/rejected.png') }}"
                                            width="300" alt="rejected">
                                        <h3 class="text-center"> Your order has been canceled ...</h3>
                                        <h3 class="text-center"> Remark: {{ $orders[0]->remark ?? 'N/A' }}</h3>
                                    @endif
                                </div>
                                <form action="{{ route('admin.orders.update', $order) }}" method="POST"
                                    id="order_form">
                                    @csrf @method('PUT')

                                    {{-- If there is a note --}}
                                    @if ($orders[0]->note)
                                        <div class="alert alert-primary alert-dismissible fade show p-3 text-white mt-2"
                                            role="alert">
                                            Customer's Note: {{ $orders[0]->note }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="form-group mb-2">
                                        <label class="form-label">Select Status</label>
                                        <select name="status" class="form-control" onchange="manageOrder(this)">
                                            <option value=""></option>

                                            @if ($orders[0]->status == \App\Models\Order::PENDING)
                                                <option value="1">Approve Order</option>
                                                <option value="2">Reject Order</option>
                                            @endif

                                            @if ($orders[0]->status == \App\Models\Order::APPROVED)
                                                <option value="3">Mark as On-Delivery</option>
                                                <option value="4">Mark as Delivered</option>
                                                <option value="5">Mark as Canceled</option>
                                            @endif

                                            @if ($orders[0]->status == \App\Models\Order::ON_DELIVERY)
                                                <option value="4">Mark as Delivered</option>
                                            @endif

                                        </select>
                                    </div>


                                    <div class="form-group mb-2">
                                        <label class="form-label">Remark</label>
                                        <textarea class="form-control" name="remark" rows="6" placeholder="Add Remark (Optional). "></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2"
                                        onclick="promptUpdate(event, '#order_form', 'Do you want to Update Order Status?', '', 'Yes')">Save</button>
                                </form>
                            </div>
                        </div>
                    @endif


                </div>
            </div>

            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-outline-primary float-right"
                                    href="{{ route('admin.print.handle') }}?records=invoice&transaction_no={{ $orders[0]->transaction_no }}">Print</a>
                            </div>
                            <div class="card-body pt-5">
                                <div class="mb-5 justify-content-center text-center">
                                    <img class="img-fluid" src="{{ asset('img/logo/logo.png') }}" width="130"
                                        alt="Virgilio Handicraft"> <br><br>
                                    <h3>{{ config('app.name') }}</h3>
                                    <p> Manila East Road Hi-way Paete, Laguna, Philippines</p>
                                    <h2 class="font-weight-bold">Official Receipt</h2>
                                </div>
                                <div class="row font-monospace">
                                    <div class="col-6">
                                        <p>Order No: {{ $orders[0]->transaction_no }}</p>
                                        <p class="">Customer: {{ $orders[0]->user->full_name }}</p>
                                        <p class="">Date: {{ formatDate($orders[0]->created_at) }}</p>
                                    </div>
                                </div>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered request_dt font-monospace">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Product</th>
                                                <th>Total Qty</th>
                                                <th>Sub Total</th>
                                                <th>Delivery Fee</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totals = [];
                                            @endphp
                                            @foreach ($orders as $order)
                                                @if ($order->product_id)
                                                    <tr>
                                                        <td>{{ $order->product->code }}</td>
                                                        <td>{{ $order->product->name }} </td>
                                                        <td>{{ $order->qty }}</td>
                                                        <td>₱
                                                            {{ number_format($order->product->price * $order->qty, 2) }}
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    @php
                                                        $totals[] = $order->product->price * $order->qty;
                                                    @endphp

                                                    {{-- If order has product with variety --}}
                                                @else
                                                    <tr>
                                                        <td>{{ $order->product_variety->product->code }}</td>
                                                        <td>{{ $order->product_variety->product->name }} -
                                                            {{ $order->product_variety->name }}</td>
                                                        <td>{{ $order->product_variety->qty }}</td>
                                                        <td>₱
                                                            {{ number_format($order->product_variety->price * $order->qty, 2) }}
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @php
                                                        $totals[] = $order->product_variety->price * $order->qty;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td> ₱ {{ number_format($orders[0]->municipality->fee, 2) }}</td>
                                                <td>₱
                                                    {{ number_format(collect($totals)->sum() + $orders[0]->municipality->fee, 2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                {{-- <div class="row py-5">
                                    <div class="col-5 offset-7">
                                        <p class="font-monospace text-center">{{ $order->user->full_name }}</p>
                                        <hr>
                                        <p class="font-monospace text-center">Cashier</p>
                                    </div>
                                </div> --}}
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
        // function manageOrder(status) {
        //     if (!status.value) {
        //         $('#date_picker').css('display', 'none');
        //         $('#tracking_link').css('display', 'none');
        //         return;
        //     }

        //     if (status.value == 3) {
        //         $('#tracking_link').css('display', 'block');
        //         $('#date_picker').css('display', 'none');

        //     } else if (status.value == 4) {
        //         $('#date_picker').css('display', 'block');
        //         $('#tracking_link').css('display', 'none');

        //     } else {
        //         $('#tracking_link').css('display', 'none');
        //         $('#date_picker').css('display', 'none');

        //     }

        // }

        $('#order_management_nav').addClass('active');
    </script>
@endsection
