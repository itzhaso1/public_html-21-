<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Website;
use App\Http\Controllers\Website\Customer;
use App\Http\Controllers\PublicProductController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath'
        ]
    ],
    function () {

        // ===============================
        // Clear cache
        // ===============================
        Route::get('clear-cache', function () {
            Artisan::call('optimize:clear');
            return 'Cache cleared!';
        });

        // ===============================
        // Auth
        // ===============================
        Route::get('login', [Website\AuthController::class, 'showLoginForm'])->name('auth.login');
        Route::post('login', [Website\AuthController::class, 'login'])->name('auth.login.submit');
        Route::get('register', [Website\AuthController::class, 'showRegisterForm'])->name('auth.register');
        Route::post('register', [Website\AuthController::class, 'register'])->name('auth.register.submit');
        Route::post('logout', [Website\AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

        // ===============================
        // Diamonds Sections
        // ===============================
        Route::get('diamonds/charge', function () {
            $products = DB::table('products')
                ->leftJoin('product_translations', 'products.id', '=', 'product_translations.product_id')
                ->where('products.service_type', '=', 'gems')
                ->where('product_translations.locale', '=', app()->getLocale())
                ->select('products.*', 'product_translations.name', 'product_translations.description')
                ->get();

            return view('website.diamonds.charge', compact('products'));
        })->name('website.diamonds.charge');

        Route::get('diamonds/codes', function () {
            $products = DB::table('products')
                ->leftJoin('product_translations', 'products.id', '=', 'product_translations.product_id')
                ->where('products.service_type', '=', 'codes')
                ->where('product_translations.locale', '=', app()->getLocale())
                ->select('products.*', 'product_translations.name', 'product_translations.description')
                ->get();

            return view('website.diamonds.codes', compact('products'));
        })->name('website.diamonds.codes');

        // ===============================
        // Website pages
        // ===============================
        Route::get('/', Website\WebsiteController::class)->name('home');
        Route::get('about-us', Website\AboutController::class)->name('about');
        Route::get('contact-us', Website\ContactUsController::class)->name('contact');
        Route::get('privacy-policy', Website\PrivacyController::class)->name('privacy');

        // ===============================
        // Shop
        // ===============================
        Route::get('shop', [Website\ShopController::class, 'index'])->name('shop.index');
        Route::get('product/{product}', [Website\WebsiteController::class, 'show'])->name('website.product.show');
        Route::post('product/{productId}/unlock-client', [Website\ShopController::class, 'unlockClientNumber'])->name('product.unlock.client');

        // ===============================
        // Publish product
        // ===============================
        Route::get('publish-product', [PublicProductController::class, 'create'])->name('public.products.create');
        Route::post('publish-product', [PublicProductController::class, 'store'])->name('public.products.store');

        // ===============================
        // Customer dashboard
        // ===============================
        Route::group(['middleware' => 'auth', 'prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/', [Customer\DashboardController::class, 'index'])->name('dashboard');
            Route::get('orders/{status?}', [Customer\DashboardController::class, 'ordersByStatus'])->name('orders_by_status');
            Route::get('orders/show/{order}', [Customer\DashboardController::class, 'showPartial'])->name('orders.partial');
            Route::get('track', [Customer\DashboardController::class, 'trackOrder'])->name('track.order');
        });
    }
);
