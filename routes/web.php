<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('main');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show');

});
Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('index');
    Route::get('/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('show');

});

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
});
Route::group(['prefix' => 'discounts', 'as' => 'discounts.'], function () {
    Route::post('/check', [\App\Http\Controllers\DiscountController::class, 'check'])->name('check');
});
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
        Route::get('/{category}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update');
        Route::get('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store');
        Route::delete('/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('destroy');

    });
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('create');
        Route::get('/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit');
        Route::post('/', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('store');
        Route::put('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('destroy');

    });
});
Route::get('/forbidden', function () {
    return view('forbidden');
})->name('forbidden');
