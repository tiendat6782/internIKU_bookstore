<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;


//Client
Route::match(['get'], '/', [ClientController::class, 'home'])->name('home');
Route::match(['get', 'post'], '/shop', [ClientController::class, 'shop'])->name('shop');
Route::match(['get'], '/detail/{id}', [ClientController::class, 'detail'])->name('detail');
Route::match(['get'], '/contact', [ClientController::class, 'contact'])->name('contact');
Route::match(['get'], '/blog', [ClientController::class, 'blog'])->name('blog');
Route::match(['get'], '/add-to-cart/{id}', [ClientController::class, 'addtocart'])->name('addtocart');
Route::match(['get'], '/get-cart', [ClientController::class, 'getCart'])->name('getCart');
Route::match(['get','post'], '/update-cart', [ClientController::class, 'updateCart'])->name('updateCart');
Route::match(['get'], '/remove-cart/{id}', [ClientController::class, 'removeCart'])->name('removeCart');

Route::middleware(['client'])->group(function () {
    Route::prefix('client')->group(function () {
        Route::match(['get', 'post'], '/profiles', [ClientController::class, 'profiles'])->name('profiles_client');
        Route::match(['get', 'post'], '/order', [ClientController::class, 'order'])->name('order_cart');
        Route::match(['get', 'post'], '/add-coupon-code', [ClientController::class, 'addCouponCode'])->name('addCode');
        Route::match(['get'], '/ordered', [ClientController::class, 'ordered'])->name('ordered');
        Route::match(['get'], '/cancel-order/{id}', [ClientController::class, 'cancel'])->name('cancel_ordered');
        Route::match(['get'], '/receive-order/{id}', [ClientController::class, 'receive'])->name('receive_ordered');
        Route::match(['post'], '/rate', [ClientController::class, 'rate'])->name('rate');

    });
});






//Auth
Route::match(['get', 'post'], '/login', [UserController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        //Dashboard
        Route::match(['get'], '/dashboard', [DashBoardController::class, 'dashboard'])->name('dashboard');
        //Category 
        Route::match(['get'], '/category', [CategoryController::class, 'view'])->name('category');
        Route::match(['get', 'post'], '/category/add', [CategoryController::class, 'insert'])->name('insert_category');
        Route::match(['get', 'post'], '/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit_category');
        Route::match(['get'], '/category/delete/{id}', [CategoryController::class, 'delete'])->name('delete_category');
        Route::match(['get'], '/category/force/{id}', [CategoryController::class, 'force'])->name('force_category');
        Route::match(['get'], '/category/restore/{id}', [CategoryController::class, 'restore'])->name('restore_category');
        Route::match(['get'], '/category/view-delete', [CategoryController::class, 'view_delete'])->name('view_delete_category');

        //Book
        Route::match(['get'], '/book', [BookController::class, 'view'])->name('book');
        Route::match(['get', 'post'], '/book/add', [BookController::class, 'insert'])->name('insert_book');
        Route::match(['get', 'post'], '/book/edit/{id}', [BookController::class, 'edit'])->name('edit_book');
        Route::match(['get'], '/book/delete/{id}', [BookController::class, 'delete'])->name('delete_book');
        Route::match(['get'], '/book/force/{id}', [BookController::class, 'force'])->name('force_book');
        Route::match(['get'], '/book/restore/{id}', [BookController::class, 'restore'])->name('restore_book');
        Route::match(['get'], '/book/view-delete', [BookController::class, 'view_delete'])->name('view_delete_book');

        //User 
        Route::match(['get'], '/user', [UserController::class, 'getAll'])->name('user');
        Route::match(['get', 'post'], '/user/add', [UserController::class, 'insert'])->name('insert_user');
        Route::match(['get', 'post'], '/user/edit/{id}', [UserController::class, 'edit'])->name('edit_user');
        Route::match(['get'], '/user/delete/{id}', [UserController::class, 'delete'])->name('delete_user');
        Route::match(['get'], '/user/force/{id}', [UserController::class, 'force'])->name('force_user');
        Route::match(['get'], '/user/restore/{id}', [UserController::class, 'restore'])->name('restore_user');
        Route::match(['get'], '/user/view-delete', [UserController::class, 'view_delete'])->name('view_delete_user');
        Route::match(['get'], '/user/profiles', [UserController::class, 'profiles_detail'])->name('profiles_detail');
        Route::match(['get', 'post'], '/user/profile/{id}', [UserController::class, 'profiles'])->name('profile');

        //Order 
        Route::match(['get'], '/order', [OrderController::class, 'getAll'])->name('order');
        Route::match(['get'], '/handle/{id}', [OrderController::class, 'handle'])->name('handle');
        Route::match(['get'], '/order-detail', [OrderController::class, 'orderDetail'])->name('order_detail');

        //Rate 
        Route::match(['get'], '/rate', [RateController::class, 'view'])->name('rate_admin');

        //Promotion
        Route::match(['get'], '/promotion', [PromotionController::class, 'view'])->name('promotion');
        Route::match(['get', 'post'], '/promotion/add', [PromotionController::class, 'insert'])->name('insert_promotion');
        Route::match(['get', 'post'], '/promotion/edit/{id}', [PromotionController::class, 'update'])->name('edit_promotion');
        Route::match(['get'], '/promotion/delete/{id}', [PromotionController::class, 'delete'])->name('delete_promotion');
        Route::match(['get'], '/promotion/force/{id}', [PromotionController::class, 'force'])->name('force_promotion');
        Route::match(['get'], '/promotion/restore/{id}', [PromotionController::class, 'restore'])->name('restore_promotion');
        Route::match(['get'], '/promotion/view-delete', [PromotionController::class, 'view_delete'])->name('view_delete_promotion');

        //Profile 
        Route::match(['get'], '/profile', [userController::class, 'profile'])->name('profile_admin');
    });
});