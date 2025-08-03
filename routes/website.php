<?php

use App\Http\Controllers\Website;
use App\Http\Controllers\Website\Customer;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Artisan;
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
        Route::get('clear-cache', function () {
            Artisan::call('optimize:clear');
            return 'Cache cleared!';
        });
        Route::get('/login', [Website\AuthController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/login', [Website\AuthController::class, 'login'])->name('auth.login.submit');
        Route::get('/register', [Website\AuthController::class, 'showRegisterForm'])->name('auth.register');
        Route::post('/register', [Website\AuthController::class, 'register'])->name('auth.register.submit');
        Route::post('/logout', [Website\AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

        Route::get('/', Website\WebsiteController::class)->name('home');
        Route::get('about-us', Website\AboutController::class)->name('about');
        Route::get('contact-us', Website\ContactUsController::class)->name('contact');
        Route::get('privacy-policy', Website\PrivacyController::class)->name('privacy');
        Route::get('shop', [Website\ShopController::class, 'index'])->name('shop.index');
        Route::get('product/{id}', [Website\ShopController::class, 'show'])->name('shop.product.show');
        Route::get('cart', [Website\CartController::class, 'index'])->name('cart');
        Route::resource('cart', Website\CartController::class)->except(['index']);
        Route::get('checkout', [Website\CheckoutController::class, 'create'])->name('checkout');
        Route::post('checkout', [Website\CheckoutController::class, 'store']);
        Route::group(['middleware' => 'auth', 'prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/', [Customer\DashboardController::class, 'index'])->name('dashboard');
            Route::get('orders/{status?}', [Customer\DashboardController::class, 'ordersByStatus'])->name('orders_by_status');
            Route::get('orders/show/{order}', [Customer\DashboardController::class, 'showPartial'])->name('customer.orders.partial');
        });
});