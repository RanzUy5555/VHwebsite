@extends('layouts.admin.app')

@section('title', 'Admin | Edit Product')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">All Product</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit {{ $product->name }}</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            Edit Product <i class="fas fa-edit ml-1"></i>
                        </h2>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                @include('layouts.includes.alert')

                                {{-- if the product has no variety --}}
                                @if ($product->varieties->isEmpty())
                                    <form class="row" action="{{ route('admin.products.update', $product) }}"
                                        method="post" enctype="multipart/form-data" id="product_form">
                                        @csrf @method('PUT')
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Supplier *</label>
                                                <select class="form-control" name="supplier_id">
                                                    <option value=""></option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            @if ($product->supplier_id == $supplier->id) selected @endif>
                                                            {{ $supplier->company }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Category *</label>
                                                <select class="form-control" name="category_id">
                                                    <option value=""></option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if ($product->category_id == $category->id) selected @endif>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Brand *</label>
                                                <select class="form-control" name="brand_id">
                                                    <option value=""></option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            @if ($product->brand_id == $brand->id) selected @endif>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Ex. PE Book" value="{{ $product->name }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Description *</label>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Add Description" value="{{ $product->description }}"
                                                    required>
                                            </div>


                                            <div class="form-group mb-2">
                                                <label class="form-label">Price (₱) *</label>
                                                <input type="number" class="form-control" min="0" name="price"
                                                    value="{{ $product->price }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Qty *</label>
                                                <input type="number" class="form-control" min="0" name="qty"
                                                    value="{{ $product->qty }}" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Is Customizable?</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="yes" name="is_customized" value="1"
                                                        class="custom-control-input"
                                                        {{ $product->is_customized ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="yes">Yes</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="no" name="is_customized" value="0"
                                                        class="custom-control-input"
                                                        {{ !$product->is_customized ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="no">No</label>
                                                </div>
                                            </div>

                                            <div>
                                                <input class="product_images" type="file" name="image[]" multiple
                                                    data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                                            </div>
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event,'#product_form', 'Do you want to Update?', 'Note: Uploading new image/s will overwrite the existing one', 'Yes')">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    {{-- if the product has varieties --}}
                                    <form class="row" action="{{ route('admin.products.update', $product) }}"
                                        method="post" id="product_variety_form" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Supplier *</label>
                                                <select class="form-control" name="supplier_id">
                                                    <option value=""></option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            @if ($product->supplier_id == $supplier->id) selected @endif>
                                                            {{ $supplier->company }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Category *</label>
                                                <select class="form-control" name="category_id">
                                                    <option value=""></option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if ($product->category_id == $category->id) selected @endif>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Brand *</label>
                                                <select class="form-control" name="brand_id">
                                                    <option value=""></option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            @if ($product->brand_id == $brand->id) selected @endif>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Ex. PE Book" value="{{ $product->name }}" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Description *</label>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Add Description" value="{{ $product->description }}"
                                                    required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Is Customizable?</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="yes" name="is_customized"
                                                        value="1" class="custom-control-input"
                                                        {{ $product->is_customized ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="yes">Yes</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="no" name="is_customized"
                                                        value="0" class="custom-control-input"
                                                        {{ !$product->is_customized ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="no">No</label>
                                                </div>
                                            </div>


                                            <div>
                                                <input class="product_images" type="file" name="image[]" multiple
                                                    data-allow-reorder="true" data-max-file-size="3MB"
                                                    data-max-files="3">
                                            </div>
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event,'#product_variety_form', 'Do you want to Update?', 'Note: Uploading new image/s will overwrite the existing one', 'Yes')">
                                                Save
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset>
                                                <legend>
                                                    <h4 class="text-primary">
                                                        Add More Varieties <i class="fas fa-list ml-1"></i>
                                                    </h4>
                                                </legend>
                                                <div id="product_variety_input">
                                                    <div class="row py-2">
                                                        <div class="col-5">
                                                            <input class="form-control" type="text"
                                                                name="product_variety_name[]"
                                                                placeholder="Ex. extra small | medium | large" required>
                                                        </div>
                                                        <div class="col-2">
                                                            <input class="form-control" type="number" min="0"
                                                                name="product_variety_qty[]" placeholder="Enter Qty"
                                                                required>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control" type="number" min="0"
                                                                name="product_variety_price[]" placeholder="Enter Price"
                                                                required>
                                                        </div>
                                                        <div class="col-2">
                                                            <a href="javascript:void(0)" role="button"
                                                                onclick="addProductVarietyInputField()"> <i
                                                                    class="fas fa-plus-circle text-success mt-2"></i></a>
                                                        </div>
                                                    </div>
                                                    @foreach ($product->varieties as $variety)
                                                        <div class="row py-2" id="row_input-{{ $variety->id }}">
                                                            <div class="col-5">
                                                                <input class="form-control" type="text"
                                                                    name="product_variety_name[]"
                                                                    placeholder="Ex. extra small | medium | large"
                                                                    value="{{ $variety->name }}" required>
                                                            </div>
                                                            <div class="col-2">
                                                                <input class="form-control" type="number" min="0"
                                                                    name="product_variety_qty[]" placeholder="Enter Qty"
                                                                    value="{{ $variety->qty }}" required>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control" type="number" min="0"
                                                                    name="product_variety_price[]"
                                                                    placeholder="Enter Price"
                                                                    value="{{ $variety->price }}" required>
                                                            </div>
                                                            <div class="col-2">
                                                                <a href="javascript:void(0)" role="button"
                                                                    onclick="removeProductVarietyInputField({{ $variety->id }})">
                                                                    <i
                                                                        class="fas fa-minus-circle text-danger mt-2"></i></a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </fieldset>
                                        </div>
                                    </form>
                                @endif
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
        function displayFormField(type) {
            if (!type.value) return false;
            if (type.value == "product") {
                $("#to_product_variety").css('display', 'none')
                $("#to_product").css('display', 'block')
            } else {
                $("#to_product").css('display', 'none')
                $("#to_product_variety").css('display', 'block')
            }
        }

        function addProductVarietyInputField() {
            let id = Math.floor((Math.random() * 100) + 1);
            let output = `
                <div class="row py-2" id='row_input-${id}'>
                        <div class="col-5">
                            <input class="form-control" type="text" name="product_variety_name[]"  required>
                        </div>
                        <div class="col-2">
                            <input class="form-control" type="number" min="0" name="product_variety_qty[]" required>
                        </div>
                        <div class="col-3">
                            <input class="form-control" type="number" min="0" name="product_variety_price[]" required>
                        </div>
                        <div class="col-2">
                            <a href="javascript:void(0)" role="button" onclick="removeProductVarietyInputField(${id})"> <i class="fas fa-minus-circle text-danger mt-2"></i></a>
                        </div>
                </div>
        
        `
            $('#product_variety_input').append(output)
        }

        function removeProductVarietyInputField(id) {
            $('#row_input-' + id).remove()
        }

        initiateFilePond('.product_images')

        $("#product_management_nav").addClass("active");
        $("#product").addClass("text-primary");
    </script>
@endsection
