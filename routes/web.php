<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
// return view('welcome');
// });

// Route::get('/test', function () {
//     orderEmail(20);

// });

Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategory?}',[ShopController::class,'index'])->name('front.shop');
Route::get('/product/{slug}',[ShopController::class,'product'])->name('front.product');
Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::post('/update-cart',[CartController::class,'updateCart'])->name('front.updateCart');
Route::post('/delete-item',[CartController::class,'deleteItem'])->name('front.deleteItem.cart');
Route::get('/get-cart-item-count', [CartController::class,'getCartItemCount'])->name('front.getCartItemCount');

Route::get('/checkout',[CartController::class,'checkout'])->name('front.checkout');
Route::post('/process-checkout',[CartController::class,'processCheckout'])->name('front.processCheckout');
Route::get('/thanks/{orderId}',[CartController::class,'thankyou'])->name('front.thankyou');
Route::post('/get-order-summary',[CartController::class,'getOrderSummary'])->name('front.getOrderSummary');
Route::post('/apply-discount',[CartController::class,'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount',[CartController::class,'removeCoupon'])->name('front.removeCoupon');
Route::post('/add-to-wishlist',[FrontController::class,'addToWishlist'])->name('front.addToWishlist');
Route::get('/page/{slug}',[FrontController::class,'page'])->name('front.page');
Route::post('/send-contact-email',[FrontController::class,'sendContactEmail'])->name('front.sendContactEmail');

Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('front.forgotPassword');
Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('front.processForgotPassword');
Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('front.processResetPassword');
Route::post('/save-rating/{productId}', [ShopController::class,'saveRating'])->name('front.saveRating');

Route::group(['prefix' => 'account'],function(){
    Route::group(['middleware' => 'guest'],function(){
        Route::get('/login',[AuthController::class,'login'])->name('account.login');
        Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');
        Route::get('/register',[AuthController::class,'register'])->name('account.register');
        Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');
        
    });

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
        Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
        Route::post('/update-address',[AuthController::class,'updateAddress'])->name('account.updateAddress');

        Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
        Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');

        Route::get('/my-orders',[AuthController::class,'orders'])->name('account.orders');
        Route::get('/my-wishlist',[AuthController::class,'wishlist'])->name('account.wishlist');
        Route::post('/remove-product-from-wishlist',[AuthController::class,'removeProductFromWishList'])->name('account.removeProductFromWishList');
        Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('account.orderDetail');
        Route::get('/generate-invoice/{orderId}',[AuthController::class,'generateInvoice'])->name('account.generateInvoice');
        Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

    });
});

Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){

        Route::get('/login', [AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class,'authenticate'])->name('admin.authenticate');
        
    });

    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/dashboard', [HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/check-new-orders', [HomeController::class, 'checkNewOrders'])->name('admin.checkNewOrders');
        Route::get('/logout', [HomeController::class,'logout'])->name('admin.logout');

        // Category Routes
        Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class,'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class,'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class,'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class,'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class,'destroy'])->name('categories.delete');
        Route::get('/categories/export/excel', [CategoryController::class, 'export_excel'])->name('categories.export_excel');
        Route::post('/categories/import/excel', [CategoryController::class, 'import_excel'])->name('categories.import_excel');
        Route::get('/categories/export/pdf',[CategoryController::class,'export_pdf'])->name('categories.export_pdf');

        // Brand Routes
        Route::get('/brands', [BrandController::class,'index'])->name('brands.index');
        Route::get('/brands/create', [BrandController::class,'create'])->name('brands.create');
        Route::post('/brands', [BrandController::class,'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandController::class,'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandController::class,'update'])->name('brands.update');
        Route::delete('/brands/{brand}', [BrandController::class,'destroy'])->name('brands.delete');
        Route::get('/brands/export/excel', [BrandController::class, 'export_excel'])->name('brands.export_excel');
        Route::post('/brands/import/excel', [BrandController::class, 'import_excel'])->name('brands.import_excel');
        Route::get('/brands/export/pdf',[BrandController::class,'export_pdf'])->name('brands.export_pdf');

         // Product Routes
        Route::get('/products', [ProductController::class,'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
        Route::post('/products', [ProductController::class,'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class,'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class,'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class,'destroy'])->name('products.delete');
        Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');
        Route::get('/products/export/excel', [ProductController::class, 'export_excel'])->name('products.export_excel');
        Route::post('/products/import/excel', [ProductController::class, 'import_excel'])->name('products.import_excel');
        Route::get('/products/export/pdf',[ProductController::class,'export_pdf'])->name('products.export_pdf');

        Route::post('/product-images/update', [ProductImageController::class,'update'])->name('product-images.update');
        Route::delete('/product-images', [ProductImageController::class,'destroy'])->name('product-images.destroy');

        // Shipping Routes
        Route::get('/shipping/create', [ShippingController::class,'create'])->name('shipping.create');
        Route::post('/shipping', [ShippingController::class,'store'])->name('shipping.store');
        Route::get('/shipping/{id}', [ShippingController::class,'edit'])->name('shipping.edit');
        Route::put('/shipping/{id}', [ShippingController::class,'update'])->name('shipping.update');
        Route::delete('/shipping/{id}', [ShippingController::class,'destroy'])->name('shipping.delete');
        Route::get('/shipping/export/excel', [ShippingController::class, 'export_excel'])->name('shipping.export_excel');
        Route::post('/shipping/import/excel', [ShippingController::class, 'import_excel'])->name('shipping.import_excel');
        Route::get('/shipping/export/pdf',[ShippingController::class,'export_pdf'])->name('shipping.export_pdf');

        // Order Routes
        Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class,'detail'])->name('orders.detail');
        Route::post('/order/change-status/{id}', [OrderController::class,'changeOrderStatus'])->name('orders.changeOrderStatus');
        Route::post('/order/send-email/{id}', [OrderController::class,'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');
        Route::get('/orders/export/excel', [OrderController::class, 'export_excel'])->name('orders.export_excel');
        Route::get('/orders/export/pdf',[OrderController::class,'export_pdf'])->name('orders.export_pdf');

        // Users Routes
        Route::get('users',[UserController::class,'index'])->name('users.index');
        Route::get('/users/create', [UserController::class,'create'])->name('users.create');
        Route::post('/users', [UserController::class,'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class,'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class,'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class,'destroy'])->name('users.delete');
        Route::get('/users/export/excel', [UserController::class, 'export_excel'])->name('users.export_excel');

        // Pages Routes
        Route::get('pages',[PagesController::class,'index'])->name('pages.index');
        Route::get('/pages/create', [PagesController::class,'create'])->name('pages.create');
        Route::post('/pages', [PagesController::class,'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PagesController::class,'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PagesController::class,'update'])->name('pages.update');
        Route::delete('/pages/{page}', [PagesController::class,'destroy'])->name('pages.delete');

        // Temp Images Route
        Route::post('/upload-temp-image', [TempImagesController::class,'create'])->name('temp-images.create');

        // Setting Routes
        Route::get('/change-password',[SettingController::class,'ShowChangePasswordForm'])->name('admin.ShowChangePasswordForm');
        Route::post('/process-change-password',[SettingController::class,'processChangePassword'])->name('admin.ProcessChangePassword');

        Route::get('/getSlug',function(Request $request){
            $slug = '';
            if(!empty($request->title)) {
                $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug' =>$slug
            ]);
        })->name('getSlug');
    });
});

