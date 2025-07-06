<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Category;

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){

	Route::match(['get','post'],'/','AdminController@login');
	Route::group(['middleware'=>['admin']],function(){
		Route::get('dashboard','AdminController@dashboard');
		Route::get('settings','AdminController@settings');
		Route::get('logout','AdminController@logout');
		Route::post('check-current-pwd','AdminController@chkCurrentPwd');
		Route::post('update-current-pwd','AdminController@updateCurrentPwd');
		Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');
		// Sections
		Route::get('sections','SectionController@sections');
		Route::post('update-section-status','SectionController@updateSectionStatus');
		// Brands
		Route::get('brands','BrandController@brands');
		Route::post('update-brand-status','BrandController@updateBrandStatus');
		Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrand');
		Route::get('delete-brand/{id}','BrandController@deleteBrand');
		// Categories
		Route::get('categories','CategoryController@categories');
		Route::post('update-category-status','CategoryController@updateCategoryStatus');
		Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');
		Route::post('append-categories-level','CategoryController@appendCategoryLevel');
		Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
		Route::get('delete-category/{id}','CategoryController@deleteCategory');
		// Products
		Route::get('products','ProductController@products');
		Route::post('update-product-status','ProductController@updateProductStatus');
		Route::get('delete-product/{id}','ProductController@deleteProduct');
		Route::match(['get','post'],'add-edit-product/{id?}','ProductController@addEditProduct');
		Route::get('delete-product-image/{id}','ProductController@deleteProductImage');
		Route::get('delete-product-video/{id}','ProductController@deleteProductVideo');
		// Attributes
		Route::match(['get','post'],'add-attributes/{id}','ProductController@addAttributes');
		Route::post('edit-attributes/{id}','ProductController@editAttributes');
		Route::post('update-attribute-status','ProductController@updateAttributeStatus');
		Route::get('delete-attribute/{id}','ProductController@deleteAttribute');
		// Images
		Route::match(['get','post'],'add-images/{id}','ProductController@addImages');
		Route::post('update-image-status','ProductController@updateImageStatus');
		Route::get('delete-image/{id}','ProductController@deleteImage');
		// Banners
		Route::get('banners','BannerController@banners');
		Route::match(['get','post'],'add-edit-banner/{id?}','BannerController@addEditBanner');
		Route::post('update-banner-status','BannerController@updateBannerStatus');
		Route::get('delete-banner/{id}','BannerController@deleteBanner');
		// Coupons
		Route::get('coupons','CouponController@coupons');
		Route::post('update-coupon-status','CouponController@updateCouponStatus');
		Route::match(['get','post'],'add-edit-coupon/{id?}','CouponController@addEditCoupon');
		Route::get('delete-coupon/{id}','CouponController@deleteCoupon');
		// Orders
		Route::get('orders','OrdersController@orders');
		Route::get('orders/{id}','OrdersController@orderDetails');
		Route::post('update-order-status','OrdersController@updateOrderStatus');
	});
	
});

Route::namespace('Front')->group(function(){
	// Home Page Route
	Route::get('/','IndexController@index');
	// Listing / Category Route
	// Get Category Url
	$catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
	foreach($catUrls as $url){
		Route::get('/'.$url,'ProductController@listing');
	}
	// Product Detail Route
	Route::get('/product/{id}','ProductController@detail');
	// Get Product Attribute Price
	Route::post('/get-product-price','ProductController@getProductPrice');
	// Add to Cart Route
	Route::post('/add-to-cart','ProductController@addtocart');
	// Shopping Cart Route
	Route::get('/cart','ProductController@cart');
	// Update Cart Item Quantity
	Route::post('/update-cart-item-qty','ProductController@updateCartItemQty');
	// Delete Cart Item
	Route::post('/delete-cart-item','ProductController@deleteCartItem');
	// Login / Register
	Route::get('/login-register',['as'=>'login','uses'=>'UsersController@loginRegister']);
	// Login User
	Route::post('/login','UsersController@loginUser');
	// Check if Email already exists
	Route::match(['get','post'],'/check-email','UsersController@checkEmail');
	// Register User
	Route::post('/register','UsersController@registerUser');
	// Logout User
	Route::get('/logout','UsersController@logoutUser');

	Route::group(['middleware'=>['auth']],function(){
		// Users Account
		Route::match(['get','post'],'/account','UsersController@account');
		// Apply Coupon
		Route::post('/apply-coupon','ProductController@applyCoupon');
		// Checkout
		Route::match(['get','post'],'/checkout','ProductController@checkout');
		// Delivery Address
		Route::match(['get','post'],'/add-edit-delivery-address/{id?}','ProductController@addEditDeliveryAddress');
		// Delete Delivery Address
		Route::get('/delete-delivery-address/{id}','ProductController@deleteDeliveryAddress');
		// Thanks
		Route::get('/thanks','ProductController@thanks');
		// Users Orders
		Route::get('/orders','OrdersController@orders');
		// Order Details
		Route::get('/orders/{id}','OrdersController@orderDetails');
	});
	
});
