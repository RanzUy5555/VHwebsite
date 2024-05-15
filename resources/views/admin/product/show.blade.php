@extends('layouts.admin.app')

@section('title', 'Admin | Product Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">All Products</a>
                </li>
                <li class="breadcrumb-item"> {{ $product->category->name }}
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">

                @include('layouts.includes.alert')
                <div class="row justify-content-center ">
                    <div class="col-md-6 d-flex align-self-stretch">
                        <div class="card card-shadow-none hoverable w-100">
                            <a href="{{ $product->featured_photo }}" class="glightbox">
                                <img class="card-img-top" src="{{ $product->featured_photo }}"
                                    title="click to view more photos">
                            </a>
                            <div class="collapse" id="view_photos">
                                @forelse ($product->getMedia('product_images') as $image)
                                    @if (!$loop->first)
                                        <a href="{{ $image->getUrl() }}" class="glightbox">
                                            <img class="img-fluid" src="{{ $image->getUrl() }}" width="100"
                                                alt="image">
                                        </a>
                                    @endif
                                @empty
                                    No Available Photos
                                @endforelse
                            </div>
                            <div class="card-body d-flex and flex-column">

                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                <h2>
                                    <q>{{ $product->name }}</q>
                                </h2>
                                <h4 class="font-weight-normal">
                                    Description: {{ $product->description }}
                                </h4>
                                <h4 class="font-weight-normal">
                                    Category: {{ $product->category->name }}
                                </h4>

                                <h2 class="font-weight-normal text-primary" id="price"
                                    data-price='{{ $product->price }}' data-qty='{{ $product->qty }}'>
                                    ₱
                                    {{ $product->price }}
                                </h2>


                                <br>
                                <h4 class="font-weight-normal text-right">{{ $product->qty }} Items left</h4>
                                <hr class="mb-3">

                                @if ($product->qty <= 10 && $product->qty !== 0)
                                    <div class="alert alert-danger alert-dismissible fade show p-3 text-white"
                                        role="alert"">
                                        <h4 class="text-white font-weight-normal">WARNING: The Product is ALMOST OUT OF
                                            STOCK.
                                            Please contact
                                            the supplier <i class="fas fa-exclamation-triangle ml-1 "></i>
                                        </h4>
                                    </div>
                                    <br>
                                @endif


                                @if ($product->qty == 0)
                                    <div class="alert alert-danger alert-dismissible fade show p-3 text-white"
                                        role="alert"">
                                        <h4 class="text-white font-weight-normal">WARNING: The Product is SOLDOUT
                                            Please contact
                                            the supplier <i class="fas fa-exclamation-triangle ml-1 "></i>
                                        </h4>
                                    </div>
                                    <br>
                                @endif


                                <h3 class="text-capitalize"> <i class="fas fa-building mr-1"></i> Company -
                                    {{ $product->supplier->company }}
                                </h3>
                                <h4 class="font-weight-normal text-capitalize"><i class="fas fa-user mr-1"></i> Manager -
                                    {{ $product->supplier->manager }}
                                </h4>
                                <h4 class="font-weight-normal text-capitalize"><i class="fas fa-phone mr-1"></i> Contact -
                                    <a href="tel:{{ $product->supplier->contact }}">{{ $product->supplier->contact }}</a>
                                </h4>
                                <h4 class="font-weight-normal"><i class="fas fa-envelope mr-1"></i> Email -
                                    <a href="mailto:{{ $product->supplier->email }}">{{ $product->supplier->email }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
