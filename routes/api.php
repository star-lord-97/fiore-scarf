<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YouMightAlsoLikeController;
use Illuminate\Support\Facades\Route;

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

/*
| add reset password
| add email verification
| add search
| add user dashboard
| make checkouts send emails
| configure info@fiore-scarf.com
| configure mailchimp
*/

/* home routes */
// returns the latest 3 products for the home page
Route::get('/home', [HomeController::class, 'index']);



/* shop routes */
// return a specific product's data
Route::get('/products/{product:code}', [ShopController::class, 'show']);



/* you might also like routes */
// invokable controller returns 3 random products for the you might also like section
Route::get('/you_might_also_like/{product:code}', YouMightAlsoLikeController::class);



/* login/register routes */
// login a user and return an access token or an error message
Route::post('/login', [LoginController::class, 'login']);
// submit a new user to the database and return 200 status code or an error message
Route::post('/register', RegisterController::class);



// return all categories names
Route::get('/categories', [CategoryController::class, 'index']);
// return a specific category's products
Route::get('/categories/{category}', [CategoryController::class, 'show']);
// return a specific category's products sorted
Route::get('/categories/{category}/sort/{method}', [CategoryController::class, 'sort']);



// subscribe to newsletter
Route::post('/newsletter', [NewsletterController::class, 'store']);



Route::middleware('auth:api')->group(function () {
    /* logout route */
    // logout a user and return nothing
    Route::post('/logout', [LoginController::class, 'logout']);



    // return the authenticated user's data after validating the personal access token (-----AUTHENTICATED USER-----)
    Route::get('/user', [UserController::class, 'show']);



    // return the authenticated user's data after validating the personal access token (-----AUTHENTICATED USER-----)
    Route::put('/user', [UserController::class, 'update']);



    /* promo codes routes */
    // return specific promo code
    Route::get('/promo-codes/{promo_code:code}', [PromoCodeController::class, 'show']);



    /* checkout routes */
    // checkout
    Route::post('/checkout', [OrderController::class, 'store']);
});



Route::middleware('api.admin')->group(function () {
    /* home admin routes */
    // update home video
    Route::post('/home', [HomeController::class, 'update']);



    /* users admin routes */
    // export all users as xlsx
    Route::get('/users/export', [UserController::class, 'export']);
    // get all users
    Route::get('/users', [UserController::class, 'index']);



    /* admins admin routes */
    // get all admins
    Route::get('/admins', [AdminController::class, 'index']);
    // convert someone to an admin
    Route::post('/admins/{user:email}', [AdminController::class, 'store']);
    // remove someone from admins
    Route::delete('/admins/{user:id}', [AdminController::class, 'destroy']);



    /* promo-codes admin routes */
    // get all promo-codes
    Route::get('/promo-codes', [PromoCodeController::class, 'index']);
    // create a new promocode
    Route::post('/promo-codes', [PromoCodeController::class, 'store']);
    // remove a promocode
    Route::delete('/promo-codes/{promo_code:code}', [PromoCodeController::class, 'destroy']);



    /* products admin routes */
    // get all products
    Route::get('/products', [ShopController::class, 'index']);
    // create a new product
    Route::post('/products', [ShopController::class, 'store']);
    // update product
    Route::patch('/products/{product:code}', [ShopController::class, 'update']);
    // remove a product
    Route::delete('/products/{product:code}', [ShopController::class, 'destroy']);

    /* orders admin routes */
    // get all orders
    Route::get('/orders', [OrderController::class, 'index']);
    // update an order
    Route::patch('/orders/{order:id}', [OrderController::class, 'update']);
});
