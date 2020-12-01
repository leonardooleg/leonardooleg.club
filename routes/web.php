<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Cart2Controller;
/*use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryImportController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MenuController;*/
/*use App\Http\Controllers\Admin\UserManagment\UserController;
use App\Http\Controllers\Admin\UserManagment\RoleController;*/

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



Route::get('/', [SiteController::class, 'welcome'])->name('welcome');


Route::get('catalog/{category}/{product}.html', [SiteController::class, 'product'])->name('product')->where('category', '[a-zA-Z0-9\-/_]+');
Route::get('catalog/{path}', [SiteController::class, 'catalog'])->name('category')->where('path', '[a-zA-Z0-9\-/_]+');
Route::get('products', [SiteController::class, 'products'])->name('products');
Route::get('catalog', [SiteController::class, 'catalog'])->name('catalog');
Route::get('blog', [SiteController::class, 'blogs'])->name('blogs');
Route::get('blog/{url}.html', [SiteController::class, 'blog'])->name('blog');
Route::get('brands', [SiteController::class, 'brands'])->name('brands');
Route::get('brands/{url}.html', [SiteController::class, 'brand'])->name('brand');
Route::get('sizes', [SiteController::class, 'sizes'])->name('sizes');
Route::get('sizes/{url}.html', [SiteController::class, 'size'])->name('size');


Auth::routes();

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin.')->group(static function() {

    Route::middleware('auth')->group(static function () {
      //  Route::middleware(['permission:Admin'])->group(static function () {
            Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('index');
            Route::resource('/orders', OrdersController::class)->names('orders');
            Route::resource('/shop', ShopController::class)->names('shop');
            Route::resource('/category', CategoryController::class)->names('category');
            Route::resource('/category-import', CategoryImportController::class)->names('category-import');
            Route::get('/category/{id?}/children ', [App\Http\Controllers\Admin\CategoryController::class, 'children']);
            Route::resource('/colors', ColorController::class);
            Route::resource('/providers', ProviderController::class);
            Route::resource('/countries', CountryController::class);
            Route::resource('/brands', BrandController::class);
            Route::resource('/sizes', SizeController::class);
            Route::get('/products/import', [App\Http\Controllers\Admin\ProductController::class, 'import'])->name('products.import');
            Route::post('/products/import_store', [App\Http\Controllers\Admin\ProductController::class ,'import_store'])->name('products.import_store');
            Route::resource('/products', ProductController::class)->names('products');
            Route::resource('/blogs', BlogController::class)->names('blogs');
            Route::resource('/pages', PageController::class)->names('pages');
            Route::get('/menu',[App\Http\Controllers\Admin\MenuController::class,'index'])->name('menu.get');

        Route::prefix('api')->namespace('API')->name('api.')->group(static function() {
            Route::get('/sizes/{brand?}/{category?}/{filter?}',[App\Http\Controllers\Admin\API\APIController::class, 'sizes'])->name('sizes.get');
            Route::get('/colors/{brand?}',[App\Http\Controllers\Admin\API\APIController::class, 'colors'])->name('colors.get');
        });

        Route::prefix('user_managment')->namespace('UserManagment')->name('user_managment.')->group(static function() {
            Route::resource('/user', UserController::class)->names('user');
            Route::resource('/roles', RoleController::class)->names('roles');
        });

       // });
    });
});

Route::prefix('profile')->group(static function() {
    //Route::middleware(['permission:buyer'])->group(static function () {
        Route::get('/', [ProfileController::class ,'index'])->name('panels');
        Route::get('/edit', [ProfileController::class ,'profileEdit'])->name('profile');
        Route::post('/update', [ProfileController::class ,'profileUpdate'])->name('profile.update');
        Route::post('/avatar', [ProfileController::class ,'avatar'])->name('avatar');
   // });
});

Route::get('home', function () {
    return redirect('/');
});


Route::get('/cart',[CartController::class ,'index'])->name('cart.index');
Route::post('/cart',[CartController::class ,'add'])->name('cart.add');
Route::get('/cart/shipping',[CartController::class ,'shipping'])->name('cart.shipping');
Route::post('/cart/shipping',[CartController::class ,'addShipping'])->name('cart.addShipping');
Route::post('/cart/conditions',[CartController::class ,'addCondition'])->name('cart.addCondition');
Route::delete('/cart/conditions',[CartController::class ,'clearCartConditions'])->name('cart.clearCartConditions');
Route::get('/cart/details',[CartController::class ,'details'])->name('cart.details');
Route::get('/cart/update/{id}&{action}',[CartController::class ,'update'])->name('cart.update');
Route::delete('/cart/{id}',[CartController::class ,'delete'])->name('cart.delete');

Route::post('/cart2-details',[Cart2Controller::class ,'go'])->name('cart2.go')->middleware('auth');
Route::get('/cart2',[Cart2Controller::class ,'index'])->name('cart2.index')->middleware('auth');
Route::post('/cart2',[Cart2Controller::class ,'add'])->name('cart2.add')->middleware('auth');
Route::get('/return_url',[Cart2Controller::class ,'return_money'])->name('cart3.finish');
Route::get('/yandex_checkout',[Cart2Controller::class ,'yandex_checkout']);
/*Route::get('/cart-finish','Cart2Controller@finish')->name('cart3.finish')->middleware('auth');*/


Route::get('product-cart/{id?}', [SiteController::class, 'productID'])->name('productID');






Route::get('/{path}',[SiteController::class, 'page'])->name('page');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
