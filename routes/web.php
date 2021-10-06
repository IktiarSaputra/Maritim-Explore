<?php

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

Route::get('/' ,[App\Http\Controllers\WelcomeController::class, 'welcome']);

Route::prefix('education')->group(function () {
   Route::get('/' ,[App\Http\Controllers\WelcomeController::class, 'education'])->name('education');
   Route::get('/{slug}', [App\Http\Controllers\BlogController::class, 'isi_blog'])->name('blog.isi'); 
   Route::post('/comment', [App\Http\Controllers\BlogController::class, 'comment'])->name('comment');
   Route::get('/category/{slug}', [App\Http\Controllers\BlogController::class, 'category'])->name('blog.category');
});

Route::get('/healthy' ,[App\Http\Controllers\WelcomeController::class, 'healthy'])->name('healthy');
Route::get('/vaksinasi' ,[App\Http\Controllers\WelcomeController::class, 'vaksin'])->name('vaksin');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/desa', [App\Http\Controllers\VillageController::class, 'list'])->name('desa');

Route::get('/detailtravels', function () {
    return view('travel.detail-travel');
})->name('details');

Route::get('/germas', function () {
    return view('healthy.germas');
})->name('details');


Route::get('/edu', function () {
    return view('education');
})->name('edu');

Route::get('/kependudukan', [App\Http\Controllers\PopulationController::class, 'population'])->name('penduduk');

Route::get('/satuan-kerja', function () {
    return view('footer.satuan-kerja');
})->name('satuankerja');

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard.admin');
        Route::get('/user', [App\Http\Controllers\AdminController::class, 'listuser'])->name('user.list');
        Route::get('/category', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
        Route::get('/product', [App\Http\Controllers\ProductController::class, 'showlist'])->name('admin.product');
        Route::get('/seller', [App\Http\Controllers\SellerController::class, 'list_seller'])->name('seller.list');
        Route::get('/seller/confirmed/{id}', [App\Http\Controllers\SellerController::class, 'confirm']);
        Route::resource('travel', App\Http\Controllers\TravelController::class)->except('show');
        Route::post('/images', [App\Http\Controllers\TravelController::class, 'uploadImage'])->name('travel.image');
        Route::resource('population', App\Http\Controllers\PopulationController::class)->except('show');
        Route::resource('village', App\Http\Controllers\VillageController::class)->except('show');
        Route::post('/village/import_excel', [App\Http\Controllers\VillageController::class, 'import'])->name('village.import');
        Route::post('/travel/import_excel', [App\Http\Controllers\TravelController::class, 'import'])->name('travel.import');
        Route::post('/population/import_excel', [App\Http\Controllers\PopulationController::class, 'import'])->name('population.import');
        Route::resource('owneruser', App\Http\Controllers\OwnerController::class)->except('show');
    });
});

Route::get('/ongkir', [App\Http\Controllers\Ecommerce\CartController::class, 'ongkir']);

Route::prefix('travel')->group(function () {
    Route::get('/', [App\Http\Controllers\TouristController::class, 'index'])->name('index.travel');
    Route::get('/{slug}', [App\Http\Controllers\TouristController::class, 'show'])->name('show.travel');
});

Route::prefix('seller')->group(function () {
    Route::get('/register', [App\Http\Controllers\SellerController::class, 'index'])->name('seller.register');
    Route::post('/register', [App\Http\Controllers\SellerController::class, 'store_seller'])->name('seller.store');
    Route::get('/home' , [App\Http\Controllers\SellerController::class, 'home'])->name('home.seller');
    Route::middleware(['auth', 'seller'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard.seller');
        Route::resource('category', App\Http\Controllers\CategoryController::class)->except(['create', 'show']);
        Route::resource('product',  App\Http\Controllers\ProductController::class)->except(['show']);
        Route::get('/rate', [ App\Http\Controllers\ProductController::class, 'rate'])->name('product.rate');
        Route::post('/seller/update', [App\Http\Controllers\ProfileController::class, 'seller_store'])->name('seller.update');
        Route::post('/seller/store', [App\Http\Controllers\ProfileController::class, 'seller_update'])->name('seller.store');
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('seller.profile');
        Route::get('/profile/delete/{id}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.delete');
        Route::post('/profile/update/', [App\Http\Controllers\ProfileController::class, 'upload_image'])->name('update.profile');
        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
            Route::get('/{invoice}', [App\Http\Controllers\OrderController::class, 'view'])->name('orders.view');
            Route::get('/payment/{invoice}', [App\Http\Controllers\OrderController::class, 'acceptPayment'])->name('orders.approve_payment');
            Route::delete('/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
            Route::post('/shipping', [App\Http\Controllers\OrderController::class, 'shippingOrder'])->name('orders.shipping');
        });
        Route::group(['prefix' => 'reports'], function() {
            Route::get('/order', [App\Http\Controllers\SellerController::class, 'orderReport'])->name('report.order');
            Route::get('/order/pdf/{daterange}', [App\Http\Controllers\SellerController::class, 'orderReportPdf'])->name('report.order_pdf');
            Route::get('/return', [App\Http\Controllers\SellerController::class, 'returnReport'])->name('report.return');
            Route::get('/return/pdf/{daterange}', [App\Http\Controllers\SellerController::class, 'returnReportPdf'])->name('report.return_pdf');
        });
    });
});


Route::prefix('ecommerce')->group(function () {
    Route::get('/product', [App\Http\Controllers\Ecommerce\FrontController::class, 'product'])->name('front.product');
    Route::get('/product/{slug}', [App\Http\Controllers\Ecommerce\FrontController::class, 'show'])->name('front.show_product');
    Route::get('/cart/list', [App\Http\Controllers\Ecommerce\CartController::class, 'listCart'])->name('front.list_cart');
    Route::get('/cart/{id}',[App\Http\Controllers\Ecommerce\CartController::class, 'destroy']);
    Route::post('/cart/update', [App\Http\Controllers\Ecommerce\CartController::class, 'updateCart'])->name('front.update_cart');
    Route::post('/cart/add', [App\Http\Controllers\Ecommerce\CartController::class, 'addToCart'])->name('front.addtocart');
    
    Route::middleware('auth')->group(function () {
        Route::get('/product/ref/{user}/{product}', [App\Http\Controllers\Ecommerce\FrontController::class, 'referalProduct'])->name('front.afiliasi');
        Route::get('/afiliasi', [App\Http\Controllers\Ecommerce\FrontController::class, 'listCommission'])->name('customer.affiliate');
        Route::get('/', [App\Http\Controllers\Ecommerce\FrontController::class, 'index'])->name('ecommerce.index');
        Route::get('/toko/{user_id}', [App\Http\Controllers\Ecommerce\FrontController::class, 'toko'])->name('ecommerce.toko');
        Route::get('/category/{slug}', [App\Http\Controllers\Ecommerce\FrontController::class, 'categoryProduct'])->name('front.category');
        
        Route::get('/checkout', [App\Http\Controllers\Ecommerce\CartController::class, 'checkout'])->name('front.checkout');
        Route::get('/checkout/ongkir', [App\Http\Controllers\Ecommerce\CartController::class, 'cek_ongkir'])->name('front.ongkir');
        Route::post('/checkout', [App\Http\Controllers\Ecommerce\CartController::class, 'processCheckout'])->name('front.store_checkout');
        Route::get('/checkout/{invoice}', [App\Http\Controllers\Ecommerce\CartController::class, 'checkoutFinish'])->name('front.finish_checkout');
        Route::get('orders', [App\Http\Controllers\Ecommerce\OrderController::class, 'index'])->name('customer.orders');
        Route::post('orders/rate', [App\Http\Controllers\Ecommerce\OrderController::class, 'rate'])->name('customer.orders.rate');
        Route::get('orders/{invoice}', [App\Http\Controllers\Ecommerce\OrderController::class, 'view'])->name('customer.view_order');
        Route::get('orders/pdf/{invoice}', [App\Http\Controllers\Ecommerce\OrderController::class, 'pdf'])->name('customer.order_pdf');
        Route::get('payment/{invoice}', [App\Http\Controllers\Ecommerce\OrderController::class, 'paymentForm'])->name('customer.paymentForm');
        Route::post('payment', [App\Http\Controllers\Ecommerce\OrderController::class, 'storePayment'])->name('customer.savePayment');
        Route::get('setting', [App\Http\Controllers\Ecommerce\FrontController::class, 'customerSettingForm'])->name('customer.settingForm');
        Route::post('setting', [App\Http\Controllers\Ecommerce\FrontController::class, 'customerUpdateProfile'])->name('customer.setting');
        Route::post('orders/accept', [App\Http\Controllers\OrderController::class, 'acceptOrder'])->name('customer.order_accept');
        Route::get('orders/return/{invoice}', [App\Http\Controllers\Ecommerce\OrderController::class, 'returnForm'])->name('customer.order_return');
        Route::put('orders/return/{invoice}', [App\Http\Controllers\Ecommerce\OrderController::class, 'processReturn'])->name('customer.return');
    }); 
});

 Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

Route::prefix('owner')->group(function () {
    
    Route::middleware(['auth', 'owner'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\OwnerController::class, 'index'])->name('owner.home');
        Route::group(['prefix' => 'category'], function () {
            Route::get('/',[App\Http\Controllers\Blog\CategoryController::class, 'index'])->name('category');
            Route::post('/tambah',[App\Http\Controllers\Blog\CategoryController::class, 'store'])->name('category.add');
            Route::get('/edit/{id}',[App\Http\Controllers\Blog\CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{id}',[App\Http\Controllers\Blog\CategoryController::class, 'update'])->name('category.update');
            Route::get('/hapus/{id}',[App\Http\Controllers\Blog\CategoryController::class, 'destroy'])->name('category.delete');
        });

        Route::group(['prefix' => 'tags'], function () {
            Route::get('/',[App\Http\Controllers\Blog\TagsController::class, 'index'])->name('tags');
            Route::post('/tambah',[App\Http\Controllers\Blog\TagsController::class, 'store'])->name('add.tags');
            Route::get('/edit/{id}',[App\Http\Controllers\Blog\TagsController::class, 'edit'])->name('edit.tags');
            Route::post('/update/{id}',[App\Http\Controllers\Blog\TagsController::class, 'update'])->name('update.tags');
            Route::get('/hapus/{id}',[App\Http\Controllers\Blog\TagsController::class, 'destroy'])->name('delete.tags');
        });

        Route::group(['prefix' => 'post'], function () {
            Route::get('/',[App\Http\Controllers\Blog\PostController::class, 'index'])->name('post');
            Route::get('/tambah',[App\Http\Controllers\Blog\PostController::class, 'create'])->name('add.post');
            Route::get('/softdelete',[App\Http\Controllers\Blog\PostController::class, 'show'])->name('softdelete.post');
            Route::post('/tambah/store',[App\Http\Controllers\Blog\PostController::class, 'store'])->name('store.post');
            Route::get('/edit/{id}',[App\Http\Controllers\Blog\PostController::class, 'edit'])->name('edit.post');
            Route::post('/update/{id}',[App\Http\Controllers\Blog\PostController::class, 'update'])->name('update.post');
            Route::get('/hapus/{id}',[App\Http\Controllers\Blog\PostController::class, 'destroy'])->name('delete.post');
            Route::post('/images', [App\Http\Controllers\Blog\PostController::class, 'uploadImage'])->name('post.image');
            Route::get('/delete/{id}',[App\Http\Controllers\Blog\PostController::class, 'delete'])->name('deleted.post');
            Route::get('/restore/{id}',[App\Http\Controllers\Blog\PostController::class, 'restore'])->name('restore.post');
        });
    });
});