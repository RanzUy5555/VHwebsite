

<?php $__env->startSection('title', 'Admin | Manage Supplier'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_supplier', '.supplier_form', ['#m_supplier_title','Add Supplier'], ['.btn_add_supplier','.btn_update_supplier'])">Create
                            Supplier +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover supplier_dt">
                                <caption>List of Supplier</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Manager</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Registered At</th>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views\admin\supplier\index.blade.php ENDPATH**/ ?>