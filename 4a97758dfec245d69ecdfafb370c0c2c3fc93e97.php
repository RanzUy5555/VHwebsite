

<?php $__env->startSection('title', 'Admin | Orders'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <select class="form-control form-control-sm" onchange="getOrderByStatus(this)">
                                    <option value="" disabled selected>--- All Status ---
                                    </option>
                                    <option value="0">Pending</option>
                                    <option value="1">Approved</option>
                                    <option value="2">Rejected</option>
                                    <option value="3">On Delivery</option>
                                    <option value="4">Delivered</option>
                                </select>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover order_dt">
                                <caption>List of Order</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction No.</th>
                                        <th>Reference No.</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views/admin/order/index.blade.php ENDPATH**/ ?>