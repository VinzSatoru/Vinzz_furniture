<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\CategoryController as PublicCategoryController;
use App\Http\Controllers\OrderController as PublicOrderController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/products', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [PublicProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category}', [PublicCategoryController::class, 'show'])->name('categories.show');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // Order Routes
    Route::get('/orders', [PublicOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [PublicOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [PublicOrderController::class, 'store'])->name('orders.store');
});

// Admin routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('/orders/{order}', [OrderManagementController::class, 'destroy'])->name('orders.destroy');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('products', 'Admin\ProductManagementController');
    Route::resource('orders', 'Admin\OrderController');
    Route::resource('customers', 'Admin\CustomerController')->only(['index', 'show']);
    Route::patch('/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('/orders/{order}', [OrderManagementController::class, 'destroy'])->name('orders.destroy');
});
