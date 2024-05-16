

<?php $__env->startSection('title', 'Admin | Product Info'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.products.index')); ?>">All Products</a>
                </li>
                <li class="breadcrumb-item"> <?php echo e($product->category->name); ?>

                </li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">

                <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row justify-content-center ">
                    <div class="col-md-6 d-flex align-self-stretch">
                        <div class="card card-shadow-none hoverable w-100">
                            <a href="<?php echo e($product->featured_photo); ?>" class="glightbox">
                                <img class="card-img-top" src="<?php echo e($product->featured_photo); ?>"
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
                            <div class="card-body d-flex and flex-column">

                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                <h2>
                                    <q><?php echo e($product->name); ?></q>
                                </h2>
                                <h4 class="font-weight-normal">
                                    Description: <?php echo e($product->description); ?>

                                </h4>
                                <h4 class="font-weight-normal">
                                    Category: <?php echo e($product->category->name); ?>

                                </h4>

                                <h2 class="font-weight-normal text-primary" id="price"
                                    data-price='<?php echo e($product->price); ?>' data-qty='<?php echo e($product->qty); ?>'>
                                    ₱
                                    <?php echo e($product->price); ?>

                                </h2>


                                <br>
                                <h4 class="font-weight-normal text-right"><?php echo e($product->qty); ?> Items left</h4>
                                <hr class="mb-3">

                                <?php if($product->qty <= 10 && $product->qty !== 0): ?>
                                    <div class="alert alert-danger alert-dismissible fade show p-3 text-white"
                                        role="alert"">
                                        <h4 class="text-white font-weight-normal">WARNING: The Product is ALMOST OUT OF
                                            STOCK.
                                            Please contact
                                            the supplier <i class="fas fa-exclamation-triangle ml-1 "></i>
                                        </h4>
                                    </div>
                                    <br>
                                <?php endif; ?>


                                <?php if($product->qty == 0): ?>
                                    <div class="alert alert-danger alert-dismissible fade show p-3 text-white"
                                        role="alert"">
                                        <h4 class="text-white font-weight-normal">WARNING: The Product is SOLDOUT
                                            Please contact
                                            the supplier <i class="fas fa-exclamation-triangle ml-1 "></i>
                                        </h4>
                                    </div>
                                    <br>
                                <?php endif; ?>


                                <h3 class="text-capitalize"> <i class="fas fa-building mr-1"></i> Company -
                                    <?php echo e($product->supplier->company); ?>

                                </h3>
                                <h4 class="font-weight-normal text-capitalize"><i class="fas fa-user mr-1"></i> Manager -
                                    <?php echo e($product->supplier->manager); ?>

                                </h4>
                                <h4 class="font-weight-normal text-capitalize"><i class="fas fa-phone mr-1"></i> Contact -
                                    <a href="tel:<?php echo e($product->supplier->contact); ?>"><?php echo e($product->supplier->contact); ?></a>
                                </h4>
                                <h4 class="font-weight-normal"><i class="fas fa-envelope mr-1"></i> Email -
                                    <a href="mailto:<?php echo e($product->supplier->email); ?>"><?php echo e($product->supplier->email); ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views\admin\product\show.blade.php ENDPATH**/ ?>