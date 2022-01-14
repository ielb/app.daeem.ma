<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\APIController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register_user',[APIController::class,'create_user']);



Route::group(['middleware' => ['auth:sanctum']], function () {


    /** ============================ API REQUESTS =============================================*/
    /** GET ALL STORES */
    Route::post('/stores',[APIController::class,'api_get_all_stores_nearby']);
    /** GET ALL SUPERMARKETS */
    Route::get('/stores/{offset}/{limit}',[APIController::class,'api_get_all_stores']);
    /** GET SUPERMARKET BY ID */
    Route::get('/store/{id}',[APIController::class,'api_get_store']);
    /** SEARCH SUPERMARKETS BY NAME */
    Route::get('/stores/{name}',[APIController::class,'api_search_stores']);
    /** GET SUPERMARKET HOURS */
    Route::get('/store/{id}/hours',[APIController::class,'api_get_store_hours']);
    /** GET SUPERMARKET RATING */
    Route::get('/store/{id}/rating',[APIController::class,'api_get_store_rating']);
    /** SET SUPERMARKET RATING */
    Route::post('/store/rating',[APIController::class,'api_set_store_rating']);
    /** GET SUPERMARKET CATEGORIES */
    Route::get('/store/{id}/categories',[APIController::class,'api_get_store_categories']);
    /** GET SUPERMARKET SUBCATEGORIES */
    Route::get('/category/{id}/subcategories',[APIController::class,'api_get_store_subcategories']);
    /** GET SUPERMARKET PRODUCTS */
    Route::get('/subcategory/{id}/products',[APIController::class,'api_get_store_products']);
    /** GET CITY BY ID */
    Route::get('/city/{id}',[APIController::class,'api_get_city']);
    /** GET PRODUCT BY ID */
    Route::get('/products/{id}',[APIController::class,'api_get_product']);
    /** GET PRODUCT BY ID */
    Route::get('/products/{id}',[APIController::class,'api_get_product']);
    /** CLIENT LOGIN */
    Route::post('/login',[APIController::class,'api_login']);
    /** CLIENT REGISTER */
    Route::post('/register',[APIController::class,'api_register']);
    /** CLIENT LOGIN GOOGLE */
    Route::post('/login_google',[APIController::class,'api_login_by_google']);
    /** CLIENT LOGIN FACEBOOK */
    Route::post('/login_facebook',[APIController::class,'api_login_by_facebook']);

    /** CLIENT LOGIN BY  FACEBOOK  OR GOOGLE*/
    Route::post('/login_client',[APIController::class,'api_login_by_social']);

    /** CLIENT REGISTER BY  FACEBOOK  OR GOOGLE*/
    Route::post('/register_client',[APIController::class,'api_register_by_social']);

    /** CLIENT REGISTER BY  FACEBOOK */
    Route::post('/register_facebook',[APIController::class,'api_register_by_facebook']);
    /** CLIENT REGISTER BY  GOOGLE */
    Route::post('/register_google',[APIController::class,'api_register_by_google']);


    /** RESET CLIENT PASSWORD REQUEST */
    Route::post('/reset_password_request',[APIController::class,'api_reset_client_password_request']);
    /** RESET PASSWORD */
    Route::post('/reset_password',[APIController::class,'api_reset_client_password']);
    /** EDIT CLIENT INFO (NAME , EMAIL , ADDRESS ) */
    Route::post('/edit_client_info',[APIController::class,'api_edit_client_info']);
    /** GET CLIENT BY ID */
    Route::get('/client/{id}',[APIController::class,'api_get_client_by_id']);
    /** SEARCH CATEGORY */
    Route::get('/categories/{category}',[APIController::class,'api_search_categories']);
    /** SEARCH SUB CATEGORY */
    Route::get('/subcategories/{subcategory}',[APIController::class,'api_search_subcategories']);
    /** SEARCH PRODUCT */
    Route::get('/products/search/{product}',[APIController::class,'api_search_product']);
    /** VALIDATE COUPON */
    Route::get('/coupon/{value}',[APIController::class,'api_check_coupon']);
    /**  INSERT ORDER */
    Route::post('/order',[APIController::class,'api_insert_order']);
    /**  GET CLIENT ADDRESS */
    Route::get('/client/{client}/address',[APIController::class,'api_get_client_address']);
    /**  SET CLIENT ADDRESS */
    Route::post('/client/address',[APIController::class,'api_set_client_address']);
    /**  GET DELIVERY SETTING */
    Route::get('/delivery_setting',[APIController::class,'api_get_delivery_setting']);
    /**  GET DELIVERY SETTING */
    Route::get('/delivery_setting',[APIController::class,'api_get_delivery_setting']);
   /**  GET ORDER STATUS SETTING */
    Route::get('/order/{order}/statuses',[APIController::class,'api_get_order_statuses']);
    /**  SET CLIENT PHONE */
    Route::post('/client/phone',[APIController::class,'api_set_client_phone']);
    /**  SET CLIENT TOKEN */
    Route::post('/client/token',[APIController::class,'api_set_client_token']);
    /** CHANGE CLIENT PASSWORD */
    Route::post('/client/password',[APIController::class,'api_change_client_password']);
    /** REFUND ORDERS */
    Route::post('/order/refund',[APIController::class,'api_refund_order']);
    /** GET ALL STORES TYPES */
    Route::get('/stores_types',[APIController::class,'api_get_stores_types']);

    /** GET PRODUCT VARIANTS */
    Route::get('/product/{product}',[APIController::class,'api_get_product_variants']);

    /** GET CLIENT ORDERS */
    Route::get('/client/{client}/orders',[APIController::class,'api_get_client_orders']);

    /** GET CLIENT ORDERS */
    Route::post('/stores_by_type',[APIController::class,'api_get_all_stores_nearby_by_type']);

    /** CHECK CLIENT EMAIL  */
    Route::post('/client/check_email',[APIController::class,'api_check_client_email']);

});
