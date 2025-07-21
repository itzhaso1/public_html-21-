<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('admins', Dashboard\AdminController::class);
        Route::get('/link-password', [Dashboard\AdminController::class, 'showForm'])->name('link_password.form');
        Route::post('/link-password', [Dashboard\AdminController::class, 'verify'])->name('link_password.verify');
        Route::middleware(['linkPasswordProtected'])->controller(Dashboard\MainSettingsController::class)->prefix('mainSettings')->as('mainSettings.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('histories', 'history')->name('histories');
        });
        Route::resource('categories', Dashboard\CategoryController::class);
        Route::resource('products', Dashboard\ProductController::class);
        Route::resource('sliders', Dashboard\SliderController::class);
        Route::resource('sections', Dashboard\SectionController::class);
        Route::resource('brands', Dashboard\BrandController::class);
        Route::resource('types', Dashboard\TypeController::class);
        Route::resource('tags', Dashboard\TagController::class);
        Route::resource('coupons', Dashboard\CouponController::class);
//        Route::resource('orders', Dashboard\OrderController::class);
        Route::resource('users', Dashboard\UserController::class)->names('user');
        Route::group(['prefix' => 'general', 'as' => 'general.'], function () {
            Route::resource('orders', Dashboard\General\OrderController::class);
        });
        Route::get('dashboard', Dashboard\DashboardController::class)->name('dashboard');
    });
});