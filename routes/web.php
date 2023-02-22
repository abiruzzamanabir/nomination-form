<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NominationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;

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

Route::resource('/form', NominationController::class);
Route::get('/form/hosted/{ukey?}', [NominationController::class, 'hosted'])->name('form.hosted');
Route::resource('/dashboard', DashboardController::class);
Route::post('/dashboard/payment', [DashboardController::class, 'makePayment'])->name('dashboard.payment');
Route::get('/trash', [DashboardController::class, 'trash'])->name('trash.index');
Route::get('/status-update/{id}', [DashboardController::class, 'updateStatus'])->name('status.update');
Route::get('/payment-status-update/{id}', [DashboardController::class, 'updatePV'])->name('payment.status.update');
Route::get('/trash-update/{id}', [DashboardController::class, 'updateTrash'])->name('trash.update');
Route::get('/comment-empty/{id}', [DashboardController::class, 'commentEmpty'])->name('comment.empty');


// SSLCOMMERZ Start
Route::get('/easycheckout', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/hostedcheckout', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

