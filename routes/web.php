<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\HomepageSectionController;   


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// == PUBLIC/FRONTEND ROUTES ==

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/error', function() {
    return back()->with('error', 'This is a test error message');
});

// Item/Product/Service Listing and Detail Pages
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{slug}', [ItemController::class, 'show'])->name('items.show');
Route::get('/categories/{slug}', [ItemController::class, 'indexByCategory'])->name('items.category');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Flow
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order-success', [CheckoutController::class, 'success'])->name('checkout.success');


// Auth Routes (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// == ADMIN ROUTES ==
// All routes in this group are prefixed with /admin and require the user to be an admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Site Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Page Content Management
    Route::get('/pages', [AdminController::class, 'managePages'])->name('pages.index');
    Route::get('/pages/edit/{id}', [AdminController::class, 'editPageSection'])->name('pages.edit');
    Route::post('/pages/update/{id}', [AdminController::class, 'updatePageSection'])->name('pages.update');

    // Item (Product/Service) Management
    Route::get('/items', [AdminItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [AdminItemController::class, 'create'])->name('items.create');
    Route::post('/items', [AdminItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}/edit', [AdminItemController::class, 'edit'])->name('items.edit');
    Route::post('/items/{id}', [AdminItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [AdminItemController::class, 'destroy'])->name('items.destroy');

     Route::resource('testimonials', TestimonialController::class)->except(['show']);
    

    // Other Admin routes can be added here (e.g., for orders, users, categories)
});

// A fallback route to test DB connection if needed
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is successful!";
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. Error: " . $e->getMessage());
    }
});

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');

// Review Submission
Route::post('/items/{itemId}/reviews', [ItemController::class, 'storeReview'])->name('items.reviews.store')->middleware('auth');

// Newsletter Subscription
Route::post('/newsletter-subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');


Route::middleware(['auth'])->prefix('my-account')->name('account.')->group(function () {
    Route::get('/orders', [AccountController::class, 'orderHistory'])->name('orders');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('static-pages', StaticPageController::class)->except(['show']);
});


// Frontend Static Page Display
Route::get('/p/{slug}', [PageController::class, 'show'])->name('page.show');

Route::post('/items/{itemId}/reviews', [ItemController::class, 'storeReview'])->name('items.reviews.store')->middleware('auth');

// Customer Account Routes (add this entire group)
Route::middleware(['auth'])->prefix('my-account')->name('account.')->group(function () {
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::post('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
});



Route::get('/blog', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blogs', AdminBlogController::class)->except(['show']);
    Route::resource('faqs', AdminFaqController::class)->except(['show']);
    Route::delete('/items/image/{imageId}', [AdminItemController::class, 'destroyImage'])->name('items.image.destroy');
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);


     // These routes handle the admin functionality for managing homepage sections.
     Route::get('/pages', [HomepageSectionController::class, 'index'])->name('pages.index');
     Route::get('/pages/create', [HomepageSectionController::class, 'create'])->name('pages.create');
     Route::post('/pages', [HomepageSectionController::class, 'store'])->name('pages.store');
     Route::get('/pages/{id}/edit', [HomepageSectionController::class, 'edit'])->name('pages.edit');
     Route::post('/pages/update/{id}', [HomepageSectionController::class, 'update'])->name('pages.update'); // Note: Should ideally be PUT/PATCH
     Route::delete('/pages/{id}', [HomepageSectionController::class, 'destroy'])->name('pages.destroy');
 
 
});


Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.verification');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');



Route::post('/verify-and-create-user', [AuthController::class, 'verifyAndCreateUser'])->name('register.verify');


// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');