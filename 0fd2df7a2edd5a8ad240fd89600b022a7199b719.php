

<?php $__env->startSection('title', 'Admin | Manage Municipality'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_municipality', '.municipality_form', ['#m_municipality_title','Add Municipality'], ['.btn_add_municipality','.btn_update_municipality'])">Create
                            Municipality +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover municipality_dt">
                                <caption>List of Municipality</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Municipality</th>
                                        <th>Delivery Fee (₱)</th>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views/admin/municipality/index.blade.php ENDPATH**/ ?>