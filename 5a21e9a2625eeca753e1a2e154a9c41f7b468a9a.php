

<?php $__env->startSection('title', 'Admin | Payment Methods'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_payment_method', '.payment_method_form', ['#m_payment_method_title','Add Payment Method'], ['.btn_add_payment_method','.btn_update_payment_method'])">Create
                            Payment Method +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover payment_method_dt">
                                <caption> Payment Methods</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>Type</th>
                                        <th>Account Name</th>
                                        <th>Account No.</th>
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
    <script>
        $('#payment_method_nav').addClass('active')
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views/admin/payment_method/index.blade.php ENDPATH**/ ?>