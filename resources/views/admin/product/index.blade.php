@extends('layouts.admin.app')

@section('title', 'Admin | Manage Product')

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

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')

        {{-- @if ($scarcity_products->isNotEmpty())
            <div class="alert alert-danger alert-dismissible fade show p-3 text-white" role="alert"">
                <h3 class="font-weight-normal text-white">Warning:
                    {{ Str::plural('Product', $scarcity_products->count()) }} nearly out of stock <i
                        class="fas fa-exclamation-triangle ml-1 "></i>
                </h3>
                <ul>
                    @foreach ($scarcity_products as $scarcity_product)
                        <li>
                            <a class="text-white"
                                href="{{ route('admin.products.show', $scarcity_product) }}">{{ $scarcity_product->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif --}}

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.products.create') }}">Create
                                Product +</a>
                            <a href="{{ route('admin.print.handle') }}?records=product"
                                class="btn btn-sm btn-warning">Print</a>
                        </div>
                        <br><br>
                        <form>
                            <div class="form-group">
                                <select class="form-control form-control-sm" onchange="getProductByQty(this)">
                                    <option value="0,100">--- All Qty ---
                                    </option>
                                    <option value="21,30">Abundant (21 - 30)</option>
                                    <option value="11,20">Average (11 - 20)</option>
                                    <option value="0,10">Scarcity (0 - 10)</option>
                                </select>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-flush table-hover product_dt">
                                <caption>List of Product</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th>Featured Photo</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Supplier</th>
                                        <th>Qty</th>
                                        <th>Is Customized</th>
                                        <th>Status</th>
                                        <th>Updated At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display products --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
