<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStatus;
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

/** CLIENT CONFIRMATION  */
Route::get('/confirmation/{token}',[App\Http\Controllers\APIController::class,'api_client_email_confirmation']);


Auth::routes();
Route::get('logout', [App\Http\Controllers\UserController::class, 'logOut'])->name('logout');


/***********  check status active ***********/
Route::middleware([checkStatus::class])->group(function(){

    // DASHBOARD SECTION
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    // END DASHBOARD SECTION

    //order
    Route::get('/orders',[App\Http\Controllers\OrderController::class,'index'])->name('orders');
    Route::get('/orders/{id}',[App\Http\Controllers\OrderController::class,'show'])->name('orders.show');
    Route::get('/orders/accepted_by_driver/{id}',[App\Http\Controllers\OrderController::class,'accepted_by_driver'])->name('accepted_by_driver');
    Route::get('/orders/rejected_by_driver/{id}',[App\Http\Controllers\OrderController::class,'rejected_by_driver'])->name('rejected_by_driver');
    Route::post('/orders/prepared/{id}',[App\Http\Controllers\OrderController::class,'prepared'])->name('prepared');
    Route::get('/orders/delivered/{id}',[App\Http\Controllers\OrderController::class,'delivered'])->name('delivered');
    Route::get('/orders/invoice/{id}',[App\Http\Controllers\OrderController::class,'invoice'])->name('invoice');
    Route::get('/storeslocations', [App\Http\Controllers\StoreController::class, 'storeslocations'])->name('storeslocations');
    Route::get('/driversLocations', [App\Http\Controllers\UserController::class, 'driversLocations'])->name('driversLocations');


    //user driver??
    Route::get('/users/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('auth.edit');
    Route::put('/user/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('auth.update');
    Route::post('/users/password', [App\Http\Controllers\UserController::class, 'password'])->name('auth.password');

    //driver
    Route::get('/driver/{driver}/edit', [App\Http\Controllers\DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('/driver/{driver}/update', [App\Http\Controllers\DriverController::class, 'update'])->name('drivers.update');
    Route::put('/driver/{driver}/update_password', [App\Http\Controllers\DriverController::class, 'updatePassword'])->name('update.password');
    Route::put('/driver/working/{id}', [App\Http\Controllers\DriverController::class, 'workingStatus'])->name('driver.working');

    //notification
    Route::get('/notification', [App\Http\Controllers\HomeController::class, 'orderNotification'])->name('notification');
    Route::post('/driverLocation',[App\Http\Controllers\UserController::class, 'driverLocation'])->name('driverLocation');
    Route::get('/shifts_options', [App\Http\Controllers\ShiftController::class, 'shifts_options'])->name('shifts_options');
    Route::post('/shifts/save', [App\Http\Controllers\ShiftController::class, 'shifts_save'])->name('shifts_save');


    //support
    Route::get('/support/send', [App\Http\Controllers\UserController::class, 'support'])->name('support.create');

    //insert order image
    Route::put('/{order}/invoice_image/insert', [App\Http\Controllers\OrderController::class, 'insert_image'])->name('invoice.image');
    Route::get('/{order}/{pi}/invoice_image/delete', [App\Http\Controllers\OrderController::class, 'delete_image'])->name('invoice_image.delete');


    //reports
    Route::get('/reports', [App\Http\Controllers\DriverController::class, 'reports_index'])->name('reports.index');
});




/*******************midleware check activation account and user role********************/
Route::middleware([checkUser::class])->group(function(){


    // Shifts
    Route::get('/shifts', [App\Http\Controllers\ShiftController::class, 'index'])->name('shifts');
    Route::get('/shifts/create', [App\Http\Controllers\ShiftController::class, 'create'])->name('shifts.create');
    Route::post('/shifts/store', [App\Http\Controllers\ShiftController::class, 'store'])->name('shift.store');
    Route::get('/shifts/{shift}/edit', [App\Http\Controllers\ShiftController::class, 'edit'])->name('shift.edit');
    Route::put('/shifts/update', [App\Http\Controllers\ShiftController::class, 'update'])->name('shift.update');
    Route::get('/shifts/show', [App\Http\Controllers\ShiftController::class, 'show'])->name('shifts.show');



    //user
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('auth.index');
    Route::get('/users/create',[App\Http\Controllers\UserController::class,'create'])->name('auth.create');
    Route::post('/users/create',[App\Http\Controllers\UserController::class,'store'])->name('auth.store');

    Route::get('/user/{user}/activate', [App\Http\Controllers\UserController::class, 'activate'])->name('auth.activate');
    Route::put('/user/{user}/deactivate', [App\Http\Controllers\UserController::class, 'deactivate'])->name('auth.deactivate');


    //end user

    // NOTIFICATIONS
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/create', [App\Http\Controllers\NotificationController::class, 'store'])->name('notification.create');



    // FINANCES
    Route::match(array('GET', 'POST'),'/finances', [App\Http\Controllers\FinanceController::class, 'index'])->name('finances.index');
    Route::post('/finances/stats', [App\Http\Controllers\FinanceController::class, 'stats'])->name('finances.stats');


    // DRIVER SECTION

    Route::get('/drivers', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers.index');
    Route::get('/drivers/create', [App\Http\Controllers\DriverController::class, 'create'])->name('drivers.create');
    Route::post('/drivers/create', [App\Http\Controllers\DriverController::class, 'store'])->name('drivers.store');
    Route::get('/driver/{driver}/activate', [App\Http\Controllers\DriverController::class, 'activate'])->name('drivers.activate');
    Route::put('/driver/{driver}/deactivate', [App\Http\Controllers\DriverController::class, 'deactivate'])->name('drivers.deactivate');
    // END DRIVER SECTION

    // STORE_TYPE SECTION
    Route::get('/stores_types',[App\Http\Controllers\StoreTypeController::class,'index'])->name('store_types.index');
    Route::get('/store_type', [App\Http\Controllers\StoreTypeController::class, 'view'])->name('store_types.view');
    Route::get('/store_type/create', [App\Http\Controllers\StoreTypeController::class, 'create'])->name('store_type.create');
    Route::post('/store_type/store', [App\Http\Controllers\StoreTypeController::class, 'store'])->name('store_type.store');
    Route::post('/store_type/update', [App\Http\Controllers\StoreTypeController::class, 'update'])->name('store_type.update');
    Route::get('/store_type/edit/{id}', [App\Http\Controllers\StoreTypeController::class, 'edit'])->name('store_type.edit');
    Route::get('/store_type/delete/{id}', [App\Http\Controllers\StoreTypeController::class, 'destroy'])->name('store_type.delete');
    // END STORE_TYPE SECTION

    // CATEGORY SECTION

    Route::get('/{store}/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/select', [App\Http\Controllers\CategoryController::class, 'categories_select2'])->name('categories.select2');
    Route::post('/categories/store',[App\Http\Controllers\CategoryController::class,'store'])->name('categories.store');
    Route::post('/categories/store_multiple',[App\Http\Controllers\CategoryController::class,'store_multiple'])->name('categories.store_multiple');
    Route::put('/category/{category}/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::get('/reorder/{up}',[App\Http\Controllers\CategoryController::class,'reorderCategories'])->name('categories.reorder');
    // END CATEGORY SECTION

    // SUBCATEGORY SECTION
    Route::get('/{category}/subcategories', [App\Http\Controllers\SubcategoryController::class, 'index'])->name('subcategories.index');
    Route::post('/subcategories/select', [App\Http\Controllers\SubcategoryController::class, 'subcategories_select2'])->name('subcategories.select2');
    Route::post('/{category}/subcategories/store',[App\Http\Controllers\SubcategoryController::class,'store'])->name('subcategories.store');
    Route::post('/{category}/subcategories/store_multiple',[App\Http\Controllers\SubcategoryController::class,'store_multiple'])->name('subcategories.store_multiple');
    Route::put('/subcategories/{subcategory}/update', [App\Http\Controllers\SubcategoryController::class, 'update'])->name('subcategories.update');
    // END SUBCATEGORY SECTION

    // PRODUCTS SECTION
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'allproducts'])->name('products.allproducts');
    Route::get('/{subcategory}/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/{subcategory}/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'allcreate'])->name('products.allcreate');
    Route::post('/products/store',[App\Http\Controllers\ProductController::class,'store'])->name('products.store');
    Route::get('/product/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/product/{product}/update', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::get('/product/{product}/activate', [App\Http\Controllers\ProductController::class, 'activate'])->name('products.activate');
    Route::get('/all_product/{product}/activate', [App\Http\Controllers\ProductController::class, 'activate_all'])->name('products.activate_all');
    Route::put('/product/{product}/deactivate', [App\Http\Controllers\ProductController::class, 'deactivate'])->name('products.deactivate');
    Route::put('/all_product/{product}/deactivate', [App\Http\Controllers\ProductController::class, 'deactivate_all'])->name('products.deactivate_all');
    Route::get('/product/{product}/available', [App\Http\Controllers\ProductController::class, 'available'])->name('products.available');
    Route::get('/all_product/{product}/available', [App\Http\Controllers\ProductController::class, 'available_all'])->name('products.available_all');
    Route::put('/product/{product}/unavailable', [App\Http\Controllers\ProductController::class, 'unavailable'])->name('products.unavailable');
    Route::put('/all_product/{product}/unavailable', [App\Http\Controllers\ProductController::class, 'unavailable_all'])->name('products.unavailable_all');
    Route::post('/products/store_multiple',[App\Http\Controllers\ProductController::class,'store_multiple'])->name('products.store_multiple');
    Route::get('/products/stores/subcategory/{id}',[App\Http\Controllers\ProductController::class,'stores_subcategory'])->name('products.subcategory');
    Route::get('/products/stores/subcategory/category/{id}',[App\Http\Controllers\ProductController::class,'subcategory_categoty'])->name('products.subcategory.category');
    Route::get('/products/{product}/options',[App\Http\Controllers\OptionController::class,'index'])->name('products.options.index');
    Route::get('/products/{product}/options/create',[App\Http\Controllers\OptionController::class,'create'])->name('products.options.create');
    Route::post('/products/{product}/options/store',[App\Http\Controllers\OptionController::class,'store'])->name('products.options.store');
    Route::get('/options/{option}/edit',[App\Http\Controllers\OptionController::class,'edit'])->name('products.options.edit');
    Route::put('/options/{option}/update',[App\Http\Controllers\OptionController::class,'update'])->name('products.options.update');
    Route::get('/options/{option}/delete',[App\Http\Controllers\OptionController::class,'destroy'])->name('products.options.delete');
    Route::get('/products/{product}/variants/create',[App\Http\Controllers\OptionController::class,'variants_create'])->name('products.variants.create');
    Route::post('/products/{product}/variants/store',[App\Http\Controllers\OptionController::class,'variants_store'])->name('products.variants.store');
    Route::get('/variants/{variant}/edit',[App\Http\Controllers\OptionController::class,'variants_edit'])->name('products.variants.edit');
    Route::put('/variants/{variant}/update',[App\Http\Controllers\OptionController::class,'variants_update'])->name('products.variants.update');
    Route::get('/variants/{variant}/delete',[App\Http\Controllers\OptionController::class,'variants_destroy'])->name('products.variants.delete');




    //    Route::post('/product/upload', [App\Http\Controllers\ProductController::class, 'upload'])->name('products.upload');
    // END PRODUCTS SECTION

    // SUPERMARKET SECTION
//    Route::get('/supermarkets', [App\Http\Controllers\SupermarketController::class, 'index'])->name('supermarkets');
//    Route::get('/supermarkets/select', [App\Http\Controllers\SupermarketController::class, 'supermarkets_select2'])->name('supermarkets.select2');
//    Route::get('/supermarket/create', [App\Http\Controllers\SupermarketController::class, 'create'])->name('supermarket.create');
//    Route::post('/supermarket/store', [App\Http\Controllers\SupermarketController::class, 'store'])->name('supermarket.store');
//    Route::get('/supermarket/{supermarket}/show', [App\Http\Controllers\SupermarketController::class, 'show'])->name('supermarket.show');
//    Route::get('/supermarket/{supermarket}/edit', [App\Http\Controllers\SupermarketController::class, 'edit'])->name('supermarket.edit');
//    Route::put('/supermarket/{supermarket}/update', [App\Http\Controllers\SupermarketController::class, 'update'])->name('supermarket.update');
//    Route::put('/supermarket/{supermarket}/activate', [App\Http\Controllers\SupermarketController::class, 'activate'])->name('supermarket.activate');
//    Route::put('/supermarket/{supermarket}/deactivate', [App\Http\Controllers\SupermarketController::class, 'deactivate'])->name('supermarket.deactivate');
//    Route::post('/supermarket/{supermarket}/workingHours', [App\Http\Controllers\SupermarketController::class, 'workingHours'])->name('supermarket.workingHours');

    // stores
    Route::get('/stores',[App\Http\Controllers\StoreController::class,'index'])->name('stores');
    Route::get('/stores/select', [App\Http\Controllers\StoreController::class, 'stores_select2'])->name('stores.select2');
    Route::get('/store/create', [App\Http\Controllers\StoreController::class, 'create'])->name('store.create');
    Route::post('/store/store', [App\Http\Controllers\StoreController::class, 'store'])->name('store.store');
    Route::get('/store/{store}/show', [App\Http\Controllers\StoreController::class, 'show'])->name('store.show');
    Route::get('/store/{store}/edit', [App\Http\Controllers\StoreController::class, 'edit'])->name('store.edit');
    Route::put('/store/{store}/update', [App\Http\Controllers\StoreController::class, 'update'])->name('store.update');
    Route::put('/store/{store}/activate', [App\Http\Controllers\StoreController::class, 'activate'])->name('store.activate');
    Route::put('/store/{store}/deactivate', [App\Http\Controllers\StoreController::class, 'deactivate'])->name('store.deactivate');
    Route::post('/store/{store}/workingHours', [App\Http\Controllers\StoreController::class, 'workingHours'])->name('store.workingHours');
    Route::get('/get/rlocation/{store}',[App\Http\Controllers\StoreController::class,'getLocation'])->name('getLocation');
    Route::post('/updateres/delivery/{store}',[App\Http\Controllers\StoreController::class,'updateDeliveryArea'])->name('updateDeliveryArea');

    // END stores SECTION

    // REVIEWS SECTION
    Route::get('/reviews', [App\Http\Controllers\RatingController::class, 'index'])->name('reviews.index');
    // END REVIEWS SECTION


    // Clients
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{id}/{status}', [App\Http\Controllers\ClientController::class, 'updatestatus'])->name('clients.status');
    Route::get('/client/show/{id}', [App\Http\Controllers\ClientController::class, 'show'])->name('clients.show');

    // END Clients


    // Cities
    Route::get('/cities', [App\Http\Controllers\CityController::class, 'index'])->name('cities');
    Route::post('/cities/store', [App\Http\Controllers\CityController::class, 'store'])->name('cities.add');
    Route::get('/cities/edit/{id}', [App\Http\Controllers\CityController::class, 'edit'])->name('cities.edit');
    Route::get('/cities/{id}/{status}', [App\Http\Controllers\CityController::class, 'status'])->name('cities.status');
    Route::post('/cities/update', [App\Http\Controllers\CityController::class, 'updatecity'])->name('cities.update');

    // delivery_settings
    Route::get('/settings/delivery', [App\Http\Controllers\DeliverySettingController::class, 'index'])->name('settings.delivery');
    Route::get('/settings/delivery/create', [App\Http\Controllers\DeliverySettingController::class, 'create'])->name('settings.delivery.create');
    Route::post('/settings/delivery/store', [App\Http\Controllers\DeliverySettingController::class, 'store'])->name('settings.delivery.add');
    Route::get('/settings/delivery/edit/{id}', [App\Http\Controllers\DeliverySettingController::class, 'edit'])->name('settings.delivery.edit');
    Route::post('/settings/delivery/update', [App\Http\Controllers\DeliverySettingController::class, 'update'])->name('settings.delivery.update');
    Route::get('/settings/delivery/delete/{id}', [App\Http\Controllers\DeliverySettingController::class, 'destroy'])->name('settings.delivery.delete');

    // END delivery_settings 

    // Coupons
    Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('coupons');
    Route::post('/coupons/store', [App\Http\Controllers\CouponController::class, 'store'])->name('coupons.add');
    Route::get('/coupons/create', [App\Http\Controllers\CouponController::class, 'create'])->name('coupons.create');
    Route::get('/coupons/{id}/{status}', [App\Http\Controllers\CouponController::class, 'status'])->name('coupons.status');
    Route::get('/coupon/edit/{id}', [App\Http\Controllers\CouponController::class, 'edit'])->name('coupons.edit');
    Route::post('/coupon/update', [App\Http\Controllers\CouponController::class, 'update'])->name('coupons.update');
    // END Coupons

    // Settings
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
    Route::post('/settings/edit', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.edit');
    Route::post('/settings/edit/logo', [App\Http\Controllers\SettingController::class, 'update_logo'])->name('logo.edit');
    Route::post('/settings/edit/driver', [App\Http\Controllers\SettingController::class, 'update_driver'])->name('driver.edit');
    Route::post('/settings/edit/smtp', [App\Http\Controllers\SettingController::class, 'update_smtp'])->name('smtp.edit');
    // Route::get('/settings/cache', [App\Http\Controllers\SettingController::class, 'clear_cache'])->name('clear_cache');
    Route::get('clear-all-cache', function() {
  
        Artisan::call('cache:clear');
        return redirect()->route('settings')->withStatus(__('Successfully, you have cleared all cache of application.'));
    })->name('cache');
    //End Settings

    // ZONES
    Route::get('/zones', [App\Http\Controllers\ZoneController::class, 'index'])->name('zones');
    Route::get('/zones/create', [App\Http\Controllers\ZoneController::class, 'create'])->name('zones.create');
    Route::get('/zones/updat/{id}', [App\Http\Controllers\ZoneController::class, 'edit'])->name('zones.update');
    Route::post('/zone/add', [App\Http\Controllers\ZoneController::class, 'store'])->name('zone.add');

    Route::get('/get/zone/{zone}',[App\Http\Controllers\ZoneController::class,'getzone'])->name('getzone');
    Route::get('/get/zone/index',[App\Http\Controllers\ZoneController::class,'get_zone_index'])->name('getzoneindex');
    Route::post('/update/radius/zone/{zone}',[App\Http\Controllers\ZoneController::class,'update_radius_zone'])->name('updatezone');

    Route::post('/update/zone/{zone}',[App\Http\Controllers\ZoneController::class,'updatezone'])->name('update.zone');
    Route::get('/delete/zone/{id}',[App\Http\Controllers\ZoneController::class,'destroy'])->name('delete.zone');
    Route::post('/update/zone/name/{zone}',[App\Http\Controllers\ZoneController::class,'update_name'])->name('zone.name');
    // END ZONES


    //orders
    Route::get('/orders/accepted_by_admin/{id}',[App\Http\Controllers\OrderController::class,'accepted_by_admin'])->name('accepted_by_admin');
    Route::get('/orders/rejected_by_admin/{id}',[App\Http\Controllers\OrderController::class,'rejected_by_admin'])->name('rejected_by_admin');
    Route::get('/orders/asign_driver/{id}',[App\Http\Controllers\OrderController::class,'asign_driver'])->name('asign_driver');
    Route::get('/orders/driver/refresh',[App\Http\Controllers\OrderController::class,'refresh'])->name('driver.refresh');
    Route::get('/order/refund',[App\Http\Controllers\OrderController::class,'refunds'])->name('refund_orders');

    //live order
    Route::get('/liveorders',[App\Http\Controllers\OrderController::class,'live'])->name('live_orders');
    Route::get('/order/liveapi',[App\Http\Controllers\OrderController::class,'liveapi'])->name('get_live_orders');
    Route::get('/order/accept/{order}',[App\Http\Controllers\OrderController::class,'accept'])->name('accept_order');
    Route::get('/order/reject/{order}',[App\Http\Controllers\OrderController::class,'reject'])->name('reject_order');


    //end orders




});/********* End role check and actiovation acount *********/
