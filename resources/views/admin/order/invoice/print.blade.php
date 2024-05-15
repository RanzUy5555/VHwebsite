@extends('layouts.print.app')

@section('styles')
    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form class="d-print-none text-right" action="{{ route('admin.print.handle') }}" method="GET">
                    <input type="hidden" name="records" value="invoice">
                    <input type="hidden" name="execute" value="1">
                    <input type="hidden" name="transaction_no" value="{{ $orders[0]->transaction_no }}">

                    <button type="submit" class="btn btn-warning text-white float-right">Print Record</button>
                </form>
                <br><br>
                <div class="mb-5 justify-content-center text-center">
                    <img class="img-fluid" src="{{ asset('img/logo/logo.png') }}" width="150" alt="PSAU"> <br> <br>
                    <h3>{{ config('app.name') }}</h3>
                    <p> Manila East Road Hi-way Paete, Laguna, Philippines</p>
                    <h2 class="font-weight-bold">Official Receipt</h2>
                </div>
                <div class="row font-monospace">
                    <div class="col-6">
                        <p>Order No: {{ $orders[0]->transaction_no }}</p>
                        <p class="">Customer: {{ $orders[0]->user->full_name }}</p>
                        <p class="">Address: {{ $orders[0]->address }}</p>
                        <p class="">Date: {{ formatDate($orders[0]->created_at) }}</p>
                    </div>
                </div>
                <br><br>
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
                            {{-- If Order has Product --}}
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

                                {{-- If Order has Product with Variety --}}
                            @else
                                <tr>
                                    <td>{{ $order->product_variety->product->code }}</td>
                                    <td>{{ $order->product_variety->product->name }} | {{ $order->product_variety->name }}
                                    </td>
                                    <td>{{ $order->qty }}</td>
                                    <td>₱
                                        {{ number_format($order->product_variety->price * $order->qty, 2) }}
                                    </td>
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
                {{-- <div class="row py-5">
                    <div class="col-5 offset-7">
                        <p class="font-monospace text-center"></p>
                        <hr>
                        <p class="font-monospace text-center">Cashier</p>
                    </div>
                </div> --}}
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function() {
                const url = new URL(location.href);
                const execute = url.searchParams.get('execute');

                execute == true ? print() : false
            });
            onafterprint = function() {
                window.location.href = @json(route('admin.orders.show', $orders[0]['id']));
            }
        </script>
    @endsection
