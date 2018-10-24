<?php

use App\Discount;
use App\Month;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('contracts', 'API\ContractController');
// Route::apiResource('employees' , 'API\EmployeeController');
Route::get('payrolls', 'API\PayrollController@index');
Route::get('discounts', function () {
    return Discount::orderBy('id')->get();
});
Route::get('months', function () {
    return Month::orderBy('id')->get();
});
