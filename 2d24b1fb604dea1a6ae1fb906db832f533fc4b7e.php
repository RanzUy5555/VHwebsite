

<?php $__env->startSection('title', 'Admin | Requested Quotation'); ?>

<?php $__env->startSection('styles'); ?>

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
                        <div class="table-responsive">
                            <table class="table table-flush table-hover request_dt">
                                <caption>List of Requested Quotation</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Service / Subject</th>
                                        <th>Message</th>
                                        <th>Target Date</th>
                                        <th>Link</th>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nicon\OneDrive\Desktop\Virgilio Handicrafts\vh-beta\resources\views/admin/request/index.blade.php ENDPATH**/ ?>