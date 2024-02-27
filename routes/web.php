<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\FrontEnd\FEBlogController;
use App\Http\Controllers\frontend\FECartController;
use App\Http\Controllers\FrontEnd\FECommentsController;
use App\Http\Controllers\frontend\FEHomeController;
use App\Http\Controllers\FrontEnd\FELoginController;
use App\Http\Controllers\frontend\FEProductController;
use App\Http\Controllers\frontend\FEUserController;
use App\Http\Controllers\FrontEnd\RateController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
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

// FrontEnd

Auth::routes();

    // login
    Route::get('/', [FELoginController::class,'index'])->name('trang-chu');
    Route::get('/member/login', [FELoginController::class,'show_Login'])->name('trang-chu-login');
    Route::post('/member/login', [FELoginController::class,'login']);
    Route::post('/member/register', [FELoginController::class,'register'])->name('trang-chu-register');
    Route::get('/member/logout', [FELoginController::class,'logout'])->name('trang-chu-logout');

    //blog
    Route::get('/member/blog', [FEBlogController::class,'index'])->name('blog');
    Route::get('/member/blog/details/{id}', [FEBlogController::class,'get_Details'])->name('blog-details');
    Route::post('/member/blog/rate', [RateController::class,'index'])->name('rate');

    Route::post('/member/blog/comments', [FECommentsController::class,'post_Comments'])->name('post-comments');
    Route::get('/member/blog/comments-reply', [FECommentsController::class,'get_level_replay'])->name('get-level-replay');//show reply
    
    
    //account
    Route::get('/member/account/update', [FEUserController::class,'index'])->name('account');
    Route::post('/member/account/update', [FEUserController::class,'update_account']);

    Route::get('/member/account/product', [FEProductController::class,'my_product'])->name('my-product');
    Route::get('/member/account/add-product', [FEProductController::class,'my_product_add'])->name('my-product-add');
    Route::post('/member/account/add-product', [FEProductController::class,'post_Add']);
    Route::get('/member/account/edit-product/{id}', [FEProductController::class,'my_product_edit'])->name('my-product-edit');
    Route::post('/member/account/edit-product/{id}', [FEProductController::class,'post_Edit']);
    
    Route::get('/member/account/delete-product/{id}', [FEProductController::class,'my_product_delete'])->name('my-product-delete');

    //Product Details
    Route::get('/member/product/details/{id}', [FEHomeController::class,'product_Detail'])->name('product-detail');


    //Add to cart
    Route::get('/member/product/add-to-cart', [FECartController::class,'add_Cart'])->name('add-to-cart');
    Route::get('/member/cart/show-cart', [FECartController::class,'show_Cart'])->name('show-cart');
    Route::get('/member/cart/edit-cart-up', [FECartController::class,'edit_cart_quantity_up'])->name('edit-cart-quantity-up');
    Route::get('/member/cart/edit-cart-down', [FECartController::class,'edit_cart_quantity_down'])->name('edit-cart-quantity-down');
    // Route::get('/member/cart/show-cart', [FECartController::class,'show_Cart'])->name('show-cart');

    //check out
    Route::get('/member/cart/checkout', [FECartController::class,'checkout'])->name('checkout');
    //emails
    
    Route::get('/test', [MailController::class,'index'])->name('index-mails');
    //Search

    Route::get('/member/search', [FEHomeController::class,'search'])->name('search');
    Route::post('/member/search', [FEHomeController::class,'search_handle']);

    Route::get('/member/search/home', [FEHomeController::class,'search_home'])->name('search-home');

 

// BackEnd


Route::prefix('/home')->name('admin.')->group(function ()
{
    Route::get('/', [HomeController::class, 'index'])->name('admin');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'edit_Profile']);
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    // country
    Route::get('/country', [CountryController::class, 'index'])->name('country');
    Route::get('/country_edit/{id}', [CountryController::class, 'get_Edit'])->name('country-edit');
    Route::post('/country_edit/{id}', [CountryController::class, 'post_Edit']);
    Route::get('/country_add', [CountryController::class, 'add'])->name('country-add');
    Route::post('/country_add', [CountryController::class, 'post_add']);
    Route::get('/country_delete/{id}', [CountryController::class, 'delete'])->name('country-delete');

    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    
    Route::get('/blog_Add', [BlogController::class, 'add'])->name('blog-add');
    Route::post('/blog_Add', [BlogController::class, 'post_Add']);
    Route::get('/blog_Edit/{id}', [BlogController::class, 'edit'])->name('blog-edit');
    Route::post('/blog_Edit/{id}', [BlogController::class, 'post_Edit']);
    Route::get('blog_delete/{id}', [BlogController::class, 'delete'])->name('blog-delete');

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand');
    Route::get('/brand_Add', [BrandController::class, 'add'])->name('brand-add');
    Route::post('/brand_Add', [BrandController::class, 'post_Add']);
    Route::get('/brand_Edit/{id}', [BrandController::class, 'edit'])->name('brand-edit');
    Route::post('/brand_Edit/{id}', [BrandController::class, 'post_Edit']);
    Route::get('brand_delete/{id}', [BrandController::class, 'delete'])->name('brand-delete');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category_Add', [CategoryController::class, 'add'])->name('category-add');
    Route::post('/category_Add', [CategoryController::class, 'post_Add']);
    Route::get('/category_Edit/{id}', [CategoryController::class, 'edit'])->name('category-edit');
    Route::post('/category_Edit/{id}', [CategoryController::class, 'post_Edit']);
    Route::get('category_delete/{id}', [CategoryController::class, 'delete'])->name('category-delete');

});
