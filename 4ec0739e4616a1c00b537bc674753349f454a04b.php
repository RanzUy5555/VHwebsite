

<?php $__env->startSection('title', 'Admin | Manage User'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover user_dt">
                                <caption>List of User's Account <i class="fas fa-users ml-1"></i> </caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Verified</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Registered At</th>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nicon\OneDrive\Desktop\Virgilio Handicrafts\vh-beta\resources\views/admin/user/index.blade.php ENDPATH**/ ?>