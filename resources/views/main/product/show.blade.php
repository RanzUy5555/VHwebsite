@extends('layouts.main.app')

@section('title', 'Virgilio Handicraft | Product Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('main.products.index') }}">All Products</a>
                        </li>
                        <li class="breadcrumb-item"> {{ $product->category->name }}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
                @include('layouts.includes.alert')
                <div class="row justify-content-center ">
                    <div class="col-md-3 d-none d-md-block">

                        {{-- Display the note if the product is customizable --}}
                        @if ($product->is_customized)
                            <div class="card w-100 card-shadow-none hoverable card-less">
                                <img class="card-img-top" src="{{ asset('img/reminder/default.svg') }}" width="120"
                                    alt="product">
                                <div class="card-body d-flex and flex-column text-left">
                                    <h3 class="font-weight-normal">Important Reminders *</h3>

                                    <h4 class="text-danger">
                                        • Please read the product description thoroughly before placing your order.
                                    </h4>

                                    <p class="text-sm">
                                        To ensure a personalized experience and discuss your customized handicrafts needs,
                                        please connect with us first before ordering the product. You can send the image you
                                        would like to have customized to our email address: <a
                                            href="mailto:virgilio.handicraft2@gmail.com">virgilio.handicraft2@gmail.com</a>.
                                        Please
                                        make sure to add a subject title of "<strong> FullName - Customized
                                            Handicrafts</strong>" to your email.
                                    </p>
                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="col-md-6 ">
                        <div class="card card-shadow-none hoverable">
                            <a href="{{ $product->featured_photo }}" class="glightbox">
                                <img class="card-img-top zoom_image" src="{{ $product->featured_photo }}"
                                    data-zoom-image="{{ $product->large_featured_photo }}"
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
                        </div>
                        <div class="card card-body">

                            <h3>
                                <q>{{ $product->name }}</q>
                            </h3>

                            <h5 class="font-weight-normal">
                                Description: {{ $product->description }}
                            </h5>

                            <h5 class="font-weight-normal">
                                {{ $product->is_available ? 'In Stock' : 'Out of Stock' }}
                            </h5>
                            <h5 class="font-weight-normal">
                                Shipped From: {{ config('app.name') }}
                            </h5>

                            <h2 class="font-weight-normal text-primary" id="price"
                                data-price='{{ $product->price ?? $product->varieties->first()->price }}'
                                data-qty='{{ $product->qty ? $product->qty : $product->varieties->first()->qty }}'>
                                ₱
                                {{ $product->price ?? $product->varieties->first()->price }}
                            </h2>

                            {{-- Display Product Varieties --}}
                            @if ($product->varieties->isNotEmpty())
                                <a class="text-primary text-small" data-toggle="collapse" href="#show_description"
                                    role="button" aria-expanded="false" aria-controls="show_description">
                                    View Sizes
                                </a>
                                <div class="collapse mt-2" id="show_description">
                                    {{-- if there is a variety --}}
                                    <div class="row">
                                        @foreach ($product->varieties as $variety)
                                            @if ($loop->first)
                                                <a class="px-2" href="javascript:void(0)"
                                                    onclick="getProductVariety({{ $variety }})">
                                                    <span class="badge badge-primary variety"
                                                        id="variety-{{ $variety->id }}"
                                                        data-id='{{ $variety->id }}'>{{ $variety->name }}</span>
                                                </a>
                                            @else
                                                <a class="px-2" href="javascript:void(0)"
                                                    onclick="getProductVariety({{ $variety }})">
                                                    <span class="badge badge-secondary variety"
                                                        id="variety-{{ $variety->id }}"
                                                        data-id='{{ $variety->id }}'>{{ $variety->name }}</span>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            @endif

                            <form action="{{ route('user.carts.store') }}" method="POST" id="cart_form">
                                @csrf

                                {{-- Manage Qty --}}
                                <div class="form-group mt-3 mb-1">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-sm" onclick="removeProductQtyOnCart()"
                                                id="remove_qty_btn">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input class="form-control form-control-sm text-center" name="qty"
                                            type="number" class="quantity_field" value="1" id="quantity_field"
                                            readonly>
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-sm" onclick="addProductQtyOnCart()"
                                                id="add_qty_btn">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="product">
                                    {{-- if product has variety || get the first variety --}}
                                    @if ($product->varieties->isNotEmpty())
                                        <input type="hidden" name="product_variety_id"
                                            value="{{ $product->varieties->first()->id }}">
                                    @else
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @endif
                                </div>
                            </form>


                            <h5 class="font-weight-normal text-right" id="qty">
                                {{ $product->qty ?? $product->varieties->first()->qty }} Items left</h5>

                            @if ($product->is_available)
                                <button type="button" class="btn btn-primary mt-2"
                                    onclick="promptStore(event, '#cart_form', 'Add to your cart?', '', 'Yes')">Add
                                    To
                                    Cart <i class="fas fa-shopping-cart ml-1"></i>
                                </button>
                            @else
                                <button type="button" class="btn btn-warning mt-2">SOLD OUT
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3 d-none d-md-block">
                        @foreach ($related_products as $related_product)
                            <div class="card w-100 card-shadow-none hoverable card-less">
                                <img class="card-img-top"
                                    src="{{ handleNullFeaturedPhoto($related_product->featured_photo) }}" width="120"
                                    alt="product">
                                <div class="card-body d-flex and flex-column text-left">
                                    <a class="card-text mb-2" href="{{ route('main.products.show', $related_product) }}">
                                        {{ $related_product->name }}
                                    </a>
                                    <span class="font-weight-bold">
                                        ₱{{ $related_product->price ? $related_product->price : $related_product->variety_range }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
@section('script')

    <script>
        function getProductVariety(variety) {
            if (variety) {
                const varieties = document.querySelectorAll('.variety')

                varieties.forEach(variety => $(variety).removeClass('badge-primary')) // remove the current active variety

                $('#variety-' + variety.id).removeClass('badge-secondary').addClass(
                    'badge-primary') // make the selected variety an active variety

                $('#price').text(`₱ ${variety.price}`)
                $('#price').data('qty', variety.qty) // update the price data-qty attribute value
                $('#qty').text(`${variety.qty} Items left`)

                $('#product').html(`
                    <input type="hidden" name="product_variety_id" value="${variety.id}">
                `) // change the product to produce variety
            }
        }

        function addProductQtyOnCart() {
            let product_price = parseFloat($('#price').data('price')); // product price
            let remaining_product_qty = parseInt($('#price').data('qty')); // the overall product qty

            if (product_price) {
                let current_product_qty = parseInt(
                    $('#quantity_field').val()
                ); // the current product qty in the cart

                if (current_product_qty >= 0) {
                    if (current_product_qty === remaining_product_qty) {
                        toastWarning(
                            `Oops sorry, the maximum quantity of the product is ${remaining_product_qty}`
                        );
                        return false;
                    }

                    $("#remove_qty_btn").attr("disabled", false); // enable minus button

                    let updated_qty_field = current_product_qty + 1; // increment 1

                    $('#quantity_field').val(updated_qty_field); // update the current qty

                }
            }
        }

        function removeProductQtyOnCart(product) {
            let product_price = parseFloat($('#price').data('price')); // product price
            let remaining_product_qty = parseInt($('#price').data('qty')); // the overall product qty

            if (product_price) {
                let current_product_qty = parseInt(
                    $("#quantity_field").val()
                ); // the current product qty in the cart

                if (current_product_qty > 1) {
                    $("#remove_qty_btn").attr("disabled", false); // enable minus button

                    let updated_qty_field = current_product_qty - 1; // decrement 1

                    $("#quantity_field").val(updated_qty_field); // update the current qty

                } else {
                    $("#remove_qty_btn").attr("disabled", true); // disabled
                }
            }
        }

        $('.zoom_image').ezPlus();
        $('#product_nav').addClass('active')
    </script>

@endsection
