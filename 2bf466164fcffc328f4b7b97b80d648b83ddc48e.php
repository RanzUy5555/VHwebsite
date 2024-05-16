

<?php $__env->startSection('title', 'Virgilio Handicraft | Product Info'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('main.products.index')); ?>">All Products</a>
                        </li>
                        <li class="breadcrumb-item"> <?php echo e($product->category->name); ?>

                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
                    </ol>
                </nav>
                <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row justify-content-center ">
                    <div class="col-md-3 d-none d-md-block">

                        
                        <?php if($product->is_customized): ?>
                            <div class="card w-100 card-shadow-none hoverable card-less">
                                <img class="card-img-top" src="<?php echo e(asset('img/reminder/default.svg')); ?>" width="120"
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
                        <?php endif; ?>


                    </div>
                    <div class="col-md-6 ">
                        <div class="card card-shadow-none hoverable">
                            <a href="<?php echo e($product->featured_photo); ?>" class="glightbox">
                                <img class="card-img-top zoom_image" src="<?php echo e($product->featured_photo); ?>"
                                    data-zoom-image="<?php echo e($product->large_featured_photo); ?>"
                                    title="click to view more photos">
                            </a>
                            <div class="collapse" id="view_photos">
                                <?php $__empty_1 = true; $__currentLoopData = $product->getMedia('product_images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php if(!$loop->first): ?>
                                        <a href="<?php echo e($image->getUrl()); ?>" class="glightbox">
                                            <img class="img-fluid" src="<?php echo e($image->getUrl()); ?>" width="100"
                                                alt="image">
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    No Available Photos
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card card-body">

                            <h3>
                                <q><?php echo e($product->name); ?></q>
                            </h3>

                            <h5 class="font-weight-normal">
                                Description: <?php echo e($product->description); ?>

                            </h5>

                            <h5 class="font-weight-normal">
                                <?php echo e($product->is_available ? 'In Stock' : 'Out of Stock'); ?>

                            </h5>
                            <h5 class="font-weight-normal">
                                Shipped From: <?php echo e(config('app.name')); ?>

                            </h5>

                            <h2 class="font-weight-normal text-primary" id="price"
                                data-price='<?php echo e($product->price ?? $product->varieties->first()->price); ?>'
                                data-qty='<?php echo e($product->qty ? $product->qty : $product->varieties->first()->qty); ?>'>
                                ₱
                                <?php echo e($product->price ?? $product->varieties->first()->price); ?>

                            </h2>

                            
                            <?php if($product->varieties->isNotEmpty()): ?>
                                <a class="text-primary text-small" data-toggle="collapse" href="#show_description"
                                    role="button" aria-expanded="false" aria-controls="show_description">
                                    View Sizes
                                </a>
                                <div class="collapse mt-2" id="show_description">
                                    
                                    <div class="row">
                                        <?php $__currentLoopData = $product->varieties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variety): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($loop->first): ?>
                                                <a class="px-2" href="javascript:void(0)"
                                                    onclick="getProductVariety(<?php echo e($variety); ?>)">
                                                    <span class="badge badge-primary variety"
                                                        id="variety-<?php echo e($variety->id); ?>"
                                                        data-id='<?php echo e($variety->id); ?>'><?php echo e($variety->name); ?></span>
                                                </a>
                                            <?php else: ?>
                                                <a class="px-2" href="javascript:void(0)"
                                                    onclick="getProductVariety(<?php echo e($variety); ?>)">
                                                    <span class="badge badge-secondary variety"
                                                        id="variety-<?php echo e($variety->id); ?>"
                                                        data-id='<?php echo e($variety->id); ?>'><?php echo e($variety->name); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                </div>
                            <?php endif; ?>

                            <form action="<?php echo e(route('user.carts.store')); ?>" method="POST" id="cart_form">
                                <?php echo csrf_field(); ?>

                                
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
                                    
                                    <?php if($product->varieties->isNotEmpty()): ?>
                                        <input type="hidden" name="product_variety_id"
                                            value="<?php echo e($product->varieties->first()->id); ?>">
                                    <?php else: ?>
                                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                    <?php endif; ?>
                                </div>
                            </form>


                            <h5 class="font-weight-normal text-right" id="qty">
                                <?php echo e($product->qty ?? $product->varieties->first()->qty); ?> Items left</h5>
                            
                        </div>
                    </div>

                    <div class="col-md-3 d-none d-md-block">
                        <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card w-100 card-shadow-none hoverable card-less">
                                <img class="card-img-top"
                                    src="<?php echo e(handleNullFeaturedPhoto($related_product->featured_photo)); ?>" width="120"
                                    alt="product">
                                <div class="card-body d-flex and flex-column text-left">
                                    <a class="card-text mb-2" href="<?php echo e(route('main.products.show', $related_product)); ?>">
                                        <?php echo e($related_product->name); ?>

                                    </a>
                                    <span class="font-weight-bold">
                                        ₱<?php echo e($related_product->price ? $related_product->price : $related_product->variety_range); ?>

                                    </span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views\main\product\show.blade.php ENDPATH**/ ?>