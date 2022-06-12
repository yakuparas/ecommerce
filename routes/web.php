<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\VariantsController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaypalPaymentController;
use App\Http\Controllers\HomeController;
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

Route::get('payment', [PaypalPaymentController::class,'index'])->name("paypal.index");
Route::post('charge', [PaypalPaymentController::class,'charge'])->name("paypal.charge");
Route::get('success', [PaypalPaymentController::class,'success'])->name("paypal.success");
Route::get('error', [PaypalPaymentController::class,'error'])->name("paypal.error");


Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/product/{id}/{slug}',[HomeController::class,'product'])->name('product');
Route::get('/category/{id}/{slug}',[HomeController::class,'categoryproducts'])->name('categoryproducts');
Route::get('/addtocart/{id}',[HomeController::class,'index'])->name('addtocart');
Route::get('/aa/{id}/{name}',[HomeController::class,'productdetail'])->name('product-detail');
Route::get('/login',[HomeController::class,'login'])->name('login');
Route::post('/checkLogin',[HomeController::class,'checkLogin'])->name('checkLogin');
Route::group(['prefix' => 'user',  'middleware' => 'auth'], function()
{
    Route::get('/logout',[HomeController::class,'logout'])->name('logout');
    Route::get('/profile',[HomeController::class,'profile'])->name('profile');
    Route::post('/profile-update',[HomeController::class,'profileupdate'])->name('profile-update');
    Route::post('/createadres',[HomeController::class,'createadres'])->name('createadres');
    Route::post('/editadress',[HomeController::class,'editadress'])->name('editadress');
    Route::get('/destroyadress/{id}',[HomeController::class,'destroyadress'])->name('destroyadress');
    Route::post('/orderdetail',[HomeController::class,'orderdetail'])->name('orderdetail');

});

Route::prefix('cart')->group(function (){

    Route::get('/',[CartController::class,'index'])->name('cart');
    Route::get('create',[CartController::class,'create'])->name('cart.add');
    Route::post('store',[CartController::class,'store'])->name('cart.store');
    Route::post('delete/{id}',[CartController::class,'destroy'])->name('cart.delete');
    Route::post('update/{id}',[CartController::class,'update'])->name('cart.update');
    Route::get('edit/{id}',[CartController::class,'edit'])->name('cart.edit');
    Route::get('show/{id}',[CartController::class,'show'])->name('cart.show');
    Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');

});

Route::prefix('admin')->group(function () {
    Route::get('/',[AuthController::class,'index'])->name('admin.login');
    Route::post('/login',[AuthController::class,'login'])->name('admin.checklogin');
});

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/logout',[AuthController::class,'logout'])->name('admin.logout');

    Route::get('/category',[CategoryController::class,'index'])->name('admin.category.list');
    Route::get('/category/create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::post('/category/delete/{id}',[CategoryController::class,'destroy'])->name('admin.category.delete');
    Route::post('/category/update/{id}',[CategoryController::class,'update'])->name('admin.category.update');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');


    Route::get('/variants',[VariantsController::class,'index'])->name('admin.variants.list');
    Route::get('/variants/create',[VariantsController::class,'create'])->name('admin.variants.create');
    Route::post('/variants/store',[VariantsController::class,'store'])->name('admin.variants.store');
    Route::post('/variants/delete/{id}',[VariantsController::class,'destroy'])->name('admin.variants.delete');
    Route::post('/variants/update/{id}',[VariantsController::class,'update'])->name('admin.variants.update');
    Route::get('/variants/edit/{id}',[VariantsController::class,'edit'])->name('admin.variants.edit');

    Route::get('/brands',[BrandController::class,'index'])->name('admin.brands.list');
    Route::get('/brands/create',[BrandController::class,'create'])->name('admin.brands.create');
    Route::post('/brands/store',[BrandController::class,'store'])->name('admin.brands.store');
    Route::post('/brands/delete/{id}',[BrandController::class,'destroy'])->name('admin.brands.delete');
    Route::post('/brands/update/{id}',[BrandController::class,'update'])->name('admin.brands.update');
    Route::get('/brands/edit/{id}',[BrandController::class,'edit'])->name('admin.brands.edit');

    Route::get('/product',[ProductController::class,'index'])->name('admin.product.list');
    Route::get('/product/create',[ProductController::class,'create'])->name('admin.product.create');
    Route::post('/product/store',[ProductController::class,'store'])->name('admin.product.store');
    Route::get('/product/delete/{id}',[ProductController::class,'destroy'])->name('admin.product.destroy');
    Route::get('/product/gallery/{id}',[ProductController::class,'gallery'])->name('admin.product.gallery');
    Route::get('/product/variants/{id}',[ProductController::class,'variants'])->name('admin.product.variants');
    Route::get('/variants/fetch/{id}',[ProductController::class,'variantsfetch'])->name('variants.fetch');
    Route::post('/variants/priceupdate/{id}',[ProductController::class,'variantspriceupdate'])->name('variants.priceupdate');
    Route::post('/variants/prefixupdate/{id}',[ProductController::class,'prefixupdate'])->name('variants.prefixupdate');
    Route::post('/product/add/variants',[ProductController::class,'addvariants'])->name('admin.product.addvariants');
    Route::post('/product_variant/delete/{id}',[ProductController::class,'vdelete'])->name('admin.product_variant.delete');
    Route::post('/product/delete/{id}',[ProductController::class,'destroy'])->name('admin.product.delete');
    Route::post('/product/update/{id}',[ProductController::class,'update'])->name('admin.product.update');
    Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
    Route::post('/dropzone/upload',[ProductController::class,'upload'])->name('dropzone.upload');
    Route::get('/dropzone/fetch/{id}', [ProductController::class,'fetch'])->name('dropzone.fetch');
    Route::get('/dropzone/delete', [ProductController::class,'delete'])->name('dropzone.delete');

    #Ayarlar
    Route::get('/settings',[SettingsController::class,'index'])->name('admin.settings.list');
    Route::post('/settings/update/{id}',[SettingsController::class,'update'])->name('admin.settings.update');

    Route::get('/slider',[SliderController::class,'index'])->name('admin.slider.list');
    Route::get('/slider/create',[SliderController::class,'create'])->name('admin.slider.create');
    Route::post('/slider/store',[SliderController::class,'store'])->name('admin.slider.store');
    Route::post('/slider/delete/{id}',[SliderController::class,'destroy'])->name('admin.slider.delete');
    Route::post('/slider/update/{id}',[SliderController::class,'update'])->name('admin.slider.update');
    Route::get('/slider/edit/{id}',[SliderController::class,'edit'])->name('admin.slider.edit');



});

