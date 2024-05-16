

<?php $__env->startSection('title', 'Manage Profile'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="container-fluid mt-0 mt-md-4">
        <div class="row justify-content-center align-items-center">
            <form action="<?php echo e(route('profile.update', auth()->id())); ?>" method="POST"
                class="col-md-5 mx-auto bg-white p-5 rounded" id="profile_form">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

                <img src="<?php echo e(handleNullAvatar(auth()->user()->avatar_profile)); ?>" class="custom-avatar d-block mx-auto"
                    width='130' alt="avatar.svg">
                <br>

                <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="form-group mb-2 ">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="<?php echo e(auth()->user()->full_name); ?>" readonly>
                </div>

                <div class="form-group mb-2 ">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="<?php echo e(auth()->user()->email); ?>" readonly>
                </div>

                <div class="form-group mb-2 ">
                    <label class="form-label">Current Password</label>
                    <input type="text" class="form-control"" name=" old">
                </div>

                <div class="form-group mb-2 ">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control"" name=" password" placeholder="•••••••••"
                        autocomplete="new-password">
                </div>

                <div class="form-group mb-2 ">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control"" name=" password_confirmation" placeholder="•••••••••"
                        autocomplete="new-password">
                </div>

                <input type="file" name="avatar" id="user_image">
                <button type="button" class="btn btn-primary form-control"
                    onclick="promptUpdate(event, '#profile_form')">Update
                    Profile
                </button>
            </form>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        initiateFilePond('#user_image', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Drag & Drop or <span class="filepond--label-action"> Browse Avatar</span>')
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\nicon\OneDrive\Desktop\Virgilio Handicrafts\vh-beta\resources\views/user/profile/index.blade.php ENDPATH**/ ?>