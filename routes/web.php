<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LoginAdminController;
use App\Http\Controllers\Backend\OrderBackendController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FeedbackController;
use App\Http\Controllers\Backend\InformationController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LoginUserController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

// ======== *** ADMIN ROUTE *** ============== \\
Route::prefix('admin')->group(function () {

    // *** Login - Register Route *** \\
    Route::get('login', [
        LoginAdminController::class,
        'showLoginForm'
    ])->name('admin.show_login_form');

    // Login
    Route::post('login', [LoginAdminController::class, 'login'])->name('admin.handle_login');

    // Forgot Password
    Route::get('forgot-password', [LoginAdminController::class, 'showFormEnterMail'])->name('admin.forgot_password');

    // Send to email
    Route::post('forgot-password', [LoginAdminController::class, 'sendMailReset'])->name('admin.send_mail_reset');

    // Confirm reset
    Route::get('confirm-reset/{token}', [LoginAdminController::class, 'confirmToken'])->name('admin.confirm_reset');

    // Show form enter new pass
    Route::get('reset-password', [LoginAdminController::class, 'showFormReset'])->name('admin.reset_password');

    // Update password
    Route::post('reset-password', [LoginAdminController::class, 'handleReset'])->name('admin.handle_reset-password');

    // Admin Middleware (Auth::guard('admin')
    Route::middleware(['admin'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('events', [DashboardController::class, 'events'])->name('admin.events');

        // Route Logout
        Route::get('logout', [LoginAdminController::class, 'logout'])->name('admin.logout');

        // Categories
        Route::resource('categories', CategoryController::class);
        // Categories Trash
        Route::get('trash/categories', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::post('trash/categories', [CategoryController::class, 'trashAction'])->name('categories.action');

        // Rooms
        Route::resource('rooms', RoomController::class);

        // Rooms Trash
        Route::get('trash/rooms', [RoomController::class, 'trash'])->name('rooms.trash');
        Route::post('trash/rooms', [RoomController::class, 'trashAction'])->name('rooms.action');

        // Orders
        Route::prefix('orders')->group(function () {

            Route::get('/show', [OrderBackendController::class, 'show'])->name('backend.order.show');

            Route::get('/detail/{id}', [OrderBackendController::class, 'detail'])->name('backend.order.detail');

            Route::put('/update/{id}', [OrderBackendController::class, 'update'])->name('backend.order.update_status');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('show', [UserController::class, 'show'])->name('backend.user.show');

            Route::put('update-status/{id}', [UserController::class, 'updateStatus'])->name('backend.user.update_status');
        });

        // Blog Category
        Route::resource('blog-categories', BlogCategoryController::class);
        // Blog Categories Trash
        Route::get('trash/blog-categories', [BlogCategoryController::class, 'trash'])->name('blog_categories.trash');
        Route::post('trash/blog-categories', [BlogCategoryController::class, 'trashAction'])->name('blog_categories.action');

        // Blog
        Route::resource('blogs', BlogController::class);
        // Blog Trash
        Route::get('trash/blogs', [BlogController::class, 'trash'])->name('blogs.trash');
        Route::post('trash/blogs', [BlogController::class, 'trashAction'])->name('blogs.action');

        // Coupon
        Route::resource('coupons', CouponController::class);
        // Coupon Trash
        Route::get('trash/coupons', [CouponController::class, 'trash'])->name('coupons.trash');
        Route::post('trash/coupons', [CouponController::class, 'trashAction'])->name('coupons.action');

        // Route Banners
        Route::resource('banners', BannerController::class);
        // Coupon Trash
        Route::get('trash/banners', [BannerController::class, 'trash'])->name('banners.trash');
        Route::post('trash/banners', [BannerController::class, 'trashAction'])->name('banners.action');

        // Route Services
        Route::resource('services', ServiceController::class);
        // Services Trash
        Route::get('trash/services', [ServiceController::class, 'trash'])->name('services.trash');
        Route::post('trash/services', [ServiceController::class, 'trashAction'])->name('services.action');

        // Route Brands
        Route::resource('brands', BrandController::class);
        // Brands Trash
        Route::get('trash/brands', [BrandController::class, 'trash'])->name('brands.trash');
        Route::post('trash/brands', [BrandController::class, 'trashAction'])->name('brands.action');

        // Route Brands
        Route::resource('faqs', FaqController::class);

        // Route Information
        Route::get('informations', [InformationController::class, 'show'])->name('info.show');
        Route::post('informations', [InformationController::class, 'add'])->name('info.add');
        Route::put('informations', [InformationController::class, 'update'])->name('info.update');

        // Feedbacks
        Route::get('feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.show');
        Route::put('update-status-feedbacks/{id}', [FeedbackController::class, 'updateStatus'])->name('feedbacks.update_status');

        // Payments
        Route::resource('payments', PaymentController::class);
    });
});

// ======== *** USER ROUTE *** ============== \\
// Show register form
Route::get('register', [
    LoginUserController::class,
    'showRegisterForm'
])->name('user.show_register_form');

// Register
Route::post('register', [LoginUserController::class, 'register'])->name('user.handle_register');

// Show login form
Route::get('login', [
    LoginUserController::class,
    'showLoginForm'
])->name('user.show_login_form');

// Login
Route::post('login', [LoginUserController::class, 'login'])->name('user.handle_login');

// Forgot Password
Route::get('forgot-password', [LoginUserController::class, 'showFormEnterMail'])->name('user.forgot_password');

// Send to email
Route::post('forgot-password', [LoginUserController::class, 'sendMailReset'])->name('user.send_mail_reset');

// Confirm reset
Route::get('confirm-reset/{token}', [LoginUserController::class, 'confirmToken'])->name('user.confirm_reset');

// Show form enter new pass
Route::get('reset-password', [LoginUserController::class, 'showFormReset'])->name('user.reset_password');

// Update password
Route::post('reset-password', [LoginUserController::class, 'handleReset'])->name('user.handle_reset_password');

// Change password
Route::post('change-password', [LoginUserController::class, 'changePassword'])->name('user.change_password')->middleware('auth');

// Route Logout
Route::get('logout', [LoginUserController::class, 'logout'])->name('user.logout')->middleware('auth');

// Route home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::redirect('/home', '/');

Route::get('profile', [HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::put('profile', [HomeController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');

Route::get('categories', [HomeController::class, 'category'])->name('user.category');

Route::get('categories-search-ajax', [HomeController::class, 'categoryAjax'])->name('user.category_search_ajax');

Route::get('rooms/{slug}', [HomeController::class, 'room'])->name('user.room');

// Room Rating
Route::post('/rooms/rating', [HomeController::class, 'rating'])->name('room_rating')->middleware('auth');
Route::get('sort-ratings', [HomeController::class, 'sortRating'])->name('sort_ratings');

// Contact page
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

// Send message
Route::post('send-message', [HomeController::class, 'sendMessage'])->name('send_message');

// Service page
Route::get('services', [HomeController::class, 'services'])->name('services');

// About
Route::get('about', [HomeController::class, 'about'])->name('about');


// *** Route Cart *** \\
Route::prefix('cart')->group(function () {
    // Show all item
    Route::get('show', [CartController::class, 'show'])->name('cart.show');

    // Add to cart
    Route::post('add', [CartController::class, 'add'])->name('cart.add');

    // Update cart
    Route::put('update/{rowId}', [CartController::class, 'update'])->name('cart.update');

    // Remove cart
    Route::get('remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');

    // Destroy cart
    Route::get('destroy', [CartController::class, 'destroy'])->name('cart.destroy');
});

// Get coupon
Route::get('coupon', [HomeController::class, 'checkCoupon'])->name('check_coupon');
Route::get('select-services', [HomeController::class, 'selectService'])->name('select_services');

Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.show');

    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout.handle');

    Route::get('checkout-complete', [OrderController::class, 'complete'])->name('checkout.complete');

    Route::post('checkout-change-date', [OrderController::class, 'changeDate'])->name('checkout.change_date');

    Route::get('order-history', [OrderController::class, 'orderHistory'])->name('order_history');

    Route::get('order-details/{id}', [OrderController::class, 'orderDetails'])->name('order_details');
});

// Blog and Blog-details
Route::get('blogs', [HomeController::class, 'blog'])->name('user.blogs');
Route::get('blog-details/{slug}', [HomeController::class, 'blogDetail'])->name('user.blog_details');

// Comment blog
Route::post('/blogs/comment', [HomeController::class, 'comment'])->name('comment')->middleware('auth');
Route::get('sort-comments', [HomeController::class, 'sortComment'])->name('sort_comments')->middleware('auth');


// Route 404
Route::fallback(function () {
    return view('frontend.pages.404');
});
