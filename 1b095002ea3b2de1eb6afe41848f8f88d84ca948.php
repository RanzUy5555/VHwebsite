

<?php $__env->startSection('title', 'Admin | Sales Report'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Content -->
    <div class="container-fluid mt-3">

        <ul class="nav nav-pills nav-fill flex-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if(!request()->query('tab') || request()->query('tab') == 'graphs'): ?> active <?php endif; ?>" id="tabs-icons-text-0-tab"
                    data-toggle="tab" href="#tabs-icons-text-0" role="tab" aria-controls="tabs-icons-text-0"
                    aria-selected="true"><i class="fas fa-project-diagram mr-2"></i>Graphs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 <?php if(request()->query('tab') == 'tables'): ?> active <?php endif; ?>"
                    id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                    aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-table mr-2"></i>Tables</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            
            <div class="tab-pane fade <?php if(!request()->query('tab') || request()->query('tab') == 'graphs'): ?> show active <?php endif; ?>" id="tabs-icons-text-0"
                role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                <br>
                
                <form class action="<?php echo e(route('admin.sales_report.index')); ?>" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if(filled(request('category')) && request('category') == $category->id): ?> selected <?php endif; ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <input type="date" class="form-control form-control-sm" max="<?php echo e(now()->format('Y-m-d')); ?>"
                            name="daily">
                        <input type="hidden" name="tab" value="graphs">
                        <button class="btn btn-sm btn-warning">Filter</button>


                    </div>
                </form>
                <br>
                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Daily Sales
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_daily_sales", "Total Daily Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_daily_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <br>

                
                <form class action="<?php echo e(route('admin.sales_report.index')); ?>" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if(filled(request('category')) && request('category') == $category->id): ?> selected <?php endif; ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <input type="text" class="form-control form-control-sm" max="<?php echo e(now()->format('Y-m-d')); ?>"
                            name="start_date" onclick="this.type='date'" placeholder="Start Date">
                        <input type="text" class="form-control form-control-sm" max="<?php echo e(now()->format('Y-m-d')); ?>"
                            name="end_date" onclick="this.type='date'" placeholder="End Date">
                        <input type="hidden" name="tab" value="graphs">
                        <button class="btn btn-sm btn-warning">Filter</button>


                    </div>
                </form>
                <br>
                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Weekly Sales

                                            <?php if(request('start_date') && request('end_date')): ?>
                                                (From - <?php echo e(formatDate(request('start_date'))); ?>

                                                To - <?php echo e(formatDate(request('end_date'))); ?>)
                                            <?php else: ?>
                                                <?php echo e(now()); ?>)
                                            <?php endif; ?>
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_weekly_sales", "Total Weekly Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_weekly_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <br>

                <form class action="<?php echo e(route('admin.sales_report.index')); ?>" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if(filled(request('category')) && request('category') == $category->id): ?> selected <?php endif; ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <select class="form-control form-control-sm" name="month">
                            <option value="">-- Select Month --</option>
                            <?php $__currentLoopData = getOrderMonths(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($month['month_no']); ?>"
                                    <?php if(filled(request('month')) && request('month')): ?> selected <?php endif; ?>>
                                    <?php echo e($month['month']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <div class="input-group-append">
                            <select class="form-control form-control-sm" name="year">
                                <option value="">-- Select Year --</option>
                                <?php $__currentLoopData = getOrderYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($year['year']); ?>" <?php if(filled(request('month')) && request('month')): ?> selected <?php endif; ?>>
                                        <?php echo e($year['year']); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="hidden" name="tab" value="graphs">
                            <button class="btn btn-sm btn-warning">Filter</button>

                        </div>
                    </div>
                </form>
                <br>
                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Monthly Sales
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_monthly_sales", "Total Monthly Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_monthly_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">

                                            Total Yearly Sales

                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_yearly_sales", "Total Yearly Sales")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_yearly_sales"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Total Products By Category
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_total_product_by_category", "Total Product By Category")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_total_product_by_category"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            Top Selling Product
                                        </h6>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-sm btn-outline-primary float-right" href="javascript:void(0)"
                                            onclick='downloadChart("chart_top_selling_product", "Top Selling Product")'>Download
                                            <i class="fas fa-image ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <!-- Chart -->
                                <div>
                                    <canvas id="chart_top_selling_product"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
            


            
            <div class="tab-pane fade <?php if(request()->query('tab') == 'tables'): ?> show active <?php endif; ?>" id="tabs-icons-text-1"
                role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <br>

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL DAILY SALES (₱)

                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?php echo e(route('admin.print.handle')); ?>?records=daily_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = array_combine($chart_total_daily_sales[0], $chart_total_daily_sales[1]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $daily => $total_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($daily); ?></td>
                                                            <td><?php echo e($total_sale); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL WEEKLY SALES (₱)
                                            <?php if(request('start_date') && request('end_date')): ?>
                                                (From - <?php echo e(formatDate(request('start_date'))); ?>

                                                To - <?php echo e(formatDate(request('end_date'))); ?>)
                                            <?php else: ?>
                                                <?php echo e(now()); ?>)
                                            <?php endif; ?>
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?php echo e(route('admin.print.handle')); ?>?records=weekly_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Weekly</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = array_combine($chart_total_weekly_sales[0], $chart_total_weekly_sales[1]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekly => $total_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($weekly); ?></td>
                                                            <td><?php echo e($total_sale); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                

                <form class action="<?php echo e(route('admin.sales_report.index')); ?>" method="get">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <select class="form-control form-control-sm" name="category">
                                <option value="">-- All Category --</option>
                                <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                        <?php if(filled(request('category')) && request('category') == $category->id): ?> selected <?php endif; ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <select class="form-control form-control-sm" name="month">
                            <option value="">-- Select Month --</option>
                            <?php $__currentLoopData = getOrderMonths(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($month['month_no']); ?>"
                                    <?php if(filled(request('month')) && request('month')): ?> selected <?php endif; ?>>
                                    <?php echo e($month['month']); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <div class="input-group-append">
                            <select class="form-control form-control-sm" name="year">
                                <option value="">-- Select Year --</option>
                                <?php $__currentLoopData = getOrderYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($year['year']); ?>"
                                        <?php if(filled(request('month')) && request('month')): ?> selected <?php endif; ?>>
                                        <?php echo e($year['year']); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <input type="hidden" name="tab" value="graphs">
                            <button class="btn btn-sm btn-warning">Filter</button>

                        </div>
                    </div>
                </form>
                <br>
                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL MONTHLY SALES (₱)


                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?php echo e(route('admin.print.handle')); ?>?records=monthly_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = array_combine($chart_total_monthly_sales[0], $chart_total_monthly_sales[1]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $total_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($month); ?></td>
                                                            <td><?php echo e($total_sale); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL YEARLY SALES (₱)
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?php echo e(route('admin.print.handle')); ?>?records=yearly_sales"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Year</th>
                                                        <th>Total Sales </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = array_combine($chart_total_yearly_sales[0], $chart_total_yearly_sales[1]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year => $total_sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($year); ?></td>
                                                            <td><?php echo e($total_sale); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL PRODUCTS BY CATEGORY
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?php echo e(route('admin.print.handle')); ?>?records=product_by_category"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Total Products </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = array_combine($chart_total_product_by_category[0], $chart_total_product_by_category[1]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $total_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($category); ?></td>
                                                            <td><?php echo e($total_product); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                

                
                <div class="row">
                    <div class="col-12 col-md-12 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h6 class="text-primary text-uppercase ls-1 mb-1">
                                            TOTAL SELLING PRODUCT
                                        </h6>
                                    </div>
                                    <div class="col-md-5">
                                        <a href="<?php echo e(route('admin.print.handle')); ?>?records=top_selling_product"
                                            class="btn btn-sm btn-outline-primary float-right ">Print</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Total Successful Order Attempt </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_1 = true; $__currentLoopData = array_combine($chart_top_selling_product[0], $chart_top_selling_product[1]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product => $total_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <tr>
                                                            <td><?php echo e($product); ?></td>
                                                            <td><?php echo e($total_order); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <tr>
                                                            <td>
                                                                Records Not Found
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                


            </div>
            
        </div>
    </div>
    <!-- End Page Content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            Chart.register(ChartDataLabels); // enable chart js plugins

            const bgc = [
                '#B77729',
                '#AF8F00',
                '#1E1E1E',
                '#2D56B3',
                '#95a5a6',
                '#2c3e50',
                '#FFA0B4',
                '#ecf0f1',
                '#F7630C',
                '#32325d',
            ];


            const categories = <?php echo json_encode($chart_total_product_by_category[0], 15, 512) ?>;
            const total_products = <?php echo json_encode($chart_total_product_by_category[1], 15, 512) ?>;

            const chart_total_product_by_category = document.getElementById('chart_total_product_by_category');
            const CHART_A = new Chart(chart_total_product_by_category, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Total Products',
                        data: total_products,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    // title: {
                    //     display: true,
                    //     text: 'Total Products'
                    // },
                    // barThickness: 'flex',

                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });


            const CHART_DAILY_SALES_days = <?php echo json_encode($chart_total_daily_sales[0], 15, 512) ?>;
            const CHART_DAILY_SALES_days_total_daily_sales = <?php echo json_encode($chart_total_daily_sales[1], 15, 512) ?>;

            const chart_total_daily_sales = document.getElementById('chart_total_daily_sales');
            const CHART_DAILY_SALES = new Chart(chart_total_daily_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_DAILY_SALES_days,
                    datasets: [{
                        label: 'Total Daily Sales (₱)',
                        data: CHART_DAILY_SALES_days_total_daily_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Daily Sales (₱)'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });


            const CHART_WEEKLY = <?php echo json_encode($chart_total_weekly_sales[0], 15, 512) ?>;
            const CHART_WEEKLY_total_sales = <?php echo json_encode($chart_total_weekly_sales[1], 15, 512) ?>;

            const chart_total_weekly_sales = document.getElementById('chart_total_weekly_sales');
            const CHART_WEEKLY_SALES = new Chart(chart_total_weekly_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_WEEKLY,
                    datasets: [{
                        label: `Total Weekly Sales`,
                        data: CHART_WEEKLY_total_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: `Total Weekly Sales`
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });



            const CHART_B_months = <?php echo json_encode($chart_total_monthly_sales[0], 15, 512) ?>;
            const CHART_B_total_monthly_sales = <?php echo json_encode($chart_total_monthly_sales[1], 15, 512) ?>;

            const chart_total_monthly_sales = document.getElementById('chart_total_monthly_sales');
            const CHART_B = new Chart(chart_total_monthly_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_B_months,
                    datasets: [{
                        label: 'Total Monthly Sales (₱)',
                        data: CHART_B_total_monthly_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Monthly Sales (₱)'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });

            const CHART_C_years = <?php echo json_encode($chart_total_yearly_sales[0], 15, 512) ?>;
            const CHART_C_total_yearly_sales = <?php echo json_encode($chart_total_yearly_sales[1], 15, 512) ?>;

            const chart_total_yearly_sales = document.getElementById('chart_total_yearly_sales');
            const CHART_C = new Chart(chart_total_yearly_sales, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_C_years,
                    datasets: [{
                        label: 'Total Yearly Sales (₱)',
                        data: CHART_C_total_yearly_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Yearly Sales (₱)'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });


            const CHART_D_years = <?php echo json_encode($chart_top_selling_product[0], 15, 512) ?>;
            const CHART_D_total_yearly_sales = <?php echo json_encode($chart_top_selling_product[1], 15, 512) ?>;

            const chart_top_selling_product = document.getElementById('chart_top_selling_product');
            const CHART_D = new Chart(chart_top_selling_product, {
                type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
                data: {
                    labels: CHART_D_years,
                    datasets: [{
                        label: 'Total Successful Order Attempt',
                        data: CHART_D_total_yearly_sales,
                        backgroundColor: bgc
                    }],

                },
                options: {
                    title: {
                        display: true,
                        text: 'Total Order'
                    },
                    plugins: {
                        // indexAxis: 'y',
                        datalabels: {
                            color: '#fff',
                            align: 'center',
                            backgroundColor: function(context) {
                                return context.dataset.backgroundColor;
                            },
                            borderColor: '#ECF0F1',
                            borderRadius: 25,
                            borderWidth: 2,
                            font: {
                                weight: 'bold'
                            },
                            padding: 6,
                        }
                    },
                }
            });




        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Aes\Desktop\PERSONAL PROJECTS\---------PENDING PROJECTS----------\ON GOING\Virgilio Handcraft Ecommerce\project\resources\views\admin\sales_report\index.blade.php ENDPATH**/ ?>