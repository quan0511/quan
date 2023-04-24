<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuongController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\User\IndexController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserProductDetailController;
use App\Http\Controllers\User\UserWishlistController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserAccountController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\AdminLogin;
use App\Http\Middleware\UserLogin;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\PayPalController;

// Route::get('/', function () {
//     return view('welcome');
// });

// =============== PAYPAL =============== //
Route::post('store', [PayPalController::class, 'store'])->name('store');
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

// =============== ROUTE USER =============== //

Route::get('/', [TuongController::class,'home_page'])->name('index');
Route::get('/cate_pr', [TuongController::class,'admin_cate'])->name('productList');
Route::get('/signin',[TuongController::class,"get_signIn"])->name('signin');
Route::post('/signin',[TuongController::class,"post_signIn"])->name('signin');
Route::get('/signup',[TuongController::class,"get_signUp"])->name('signup');
Route::post('/signup',[TuongController::class,"post_signUp"])->name('signup');
Route::get('/signout',[TuongController::class,'signOut'])->name('signout');
Route::get('/order',[TuongController::class,'get_order'])->name('order');


Route::get('/product.findByName',[App\Http\Controllers\User\UserController::class ,'findByName'])->name('product.findByName');
Route::get('/user.pages.Products.index', [UserController::class, 'index'])->name('user.pages.Products.index');
Route::get('/user.pages.Products.index/{type_name?}/{breed_name?}',[UserController::class,"productList"])->name('user.pages.Products.index');
Route::get('/products-details/{id}', [TuongController::class,'product_detail'])->name('products-details');
Route::post('/products-details/{id?}', [TuongController::class,'addToCart'])->name('products-details');
Route::post('/post-comment',[TuongController::class,'post_comment'])->name('addComment');
Route::get('/delete_cmt/{id}',[TuongController::class,'deleteCmt'])->name('delete_cmt');
Route::post('/edit_cmt/{id}',[TuongController::class,'editCmt'])->name('edit_cmt');
Route::get('/shop-wishlist',[TuongController::class,'get_wishlist'] )->name('wishlist');
Route::post('/shop-wishlist',[TuongController::class,'post_wishlist'])->name('wishlist');

//Login Google
Route::get('/auth/google',[GoogleAuthController::class,'redirect'])->name('google-auth');
Route::get('/auth/google/callback',[GoogleAuthController::class,'callbackGoogle']);

Route::get('/checkout',[TuongController::class,'get_checkout'])->name('checkout');
Route::post('/checkout',[TuongController::class,'post_checkout'])->name('checkout');
Route::get('/removeCart/{id}',[TuongController::class,'removeCart'])->name("removeId");
Route::get('/ajax/modal/show-product/{id}',[TuongController::class,'modal_product']);
Route::get('/ajax/cart/listcart',[TuongController::class,'modalCart']);
Route::get('/ajax/cart/clearcart',[TuongController::class,'clearCart']);
Route::post('/add_address',[TuongController::class,'add_address'])->name('post_address');
Route::get('/remove_address/{id}',[TuongController::class,'remove_address']);
Route::post('/addItemCart/{id}',[TuongController::class,'cartadd_quan'])->name('cartadd');
Route::get('/minusItem/{id}',[TuongController::class,'minusOne'])->name('minus');
Route::get('/addItem/{id}',[TuongController::class,'addMore'])->name('addmore');
Route::get('/ajax/add-cart/{id}',[TuongController::class,'addToCart2']);
Route::get('/ajax/add-favourite/{id}',[TuongController::class,'add_favourite']);
Route::get('/ajax/add-compare/{id}',[TuongController::class,'addCompare']);
Route::get('/ajax/add-coupon/{coupon}',[TuongController::class,'addCoupon']);
Route::get('/ajax/compare/showcompare',[TuongController::class,'showCompare']);
Route::get('/ajax/check-email/{email}',[TuongController::class,'check_email']);
Route::get('/delcompare/{id}',[TuongController::class,'delCompare'])->name('delCmp');
Route::get('/removeCmp',[TuongController::class,'removeCompare'])->name('removeCmp');
//UserLogin to get profie User
Route::group(['prefix'=>'account', 'middleware'=>'UserLogin'],function(){
    Route::get('/order',[TuongController::class,'get_orderhistory'])->name('accountorder');
    Route::get('/setting',[TuongController::class,'get_accountsetting'])->name('accountsetting');
    Route::get('/list_address',[TuongController::class,'get_address'])->name('accountaddress');
    Route::get('/remove_address/{id}',[TuongController::class,'remove_address'])->name('removeAdd');
    Route::get('/default-address/{id}',[TuongController::class,'setdefault_address'])->name('setdefault_address');
    Route::get('/payment',[TuongController::class,'get_payment'])->name('accountpayment');
    Route::get('/feedback/{code}',[TuongController::class,'get_feedback'])->name('feedback');
    Route::post('/feedback/{code}',[TuongController::class,'post_feedback'])->name('feedback');
    Route::post('/edit-profie',[TuongController::class,'post_editprofie'])->name('edit_profie');
    Route::post('/change-password',[TuongController::class,'post_changepassword'])->name('change_password');
    Route::post('/edit-order',[TuongController::class,'post_urseditorder'])->name('user_editorder');
    Route::get('/cancel-order/{id}',[TuongController::class,'cancel_order'])->name('cancelorder');
    Route::get('/ajax/edit_order/{id}',[TuongController::class,'ajax_getOrder']);
    Route::post('/ajax/check-password',[TuongController::class,'check_password']);

});


// ==========

// Route::get('/', [IndexController::class, 'index'])->name('index');

// Route::get('/category', [UserProductController::class, 'index'])->name('products');

// Route::get('/product-detail', [UserProductDetailController::class, 'index'])->name('products-details');

// Route::get('/wishlist', [UserWishlistController::class, 'index'])->name('wishlist');

// Route::get('/order', [UserOrderController::class, 'index'])->name('order');

// Route::get('/account/accorder', [UserAccountController::class, 'Orders'])->name('accountorder');
// Route::get('/account/setting', [UserAccountController::class, 'Settings'])->name('setting');
// Route::get('/account/address', [UserAccountController::class, 'Address'])->name('address');
// Route::get('/account/payment', [UserAccountController::class, 'PaymentMethod'])->name('payment');



// =============== END ROUTE USER =============== //


// =============== ROUTE ADMIN =============== //

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('adminCategories');
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('adminAddCategories');
// Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('adminEditCategory');
// Route::post('/admin/category/update', [AdminCategoryController::class, 'update'])->name('adminUpdateCategory');
// Route::post('/admin/category/delete', [AdminCategoryController::class, 'delete'])->name('adminDeleteCategory');

Route::get('/admin/products', [AdminProductController::class, 'index'])->name('adminProduct');
Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('adminAddProduct');
// Route::get('/admin/products/edit/{id}', [AdminProductController::class, 'edit'])->name('adminEditProduct');
// Route::post('/admin/products/update', [AdminProductController::class, 'update'])->name('adminUpdateProduct');
// Route::post('/admin/products/delete', [AdminProductController::class, 'delete'])->name('adminDeleteProduct');

Route::get('/admin/customer', [AdminCustomerController::class, 'index'])->name('adminCustomers');
// Route::get('/admin/customer/create', [AdminCustomerController::class, 'create'])->name('adminAddCustomer');
// Route::get('/admin/customer/edit/{id}', [AdminCustomerController::class, 'edit'])->name('adminEditCustomer');
// Route::post('/admin/customer/update', [AdminCustomerController::class, 'update'])->name('adminUpdateCustomer');
// Route::post('/admin/customer/delete', [AdminCustomerController::class, 'delete'])->name('adminDeleteCustomer');

Route::get('/admin/order', [AdminOrderController::class, 'index'])->name('adminOrder');
Route::get('/admin/order/list', [AdminOrderController::class, 'list'])->name('adminOrderList');
Route::get('/admin/order/single', [AdminOrderController::class, 'single'])->name('adminOrderSingle');
// Route::get('/admin/order/create', [AdminOrderController::class, 'create'])->name('adminAddOrder');
// Route::get('/admin/order/edit/{id}', [AdminOrderController::class, 'edit'])->name('adminEditOrder');
// Route::post('/admin/order/update', [AdminOrderController::class, 'update'])->name('adminUpdateOrder');
// Route::post('/admin/order/delete', [AdminOrderController::class, 'delete'])->name('adminDeleteOrder');

Route::get('/admin/review', [AdminReviewController::class, 'index'])->name('adminReviews');
// Route::get('/admin/review/create', [AdminReviewController::class, 'create'])->name('adminAddReview');
// Route::get('/admin/review/edit/{id}', [AdminReviewController::class, 'edit'])->name('adminEditReview');
// Route::post('/admin/review/update', [AdminReviewController::class, 'update'])->name('adminUpdateReview');
// Route::post('/admin/review/delete', [AdminReviewController::class, 'delete'])->name('adminDeleteReview');

// =============== END ROUTE ADMIN =============== //
