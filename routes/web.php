<?php

use App\Http\Controllers\MailingController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRelationContoller;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'home'])->name('home');
Route::post('/search', [MainController::class, 'search'])->name('search');

//maling
Route::post('/mailing/store', [MailingController::class, 'store'])->name('mailing.store');
Route::post('/mailing/destroy', [MailingController::class, 'destroy'])->name('mailing.destroy');

//products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{url}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/ajax-get', [ProductController::class, 'ajaxGet'])->name('products.ajaxGet');

//researches
Route::get('/researches', [ResearchController::class, 'index'])->name('researches.index');
Route::get('/researches/{url}', [ResearchController::class, 'show'])->name('researches.show');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [ProductController::class, 'dashBoardIndex'])->name('dashboard.index');
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/dashboard/products/{id}', [ProductController::class, 'edit'])->name('products.edit');

    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
    //Product Relations
    Route::get('/dashboard/product-relations', [ProductRelationContoller::class, 'index'])->name('products.relations.index');
    Route::get('/dashboard/product-relations/create', [ProductRelationContoller::class, 'create'])->name('products.relations.create');
    Route::get('/dashboard/product-relations/{id}', [ProductRelationContoller::class, 'edit'])->name('products.relations.edit');

    Route::post('/product-relations/store', [ProductRelationContoller::class, 'store'])->name('products.relations.store');
    Route::post('/product-relations/update', [ProductRelationContoller::class, 'update'])->name('products.relations.update');
    Route::post('/product-relations/destroy', [ProductRelationContoller::class, 'destroy'])->name('products.relations.destroy');

    //researches
    Route::get('/dashboard/researches', [ResearchController::class, 'dashBoardIndex'])->name('dashboard.researches.index');
    Route::get('/dashboard/researches/create', [ResearchController::class, 'create'])->name('researches.create');
    Route::get('/dashboard/researches/{id}', [ResearchController::class, 'edit'])->name('researches.edit');

    Route::post('/researches/store', [ResearchController::class, 'store'])->name('researches.store');
    Route::post('/researches/update', [ResearchController::class, 'update'])->name('researches.update');
    Route::post('/researches/destroy', [ResearchController::class, 'destroy'])->name('researches.destroy');

    //researches
    Route::get('/dashboard/slides', [SlideController::class, 'dashBoardIndex'])->name('dashboard.slides.index');
    Route::get('/dashboard/slides/create', [SlideController::class, 'create'])->name('slides.create');
    Route::get('/dashboard/slides/{id}', [SlideController::class, 'edit'])->name('slides.edit');

    Route::post('/slides/store', [SlideController::class, 'store'])->name('slides.store');
    Route::post('/slides/update', [SlideController::class, 'update'])->name('slides.update');
    Route::post('/slides/destroy', [SlideController::class, 'destroy'])->name('slides.destroy');

    //mailing
    Route::get('/dashboard/mailing', [MailingController::class, 'dashBoardIndex'])->name('dashboard.mailing.index');
    Route::post('/mailing/dashboard/destroy', [MailingController::class, 'DashDestroy'])->name('dashboard.mailing.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/redirects.php';
