

<?php $__env->startSection('title', 'Admin | Order Invoice'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="container-fluid py-4">
        <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.orders.index')); ?>">All Orders</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Order #<?php echo e($orders[0]->transaction_no); ?></li>
            </ol>
        </nav>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i
                            class="fas fa-info-circle mr-2"></i>Order Invoice</a>
                </li>

                <?php if(
                    $orders[0]->status == \App\Models\Order::PENDING ||
                        $orders[0]->status == \App\Models\Order::APPROVED ||
                        $orders[0]->status == \App\Models\Order::ON_DELIVERY): ?>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                            href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                            aria-selected="false"><i class="fas fa-cog mr-2"></i>Manage Order</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                        href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i
                            class="fas fa-print mr-2"></i>Print Invoice</a>
                </li>

            </ul>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div class="row justify-content-center">
                    <div class="col-md-7 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-12">
                                            
                                            <?php if($order->product_id): ?>
                                                <div class="row align-items-center">
                                                    
                                                    <div class="col-3">
                                                        <img class="d-block mx-auto rounded w-100 h-100"
                                                            src="<?php echo e(handleNullFeaturedPhoto($order->product->featured_photo)); ?>"
                                                            alt="<?php echo e($order->product->name); ?>">
                                                    </div>

                                                    
                                                    <div class="col-9">
                                                        <h5 class="font-weight-normal"><?php echo e($order->product->name); ?> |
                                                            <?php echo e($order->product->category->name); ?></h5>
                                                        <h4 class="text-primary product_price">₱
                                                            <?php echo e($order->product->price); ?> x <?php echo e($order->qty); ?>

                                                        </h4>
                                                        <h5 class="font-weight-normal text-right text-primary">
                                                            <a href="<?php echo e(route('admin.products.show', $order->product)); ?>">
                                                                <?php echo e($order->product->qty == 0 ? 'Sold Out' : 'Items left'); ?>

                                                            </a>
                                                        </h5>
                                                    </div>
                                                </div>

                                                
                                            <?php else: ?>
                                                <div class="row align-items-center">
                                                    
                                                    <div class="col-3">
                                                        <img class="d-block mx-auto rounded w-100 h-100"
                                                            src="<?php echo e(handleNullFeaturedPhoto($order->product_variety->product->featured_photo)); ?>"
                                                            alt="<?php echo e($order->product_variety->product->name); ?>">
                                                    </div>

                                                    
                                                    <div class="col-9">
                                                        <h5 class="font-weight-normal">
                                                            <?php echo e($order->product_variety->product->name); ?> |
                                                            <?php echo e($order->product_variety->product->category->name); ?>

                                                        </h5>
                                                        <h4 class="text-primary product_price">₱
                                                            <?php echo e($order->product_variety->price); ?> x <?php echo e($order->qty); ?>

                                                        </h4>
                                                        <h5 class="font-weight-normal text-right text-primary">
                                                            <?php echo e($order->product_variety->product->qty); ?>

                                                            <a
                                                                href="<?php echo e(route('admin.products.show', $order->product_variety->product)); ?>">
                                                                <?php echo e($order->product_variety->qty == 0 ? 'Sold Out' : 'Items left'); ?>

                                                            </a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(!$loop->last): ?>
                                                <hr>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5  d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                
                                <div>
                                    <h3 class="font-weight-normal">Customer Details <i class="fas fa-user-check ml-1"></i>
                                    </h3> <br>

                                    <h4 class="font-weight-normal">
                                        Name: <?php echo e($order->user->full_name); ?>

                                    </h4>
                                    <h4 class="font-weight-normal">
                                        Address: <?php echo e($order->user->address); ?>

                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Contact: <?php echo e($order->user->contact); ?>

                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Email: <a href="mailto:<?php echo e($order->user->email); ?>"><?php echo e($order->user->email); ?></a>
                                    </h4>
                                </div>
                                <hr>
                                
                                <div>
                                    <h3 class="font-weight-normal">Invoice <i
                                            class="fas fa-credit-card ml-1 text-primary"></i>
                                    </h3>

                                    <?php
                                        $sub_total = $orders->reduce(function ($carry, $item) {
                                            if ($item->product_id) {
                                                return $carry + $item->product->price * $item->qty;
                                            } else {
                                                return $carry + $item->product_variety->price * $item->qty;
                                            }
                                        });

                                    ?>


                                    <h3 class="font-weight-normal">
                                        Grand Total (₱): <?php echo e(number_format($sub_total + $orders[0]->municipality->fee, 2)); ?>

                                    </h3>


                                    <h4 class="font-weight-normal">
                                        Sub Total (₱): <?php echo e(number_format($sub_total, 2)); ?>

                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Delivery Fee (₱): <?php echo e(number_format($orders[0]->municipality->fee, 2)); ?>

                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Order No. <?php echo e($order->transaction_no); ?>

                                    </h4>
                                    
                                    <h4 class="font-weight-normal">
                                        Reference No. <?php echo e($order->reference_no); ?>

                                    </h4>
                                    <h4 class="font-weight-normal">
                                        Paid Via: <span
                                            class="badge badge-success"><?php echo e($order->payment_method->type); ?></span>
                                    </h4>

                                    <h4 class="font-weight-normal">
                                        Order Status: <?php echo handleOrderStatus($order->status); ?>

                                    </h4>

                                    <a class="text-primary text-small" data-toggle="collapse" href="#collapseExample"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                        View Payment Receipt
                                    </a>

                                    <div class="collapse mt-3" id="collapseExample">
                                        <a class="glightbox" href="<?php echo e(handleNullImage($order->payment_receipt)); ?>">
                                            <img class="img-thumbnail"
                                                src="<?php echo e(handleNullImage($order->payment_receipt)); ?>" width="100"
                                                alt="payment receipt">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="row justify-content-center">
                    

                    <?php if(
                        $orders[0]->status == \App\Models\Order::PENDING ||
                            $orders[0]->status == \App\Models\Order::APPROVED ||
                            $orders[0]->status == \App\Models\Order::ON_DELIVERY): ?>
                        <div class="col-md-8">

                            <div class="card card-body">
                                <h2 class="text-primary">Manage Order *</h2>

                                <div class="text-center">
                                    <?php if($orders[0]->status == \App\Models\Order::PENDING): ?>
                                        <img class="img-fluid" src="<?php echo e(asset('img/order/pending.svg')); ?>" width="300"
                                            alt="pending">
                                        <h3> Status: order waiting to being processed ...</h3>
                                    <?php elseif($orders[0]->status == \App\Models\Order::APPROVED): ?>
                                        <img class="img-fluid" src="<?php echo e(asset('img/order/approved.svg')); ?>"
                                            width="300" alt="approved">
                                        <h3> Status: order has been approved it is now being processed ...</h3>
                                    <?php elseif($orders[0]->status == \App\Models\Order::REJECTED): ?>
                                        <img class="img-fluid" src="<?php echo e(asset('img/order/rejected.png')); ?>"
                                            width="300" alt="rejected">
                                        <h3 class="text-center"> order has been rejected ...</h3>
                                    <?php elseif($orders[0]->status == \App\Models\Order::ON_DELIVERY): ?>
                                        <img class="img-fluid" src="<?php echo e(asset('img/order/on_delivery.svg')); ?>"
                                            width="300" alt="on_delivery">
                                        <h3> Status: order is now on delivery ...</h3>
                                    <?php elseif($orders[0]->status == \App\Models\Order::DELIVERED): ?>
                                        <img class="img-fluid" src="<?php echo e(asset('img/order/delivered.svg')); ?>"
                                            width="300" alt="delivered">
                                        <h3> Status: order has been delivered ...</h3>
                                    <?php else: ?>
                                        <img class="img-fluid" src="<?php echo e(asset('img/order/rejected.png')); ?>"
                                            width="300" alt="rejected">
                                        <h3 class="text-center"> Your order has been canceled ...</h3>
                                        <h3 class="text-center"> Remark: <?php echo e($orders[0]->remark ?? 'N/A'); ?></h3>
                                    <?php endif; ?>
                                </div>
                                <form action="<?php echo e(route('admin.orders.update', $order)); ?>" method="POST"
                                    id="order_form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                                    
                                    <?php if($orders[0]->note): ?>
                                        <div class="alert alert-primary alert-dismissible fade show p-3 text-white mt-2"
                                            role="alert">
                                            Customer's Note: <?php echo e($orders[0]->note); ?>

                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group mb-2">
                                        <label class="form-label">Select Status</label>
                                        <select name="status" class="form-control" onchange="manageOrder(this)">
                                            <option value=""></option>

                                            <?php if($orders[0]->status == \App\Models\Order::PENDING): ?>
                                                <option value="1">Approve Order</option>
                                                <option value="2">Reject Order</option>
                                            <?php endif; ?>

                                            <?php if($orders[0]->status == \App\Models\Order::APPROVED): ?>
                                                <option value="3">Mark as On-Delivery</option>
                                                <option value="4">Mark as Delivered</option>
                                                <option value="5">Mark as Canceled</option>
                                            <?php endif; ?>

                                            <?php if($orders[0]->status == \App\Models\Order::ON_DELIVERY): ?>
                                                <option value="4">Mark as Delivered</option>
                                            <?php endif; ?>

                                        </select>
                                    </div>


                                    <div class="form-group mb-2">
                                        <label class="form-label">Remark</label>
                                        <textarea class="form-control" name="remark" rows="6" placeholder="Add Remark (Optional). "></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2"
                                        onclick="promptUpdate(event, '#order_form', 'Do you want to Update Order Status?', '', 'Yes')">Save</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>

            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-outline-primary float-right"
                                    href="<?php echo e(route('admin.print.handle')); ?>?records=invoice&transaction_no=<?php echo e($orders[0]->transaction_no); ?>">Print</a>
                            </div>
                            <div class="card-body pt-5">
                                <div class="mb-5 justify-content-center text-center">
                                    <img class="img-fluid" src="<?php echo e(asset('img/logo/logo.png')); ?>" width="130"
                                        alt="Virgilio Handicraft"> <br><br>
                                    <h3><?php echo e(config('app.name')); ?></h3>
                                    <p> Manila East Road Hi-way Paete, Laguna, Philippines</p>
                                    <h2 class="font-weight-bold">Official Receipt</h2>
                                </div>
                                <div class="row font-monospace">
                                    <div class="col-6">
                                        <p>Order No: <?php echo e($orders[0]->transaction_no); ?></p>
                                        <p class="">Customer: <?php echo e($orders[0]->user->full_name); ?></p>
                                        <p class="">Date: <?php echo e(formatDate($orders[0]->created_at)); ?></p>
                                    </div>
                                </div>
                                <br><br>
                                <div class="table-responsive">
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
                                            <?php
                                                $totals = [];
                                            ?>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($order->product_id): ?>
                                                    <tr>
                                                        <td><?php echo e($order->product->code); ?></td>
                                                        <td><?php echo e($order->product->name); ?> </td>
                                                        <td><?php echo e($order->qty); ?></td>
                                                        <td>₱
                                                            <?php echo e(number_format($order->product->price * $order->qty, 2)); ?>

                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                        $totals[] = $order->product->price * $order->qty;
                                                    ?>

                                                    
                                                <?php else: ?>
                                                    <tr>
                                                        <td><?php echo e($order->product_variety->product->code); ?></td>
                                                        <td><?php echo e($order->product_variety->product->name); ?> -
                                                            <?php echo e($order->product_variety->name); ?></td>
                                                        <td><?php echo e($order->product_variety->qty); ?></td>
                                                        <td>₱
                                                            <?php echo e(number_format($order->product_variety->price * $order->qty, 2)); ?>

                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                        $totals[] = $order->product_variety->price * $order->qty;
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td> ₱ <?php echo e(number_format($orders[0]->municipality->fee, 2)); ?></td>
                                                <td>₱
                                                    <?php echo e(number_format(collect($totals)->sum() + $orders[0]->municipality->fee, 2)); ?>

                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        // function manageOrder(status) {
        //     if (!status.value) {
        //         $('#date_picker').css('display', 'none');
        //         $('#tracking_link').css('display', 'none');
        //         return;
        //     }

        //     if (status.value == 3) {
        //         $('#tracking_link').css('display', 'block');
        //         $('#date_picker').css('display', 'none');

        //     } else if (status.value == 4) {
        //         $('#date_picker').css('display', 'block');
        //         $('#tracking_link').css('display', 'none');

        //     } else {
        //         $('#tracking_link').css('display', 'none');
        //         $('#date_picker').css('display', 'none');

        //     }

        // }

        $('#order_management_nav').addClass('active');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views\admin\order\show.blade.php ENDPATH**/ ?>