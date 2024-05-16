

<?php $__env->startSection('title', 'Virgilio Handicraft | Request Quotation'); ?>

<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('assets/css/utils/datatables.bootstrap4.min.css')); ?>" rel="stylesheet" /> 
    <link href="<?php echo e(asset('assets/css/utils/datatables.rowReorder.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/css/utils/datatables.responsive.min.css')); ?>" rel="stylesheet" />

    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid py-4">
        <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="<?php echo e(route('user.requests.create')); ?>">Request
                            Quotation +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover request_dt">
                                <caption>List of Requested Quotation</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Service</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/utils/datatables.min.js')); ?>"></script> 
    <script src="<?php echo e(asset('assets/js/utils/datatables.rowReorder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/utils/datatables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/utils/datatables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/utils/datatables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/shared/crud.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nicon\OneDrive\Desktop\Virgilio Handicrafts\vh-beta\resources\views/user/request/index.blade.php ENDPATH**/ ?>