@extends('layouts.admin.app')

@section('title', 'Admin | Create Product')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">All Product</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create Product</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            Create Product <i class="fas fa-clipboard-list ml-1"></i>
                        </h2>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Select Form:</label>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="type"
                                            class="custom-control-input" value="product" onchange="displayFormField(this)">
                                        <label class="custom-control-label" for="customRadioInline1">Product
                                        </label>
                                    </div>


                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="type"
                                            class="custom-control-input" value="product_variety"
                                            onchange="displayFormField(this)">
                                        <label class="custom-control-label" for="customRadioInline2">Product With Variety
                                        </label>
                                    </div>

                                </div>
                                @include('layouts.includes.alert')
                                <div id="to_product" style="display:none">
                                    <form class="row" action="{{ route('admin.products.store') }}" method="post"
                                        id="product_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Supplier *</label>
                                                <select class="form-control" name="supplier_id">
                                                    <option value=""></option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">
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
                                                        <option value="{{ $category->id }}">
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
                                                        <option value="{{ $brand->id }}">
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Customized / San Roque Statue – 2ft" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Description *</label>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Add Description" required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Price (₱) *</label>
                                                <input type="number" class="form-control" min="0" name="price"
                                                    required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Qty *</label>
                                                <input type="number" class="form-control" min="10" name="qty"
                                                    required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Is Customizable?</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="yes" name="is_customized" value="1"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="yes">Yes</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="no" name="is_customized" value="0"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="no">No</label>
                                                </div>
                                            </div>

                                            <div>
                                                <input class="product_images" type="file" name="image[]" multiple
                                                    data-allow-reorder="true" data-max-file-size="3MB"
                                                    data-max-files="3">
                                            </div>
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptStore(event,'#product_form')">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div id="to_product_variety" style="display:none">
                                    <form class="row" action="{{ route('admin.products.store') }}" method="post"
                                        id="product_variety_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Supplier *</label>
                                                <select class="form-control" name="supplier_id">
                                                    <option value=""></option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">
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
                                                        <option value="{{ $category->id }}">
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
                                                        <option value="{{ $brand->id }}">
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label class="form-label">Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Customized / Personalized White T-Shirt Sublimation Print"
                                                    required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Description *</label>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Add Description" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Is Customizable?</label>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="yes" name="is_customized"
                                                        value="1" class="custom-control-input">
                                                    <label class="custom-control-label" for="yes">Yes</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="no" name="is_customized"
                                                        value="0" class="custom-control-input">
                                                    <label class="custom-control-label" for="no">No</label>
                                                </div>
                                            </div>

                                            <div>
                                                <input class="product_images" type="file" name="image[]" multiple
                                                    data-allow-reorder="true" data-max-file-size="3MB"
                                                    data-max-files="3">
                                            </div>
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptStore(event,'#product_variety_form')">
                                                Submit
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
                                                            <input class="form-control form-control" type="text"
                                                                name="product_variety_name[]"
                                                                placeholder="Ex. Small | Medium | Large" required>
                                                        </div>
                                                        <div class="col-2">
                                                            <input class="form-control form-control" type="number"
                                                                min="0" name="product_variety_qty[]"
                                                                placeholder="Qty" required>
                                                        </div>
                                                        <div class="col-3">
                                                            <input class="form-control form-control" type="number"
                                                                min="0" name="product_variety_price[]"
                                                                placeholder="Price" required>
                                                        </div>
                                                        <div class="col-2">
                                                            <a href="javascript:void(0)" role="button"
                                                                onclick="addProductVarietyInputField()"> <i
                                                                    class="fas fa-plus-circle text-success mt-2"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </form>
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
                            <input class="form-control form-control" type="text" name="product_variety_name[]"  required>
                        </div>
                        <div class="col-2">
                            <input class="form-control form-control" type="number" min="0" name="product_variety_qty[]" required>
                        </div>
                        <div class="col-3">
                            <input class="form-control form-control" type="number" min="0" name="product_variety_price[]" required>
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
