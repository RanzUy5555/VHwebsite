@extends('layouts.user.app')

@section('title', 'Virgilio Handicraft | My Cart')

@section('content')

    {{-- payment_method --}}
    <div class="modal fade" id="m_payment_method" tabindex="-1" role="dialog" aria-labelledby="m_payment_method_label"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-white"><i class="fas fa-info-circle me-1"></i> Accepting Payments: </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-5">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Account Name</th>
                                    <th>Account No.</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment_methods as $pm)
                                    <tr>
                                        <td>{{ $pm->type }}</td>
                                        <td>{{ $pm->account_name }}</td>
                                        <td>{{ $pm->account_no }}</td>
                                        <td>{!! isOnline($pm->is_online) !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End payment_method --}}

    {{-- CONTAINER --}}
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('main.products.index') }}">Shopping</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Cart</li>
                    </ol>
                </nav>
                @include('layouts.includes.alert')
                {{-- Start ROW --}}
                <form action="{{ route('user.orders.store') }}" method="POST" id="order_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        @if ($carts->isNotEmpty())
                            @foreach ($carts as $cart)
                                <div class="col-md-12" id="cart_row-{{ $cart->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($cart->product_id)
                                                {{-- Content --}}
                                                <div class="row align-items-center">
                                                    {{-- Logo --}}
                                                    <div class="col-3">
                                                        <img class="d-block mx-auto rounded h-100 w-100"
                                                            src="{{ handleNullFeaturedPhoto($cart->product->featured_photo) }}"
                                                            alt="product">
                                                    </div>

                                                    {{-- product Info --}}
                                                    <div class="col-9">
                                                        <h5 class="font-weight-normal">
                                                            {{ $cart->product->name }}
                                                            |
                                                            {{ $cart->product->category->name }}

                                                        </h5>

                                                        <h4 class="text-primary product_price"
                                                            data-price='{{ $cart->product->price * $cart->qty }}'
                                                            id="product_price-{{ $cart->product_id }}">
                                                            PHP
                                                            {{ $cart->product->price * $cart->qty }}

                                                        </h4>

                                                        <div class="form-group mb-2" style="width:40%">
                                                            <div
                                                                class="input-group input-group-merge input-group-alternative">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-sm"
                                                                        onclick="removeQty({{ $cart->product }})"
                                                                        id="remove_qty_btn-{{ $cart->product_id }}">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                <input class="form-control form-control-sm text-center"
                                                                    name="qty[]" type="number" class="quantity_field"
                                                                    value="{{ $cart->qty }}"
                                                                    id="quantity_field-{{ $cart->product_id }}" readonly>
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-sm"
                                                                        onclick="addQty({{ $cart->product }})"
                                                                        id="add_qty_btn-{{ $cart->product_id }}">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <br>
                                                            <div class="text-small">
                                                                <a class="text-muted"
                                                                    href="{{ route('main.products.show', $cart->product) }}">View</a>
                                                                |
                                                                <a class="text-muted" href="javascript:void(0)"
                                                                    onclick="removeProductFromCart({{ $cart->id }})">Delete</a>
                                                            </div>

                                                        </div>
                                                        <h5 class="font-weight-normal text-right text-primary">
                                                            {{ $cart->product->qty }}
                                                            Items left
                                                        </h5>
                                                    </div>
                                                </div>
                                            @else
                                                {{-- Content --}}
                                                <div class="row align-items-center">
                                                    {{-- Logo --}}
                                                    <div class="col-3">
                                                        <img class="d-block mx-auto rounded w-100 h-100"
                                                            src="{{ handleNullFeaturedPhoto($cart->product_variety->product->featured_photo) }}"
                                                            alt="product">
                                                    </div>

                                                    {{-- product Info --}}
                                                    <div class="col-9">
                                                        <h3 class="font-weight-normal">
                                                            <a
                                                                href="{{ route('main.products.show', $cart->product_variety->product) }}">
                                                                {{ $cart->product_variety->product->name }}
                                                                |
                                                                {{ $cart->product_variety->product->category->name }}
                                                                | {{ $cart->product_variety->name }}
                                                            </a>
                                                        </h3>
                                                        <h5 class="font-weight-normal">
                                                            {{ $cart->product_variety->product->is_available ? 'In Stock' : 'Out of Stock' }}
                                                        </h5>
                                                        <h5 class="font-weight-normal">
                                                            Shipped From: {{ config('app.name') }}
                                                        </h5>
                                                        <h4 class="font-weight-bold product_price"
                                                            data-price='{{ $cart->product_variety->price * $cart->qty }}'
                                                            id="product_price-{{ $cart->product_variety_id }}">
                                                            ₱{{ number_format($cart->product_variety->price * $cart->qty, 2) }}

                                                        </h4>

                                                        <div class="form-group mb-2" style="width:40%">
                                                            <div
                                                                class="input-group input-group-merge input-group-alternative">
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-sm"
                                                                        onclick="removeQty({{ $cart->product_variety }})"
                                                                        id="remove_qty_btn-{{ $cart->product_variety_id }}">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                <input class="form-control form-control-sm text-center"
                                                                    name="product_variety_qty[]" type="number"
                                                                    class="quantity_field" value="{{ $cart->qty }}"
                                                                    id="quantity_field-{{ $cart->product_variety_id }}"
                                                                    readonly>
                                                                <div class="input-group-prepend">
                                                                    <button type="button" class="btn btn-sm"
                                                                        onclick="addQty({{ $cart->product_variety }})"
                                                                        id="add_qty_btn-{{ $cart->product_variety_id }}">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <div class="text-small">
                                                                <a class="text-muted"
                                                                    href="{{ route('main.products.show', $cart->product_variety->product) }}">View</a>
                                                                |
                                                                <a class="text-muted" href="javascript:void(0)"
                                                                    onclick="removeProductFromCart({{ $cart->id }})">Delete</a>


                                                            </div>
                                                        </div>
                                                        <h5 class="font-weight-normal text-right text-primary">
                                                            {{ $cart->product_variety->qty }}
                                                            Items left
                                                        </h5>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                {{-- Product Field --}}
                                <div>
                                    @if ($cart->product_id)
                                        <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
                                    @else
                                        <input type="hidden" name="product_variety_id[]"
                                            value="{{ $cart->product_variety_id }}">
                                    @endif
                                </div>
                            @endforeach


                            {{-- Display Credentials --}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="font-weight-normal">Billing Address <i
                                                class="fas fa-map-marker-alt ml-1 text-danger"></i></h3> <br>
                                        <div class="form-outline mb-2">
                                            <label class="form-label">Name*</label>
                                            <input class="form-control" type="text"
                                                value="{{ $cart->user->full_name }}" readonly>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label">Address*</label>
                                            <input class="form-control" type="text" name="address"
                                                placeholder="Enter Complete Delivery Address"
                                                value="{{ $cart->user->address }}">
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label">Select municipality*</label>
                                            <select class="form-control" name="municipality_id"
                                                onchange="getDeliveryFee(this)">
                                                <option value=""></option>
                                                @foreach ($municipalities as $municipality)
                                                    <option value="{{ $municipality->id }}"
                                                        data-fee="{{ $municipality->fee }}"
                                                        @if ($cart->user->municipality_id == $municipality->id) selected @endif>
                                                        {{ $municipality->name }}
                                                    </option>
                                                    {{-- <option value="{{ $municipality->id }}" data-fee="{{ $municipality->fee }}">
                                                        {{ $municipality->name }}
                                                    </option> --}}
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="form-label">Contact*</label>
                                        <div class="form-group mb-2">
                                            <div class="input-group input-group-merge input-group-alternative">
                                                <input class="form-control" type="number" min="0" name="contact"
                                                    placeholder="Ex. 09659312003" autocomplete="tel-local" id="contact"
                                                    value="{{ $cart->user->contact }}" required>
                                                <div class="input-group-prepend">
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        onclick="sendOtp(event)">SEND OTP</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-outline mb-2">
                                            <label class="form-label">OTP*</label>
                                            <input class="form-control" type="number" name="otp" min="0"
                                                placeholder="Enter 6 digits OTP Code">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            {{-- Payment Details --}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="font-weight-normal">Payments <i
                                                class="fas fa-credit-card ml-1 text-success"></i>
                                        </h3>

                                        <a href="javascript:void(0)" onclick="$('#m_payment_method').modal('show')">
                                            <small>View Payment Options
                                                <i class="fas fa-info-circle ms-1"></i>
                                            </small>
                                        </a>
                                        <br><br>

                                        <div class="form-outline mb-2">
                                            <label class="form-label">SubTotal (₱)</label>
                                            <input class="form-control" type="number" min="0" id="sub_total"
                                                readonly>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label">Delivery Cost (₱)</label>
                                            <input class="form-control" type="number" id="delivery_fee"
                                                value="{{ $cart->user->municipality->fee }}" readonly>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label">Grand Total (₱)</label>
                                            <input class="form-control" type="number" min="0" id="grand_total"
                                                readonly>
                                        </div>


                                        <div class="form-outline mb-2">
                                            <label class="form-label">Select Payment Method *</label>
                                            <select class="form-control" name="payment_method_id">
                                                <option value=""></option>
                                                @foreach ($payment_methods->filter(fn($pm) => $pm->is_online == true) as $payment_method)
                                                    <option value="{{ $payment_method->id }}">
                                                        {{ $payment_method->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Reference No. *</label>
                                            <input class="form-control" type="text" name="reference_no"
                                                placeholder="Enter the reference / control no." required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label">Add Note (Optional)</label>
                                            <input class="form-control" type="text" name="note"
                                                placeholder="Enter Note" required>
                                        </div>


                                        <div>
                                            <input class="payment_receipt" type="file" name="image">
                                        </div>

                                        <button type="button" class="btn btn-primary"
                                            onclick="promptStore(event, '#order_form', 'Order Now?', 'Please double check your selected product. We do not offer a cancelation of order.', 'Yes')">Order
                                            Now
                                        </button>

                                    </div>
                                </div>
                            </div>
                        @else
                            <figure>
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/cart/empty.svg') }}"
                                    alt="empty"><br>
                                <figcaption>
                                    <p class="text-center">Oops! Shopping Cart is Empty</p>
                                </figcaption>
                            </figure>

                        @endif

                    </div>
                </form>

                {{-- End ROW --}}
            </div>

            <div class="col-md-3">
                <div class="card card-body">

                    <img class="img-fluid" src="{{ asset('img/reminder/default.svg') }}" alt="reminder"> <br>

                    <h4 class="text-danger">
                        • Reminders - Please read the product description thoroughly before placing your order.
                    </h4>


                    <p>
                        To ensure a personalized experience and discuss your customized handicrafts needs,
                        please connect with us first before ordering the product. You can send the image you
                        would like to have customized to our email address: <a class="font-weight-bold"
                            href="mailto:virgilio.handicraft2@gmail.com">virgilio.handicraft2@gmail.com</a>. Please
                        make sure to add a subject title of "<strong>FullName - Customized Handicrafts</strong>" to your
                        email.

                    </p>

                    <p>

                        <span class='text-primary'>Virgilio Handicraft </span>, At Virgilio Handicrafts, we specialize in
                        crafting exquisite Christian sculptures, each piece
                        meticulously sculpted by skilled artisans. With a passion for preserving heritage and a commitment
                        to
                        quality, we take pride in creating handcrafted masterpieces that reflect the essence of faith and
                        spirituality.

                        Our journey began with a vision to honor the rich cultural heritage of Paete, renowned for its
                        tradition
                        of wood carving. Drawing inspiration from centuries-old techniques and imbued with a spirit of
                        reverence, our sculptures capture the beauty and depth of Christian symbolism.
                    </p>


                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        $('#cart_nav').addClass('active')

        initiateFilePond('.payment_receipt', [
            "image/png",
            "image/jpeg",
            "image/jpg",
            "image/webp",
        ], 'Upload or <span class="filepond--label-action"> Browse Payment Receipt </span>')
    </script>
@endsection
