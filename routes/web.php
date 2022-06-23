<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\Home;
use App\Http\Controllers\Product;
use App\Http\Controllers\Slider;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Cart;
use App\Http\Controllers\Order;
use App\Http\Controllers\User;
use App\Http\Middleware\CheckLoginAdmin;
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

Route::get('/', [Home::class, 'index']);
Route::get('/product/{cate_id}', [Home::class, 'product_by_cate']);
Route::get('/product-detail/{product_id}', [Home::class,'product_detail']);
// Route::get('/product-detail/login', [User::class,'login']);
// Route::get('/product-detail/login-action', [User::class,'login_action']);
Route::get('/product-all', [Home::class,'product_all']);
Route::get('register', [User::class, 'register']);
Route::post('register-action', [User::class, 'register_action']);
Route::get('login', [User::class, 'login']);
Route::get('log-out', [User::class, 'logout']);
Route::post('login-action', [User::class, 'login_action']);
Route::get('/check-user', [User::class, 'login_check']);
Route::get('/product-price-desc/{cate_id}', [Home::class, 'product_price_desc']);
Route::get('/product-price-asc/{cate_id}', [Home::class, 'product_price_asc']);
Route::get('/product-price-all/{cate_id}', [Home::class, 'product_price_all']);
Route::post('/add-to-cart', [Cart::class, 'add_to_cart']);
Route::post('/delete-cart-item/{cart_id}', [Cart::class, 'delete_cart_item']);
Route::get('/cart-checkout', [Cart::class, 'cart_checkout']);
Route::post('/update-cart-item-quantity/{cart_id}', [Cart::class, 'update_cart_item_quantity']);
Route::post('/update-desc-cart-item-quantity/{cart_id}', [Cart::class, 'update_desc_cart_item_quantity']);
Route::post('/update-cart-item-size/{cart_id}', [Cart::class, 'update_cart_item_size']);
Route::post('/find-product-name', [Home::class, 'find_product_name']);
Route::post('/cart-payment', [Cart::class, 'cart_payment']);
Route::get('/user-information', [User::class, 'user_information']);
Route::post('/update-avatar/{user_id}',  [User::class, 'update_avatar']);
Route::get('/cancel-orders/{id}',  [Order::class, 'cancel_orders']);
Route::get('/change-password', [User::class, 'change_password']);
Route::get('/reset-password', [User::class, 'reset_password']);
Route::post('/send-to-email', [User::class, 'send_to_email']);
Route::get('/reset-password-from-gmail', [User::class, 'reset_password_from_gmail'])->name('customer.reset');
Route::post('/reset-password-action', [User::class, 'reset_password_action']);

Route::post('/change-password-action/{user_id}', [User::class, 'change_password_action']);
Route::post('/product-by-cate/{cate_id}', [Product::class, 'product_by_cate_ajax']);
Route::post('/product-all-ajax', [Product::class, 'product_all_ajax']);
Route::post('/select-district', [Cart::class, 'select_district']);
Route::post('/select-ward', [Cart::class, 'select_ward']);


Route::post('/post-comment', [Home::class, 'post_comment']);
Route::post('/send-reply', [Home::class, 'send_reply']);




Route::prefix('/admin')->group(function() {

    Route::get('/login', [Admin::class, 'admin_login'])->name('login');
    Route::post('/login-action', [Admin::class, 'admin_login_action']);
    Route::get('/logout', [Admin::class, 'admin_logout'])->name('admin.logout');
    Route::middleware([CheckLoginAdmin::class])->group(function () {
        

        Route::get('/dashboard', [Admin::class, 'admin_dashboard']);
    
        Route::prefix('/category')->group(function() {
            Route::get('/all', [Category::class, 'all_category']);
            Route::get('/add', [Category::class, 'add_category']);
            Route::post('/save', [Category::class, 'save_category']);
            Route::get('/edit/{category_id}', [Category::class, 'edit_category']);
            Route::post('/update/{category_id}', [Category::class, 'update_category']);
            Route::get('/unactive-status/{category_id}', [Category::class, 'unactive_status_category']);
            Route::get('/active-status/{category_id}', [Category::class, 'active_status_category']);
            Route::get('/delete/{category_id}', [Category::class, 'delete_category']);
        });
    
        // Route::prefix('/brand')->group(function() {
        //     Route::get('/all', [Brand::class, 'all_brand']);
        //     Route::get('/add', [Brand::class, 'add_brand']);
        //     Route::post('/save', [Brand::class, 'save_brand']);
        //     Route::get('/edit/{brand_id}', [Brand::class, 'edit_brand']);
        //     Route::post('/update/{brand_id}', [Brand::class, 'update_brand']);
        //     Route::get('/unactive-status/{brand_id}', [Brand::class, 'unactive_status_brand']);
        //     Route::get('/active-status/{brand_id}', [Brand::class, 'active_status_brand']);
        //     Route::get('/delete/{brand_id}', [Brand::class, 'delete_brand']);
        // });
    
        Route::prefix('/product')->group(function() {
            Route::get('/all', [Product::class, 'all_product']);
            Route::get('/add', [Product::class, 'add_product']);
            Route::post('/save', [Product::class, 'save_product']);
            Route::get('/edit/{product_id}', [Product::class, 'edit_product']);
            Route::post('/update/{product_id}', [Product::class, 'update_product']);
            Route::get('/unactive-status/{product_id}', [Product::class, 'unactive_status_product']);
            Route::get('/active-status/{product_id}', [Product::class, 'active_status_product']);
            Route::get('/delete/{product_id}', [Product::class, 'delete_product']);
            Route::get('/delete-img-relate/{product_id}/{index}', [Product::class, 'delete_img_relate']);
        });

        Route::prefix('/slider')->group(function() {
            Route::get('/all', [Slider::class, 'all_slider']);
            Route::get('/add', [Slider::class, 'add_slider']);
            Route::post('/save', [Slider::class, 'save_slider']);
            Route::get('/edit/{slider_id}', [Slider::class, 'edit_slider']);
            Route::post('/update/{slider_id}', [Slider::class, 'update_slider']);
            Route::get('/delete/{slider_id}', [Slider::class, 'delete_slider']);
        });

        Route::prefix('/user')->group(function() {
            Route::get('/all', [User::class, 'all_user']);
            Route::get('/authorize-admin/{id}', [User::class, 'authorize_admin']);
            Route::get('/authorize-customer/{id}', [User::class, 'authorize_customer']);
            Route::get('/delete/{id}', [User::class, 'delete_user']);
        });

        

        Route::prefix('/order')->group(function() {
            Route::get('/all', [Order::class, 'all_order']);
        });

        Route::get('/order-detail/{id}', [Order::class, 'order_detail_progressing']);
        Route::get('/order/progressed/{id}', [Order::class, 'order_progressed']);
        Route::get('/order-detail/progressed/{id}', [Order::class, 'order_detail_progressed']);
        Route::get('/order/paid/{id}', [Order::class, 'order_paid']);
        Route::get('/order-detail/paid/{id}', [Order::class, 'order_detail_paid']);
        Route::get('/order-detail/cancel/{id}', [Order::class, 'order_detail_cancel']);

    });

});



