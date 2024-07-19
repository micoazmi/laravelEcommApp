<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('items',ItemController::class);
Route::post('addToCart',[OrderController::class,'addToCart']);
Route::get('orders', [OrderController::class, 'getAll']);
Route::delete('/orders/{id}',[OrderController::class,'deleteOrder']);
Route::get('/orderWithItem',[OrderController::class,'gerOrdersWithItem']);

Route::post('/invoices',[InvoiceController::class,'store']);
Route::get('/invoiceNew',[InvoiceController::class,'index']);
Route::get('/invoices/{id}',[InvoiceController::class,'show']);

