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
Route::get('/home', function () {
    return redirect()->route('main');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
    Route::get('/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('index');
    Route::get('/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('show');
});

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::group(['middleware' => 'checkout'], function () {
        Route::get('/{order}', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/{order}/pay', [OrderController::class, 'pay'])->name('checkout.pay');
        Route::get('/{order}/fail', [OrderController::class, 'fail'])->name('checkout.fail');
        Route::get('/{order}/success', [OrderController::class, 'success'])->name('checkout.success');
    });
});

Route::group(['prefix' => 'discounts', 'as' => 'discounts.'], function () {
    Route::post('/check', [\App\Http\Controllers\DiscountController::class, 'check'])->name('check');
});
Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
    Route::get('/', [\App\Http\Controllers\ContactController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\ContactController::class, 'submit'])->name('submit');
});
Route::group(['prefix' => 'profile', 'middleware' => 'auth', 'as' => 'profile.'], function () {
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', [\App\Http\Controllers\Profile\OrderController::class, 'index'])->name('index');
        Route::middleware('profile.orders.show')->get('/{order}', [\App\Http\Controllers\Profile\OrderController::class, 'show'])->name('show');

    });
});


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->withTrashed(['edit'])->except(['show']);
    Route::get('categories/deleted', [\App\Http\Controllers\Admin\CategoryController::class, 'deleted'])->name('categories.deleted.index');
    Route::get('categories/{category}/restore', [\App\Http\Controllers\Admin\CategoryController::class, 'restore'])->name('categories.restore')->withTrashed(['restore']);
    Route::delete('categories/{category}/forceDelete', [\App\Http\Controllers\Admin\CategoryController::class, 'forceDestroy'])->name('categories.forceDestroy')->withTrashed(['forceDestroy']);

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
    Route::post('products/search', [\App\Http\Controllers\Admin\ProductController::class, 'search'])->name('products.search');
    Route::get('products/deleted', [\App\Http\Controllers\Admin\ProductController::class, 'deleted'])->name('products.deleted.index');
    Route::get('products/{product}/restore', [\App\Http\Controllers\Admin\ProductController::class, 'restore'])->name('products.restore')->withTrashed(['restore']);
    Route::delete('products/{product}/forceDelete', [\App\Http\Controllers\Admin\ProductController::class, 'forceDestroy'])->name('products.forceDestroy')->withTrashed(['forceDestroy']);


    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('users.orders', \App\Http\Controllers\Admin\OrderController::class)->shallow();


    //ПРИ УДАЛЕНИИ КАТЕГОРИИ (ФОРС) НАДО ОТВЯЗЫВАТЬ КАТЕГОРИЮ В ПОСТАХ + ДОБАВИТЬ СООТВЕТСТВУЮЩИЙ ТЕСТ КЕЙС


});

Route::get('/forbidden', function () {
    return view('forbidden');
})->name('forbidden');
