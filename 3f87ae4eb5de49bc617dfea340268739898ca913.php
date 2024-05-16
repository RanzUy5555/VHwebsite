<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>

    <title><?php echo $__env->yieldContent('title', 'Virgilio Handicraft'); ?></title>
    <?php echo $__env->make('layouts.main.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('styles'); ?>

</head>

<body>
    <?php echo $__env->make('layouts.user.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(url()->current() !== route('auth.login') && url()->current() !== route('auth.register') && !Route::is('password.*')): ?>
        <!-- Navbar -->
        <nav id="navbar-main"
            class="navbar navbar-horizontal navbar-main navbar-expand-lg <?php echo e(Route::is('main.home') ? 'bg-white text-primary' : 'bg-primary navbar-dark'); ?> py-2">
            <div class="container">
                <a class="" href="/">
                    <img class="img-fluid rounded-circle" src="<?php echo e(asset('img/logo/logo.png')); ?>" width="50">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse"
                    aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="/">
                                    <img src="<?php echo e(asset('img/logo/logo.png')); ?>">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <span class="nav-link-inner--text">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('main.about')); ?>"
                                class="nav-link <?php if(Route::is('main.about')): ?> text-warning <?php endif; ?>">
                                <span class="nav-link-inner--text">About</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('main.products.index')); ?>"
                                class="nav-link <?php if(Route::is('main.products.*')): ?> active <?php endif; ?>">
                                <span class="nav-link-inner--text">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('main.services')); ?>"
                                class="nav-link <?php if(Route::is('main.services')): ?> text-warning <?php endif; ?>">
                                <span class="nav-link-inner--text">Services</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/#contact" class="nav-link">
                                <span class="nav-link-inner--text">Contact Us</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('user.requests.create')); ?>"
                                class="nav-link btn <?php echo e(Route::is('main.home') ? 'btn-outline-primary' : 'btn-outline-white text-white'); ?>"
                                id="request_quote">
                                Request a Quote
                            </a>
                        </li>
                        


                    </ul>
                    <hr class="d-lg-none" />
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('auth.login')); ?>" class="nav-link" id="main_login_nav">
                                    <span class="nav-link-inner--text">Login</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('auth.register')); ?>" class="nav-link" id="main_register_nav">
                                    <span class="nav-link-inner--text">Register</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->guard()->check()): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <div class="media align-items-center">
                                        <span class="avatar avatar-sm rounded-circle">
                                            <img src="<?php echo e(handleNullAvatar(auth()->user()->avatar_profile)); ?>"
                                                class="avatar rounded-circle" alt="Image placeholder">
                                        </span>
                                        <div class="media-body  ml-2  d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold"><?php echo e(auth()->user()->name); ?></span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right ">
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">Settings</h6>
                                    </div>
                                    <?php if(auth()->user()->hasRole('admin')): ?>
                                        <a href="<?php echo e(route('admin.dashboard.index')); ?>" class="dropdown-item">
                                            <i class="ni ni-tv-2"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('user.carts.index')); ?>" class="dropdown-item">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>My Cart</span>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('profile.index')); ?>" class="dropdown-item">
                                        <i class="ni ni-single-02"></i>
                                        <span>Profile</span>
                                    </a>

                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item"
                                        onclick="confirm('Do you want to Logout?', '', 'Yes').then(res => res.isConfirmed ? $('#logout').submit() : false)">
                                        <i class="fas fa-power-off"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form action="<?php echo e(route('auth.logout')); ?>" method="post" id="logout"><?php echo csrf_field(); ?></form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>
    <!-- Main content -->
    <main class="main-content">
        <?php echo $__env->yieldContent('content'); ?>

    </main>

    <?php if(
        !Route::is('auth.login') &&
            !Route::is('auth.register') &&
            !Route::is('password.*') &&
            !Route::is('main.products.*') &&
            !Route::is('main.about') &&
            !Route::is('main.services')): ?>
        <?php echo $__env->make('layouts.main.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->make('layouts.main.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(auth()->guard()->check()): ?>
        <script src="<?php echo e(asset('assets/js/client/script.js')); ?>"></script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('script'); ?>

    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>

</body>

</html>
<?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views\layouts\main\app.blade.php ENDPATH**/ ?>