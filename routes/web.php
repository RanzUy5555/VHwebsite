<?php

// Facades
use Illuminate\Support\Facades\{Auth,Route};

// Shared Restful Controllers
use App\Http\Controllers\All\{
    ProfileController,
    TmpImageUploadController
};

// Admin Restful Controllers
use App\Http\Controllers\Admin\{
    DashboardController,
    ActivityLogController,
    BrandController,
    CategoryController,
    ContactController as AdminContactController,
    MunicipalityController,
    OrderController as AdminOrderController,
    PaymentMethodController,
    PrintController,
    ProductController,
    RequestController as AdminRequestController,
    SalesReportController,
    ServiceController,
    SupplierController,
    UserController
};

// Auth Restful Controller
use App\Http\Controllers\Auth\{
    AuthController
};

// Main Restful Controller
use App\Http\Controllers\Main\{
    ContactController,
    PageController,
    ProductController as MainProductController
};
// User Restful Controllers
use App\Http\Controllers\User\{
    CartController,
    DashboardController as UserDashboardController,
    OrderController,
    OtpController,
    RequestController
};


// Guest
Route::group(['as' => 'main.'],function() {

    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/services', 'services')->name('services');
    });

    Route::resource('products', MainProductController::class);

    Route::post('contacts', ContactController::class)->name('contacts.store');


    // Route::post('/', function() {
    //     return back()->with(['success' => "Thank you for reaching out to us! Your message has been received and is important to us. We'll get back to you as soon as possible. Have a great day!"]);
    // })->name('submit_contact');
});


// Admin 
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');
    Route::resource('users', UserController::class);
    Route::resource('municipalities', MunicipalityController::class);
    Route::get('contacts', AdminContactController::class)->name('contacts.index');

    
    /** Start Product Management */
        Route::resource('suppliers', SupplierController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('products', ProductController::class);
    /** End Product Management */

    /** Start Order Management */
    
            Route::resource('orders', AdminOrderController::class);
            Route::resource('payment_methods', PaymentMethodController::class);

    /** Start Order Management */


    //Route::get('role', RoleController::class)->name('role.index');
    Route::get('activity_logs', ActivityLogController::class)->name('activity_logs.index');

    Route::get('print', PrintController::class)->name('print.handle');

    Route::get('sales_reports', SalesReportController::class)->name('sales_report.index');

    Route::resource('services', ServiceController::class);

    Route::resource('requests', AdminRequestController::class);


});


// User
Route::group(['middleware' => ['auth'], 'prefix' => 'user', 'as' => 'user.'],function() {
    Route::get('dashboard', UserDashboardController::class)->name('dashboard.index');

    Route::resource('carts', CartController::class)->only('index', 'store', 'destroy');
    Route::post('/send_otp', OtpController::class)->name('otp.store'); //Send OTP
    Route::resource('orders', OrderController::class);

    Route::resource('requests', RequestController::class);
    
});


// Auth
Route::group(['middleware' => ['auth']],function() {
    Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);     // TMP FILE UPLOAD
    Route::resource('tmp_upload', TmpImageUploadController::class);
    Route::resource('profile', ProfileController::class)->parameter('profile', 'user');;
});


// Custom Authentication
Route::group(['as' => 'auth.'], function () {

    // Auth Routes
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'attemptLogin')->name('attempt_login');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'attemptRegister')->name('attempt_register');
        Route::post('/logout', 'logout')->name('logout');

        // email verification

        Route::get('/email/verify/{token}', 'emailVerification')->name('email_verification');
    });
});


Auth::routes(['login' => false, 'register' => false, 'logout' => false]);