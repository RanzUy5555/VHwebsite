@extends('layouts.main.app')

@section('title', 'Virgilio Handicraft | Our Products')

@section('styles')
    <style>
        body {
            background: #ffff !important;
        }

        .card {
            box-shadow: none;
        }

        .card-img-top {
            width: 100% !important;
            height: 180px !important;
            /* Set the desired height for your images */
            object-fit: cover !important;
        }
    </style>
@endsection

@section('content')
    <div class="container pt-3">
        <h2 class="font-weight-normal">
            <div class="dropdown">
                <a class="text-muted dropdown-toggle h4" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Filter
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('main.products.index') }}?category={{ $category->id }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a class="float-right text-muted" href="{{ route('user.carts.index') }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge bg-warning text-white">{{ $cart_count ?? 0 }}</span>
            </a>
        </h2>


        <div class="row">
            <div class="col-md-12">
                @include('layouts.includes.alert')
                <br>
                {{-- LOOP THROUGH EACH BRAND --}}
                @foreach ($categories as $category)
                    <h3 class="font-weight-normal text-muted mb-5"><i class="fas fa-paperclip"></i>
                        {{ ucfirst($category->name) }}
                    </h3>
                    <div class="row">

                        {{-- LOOP THROUGH EACH BRAND > PRODUCTS --}}
                        @forelse ($category->products as $product)
                            <div class="col-6 col-md-4 col-lg-2 d-flex align-self-stretch px-1">
                                <div class="card w-100 card-shadow-none hoverable card-less">
                                    <a href="{{ route('main.products.show', $product) }}">
                                        <img class="card-img-top"
                                            src="{{ handleNullFeaturedPhoto($product->small_featured_photo) }}"
                                            width="120" alt="product">
                                    </a>
                                    <div class="card-body d-flex and flex-column text-left">

                                    </div>
                                    <div class="card-footer" style="border:none">
                                        <p class="card-text mb-2 h5">
                                            <a href="{{ route('main.products.show', $product) }}">
                                                {{ textTruncate($product->name) }}
                                            </a>
                                        </p>
                                        <p class="h4 font-weight-bold">
                                            ₱{{ $product->price ? $product->price : $product->variety_range }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>
                                - No item found
                            </p>
                        @endforelse{{-- END BRAND > PRODUCT LOOP --}}
                    </div>

                    @if (!$loop->last)
                        <hr>
                    @endif
                @endforeach {{-- END BRAND LOOP --}}

            </div>
        </div>
    </div>



@endsection
