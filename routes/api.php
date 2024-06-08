<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//hardware api
Route::get('serial_number/{number}','HardwareApi\ApiController@GetSession');
Route::post('insert_parameter','HardwareApi\ApiController@CreateParameterLog');
Route::put('actuator_status/{serial_number}','HardwareApi\ApiController@ActuatorStatus');
Route::get('session_id/{id}','HardwareApi\ApiController@GetSessionID');
Route::get('required_parameters/{id}/{day_no}', 'HardwareApi\ApiController@getRequiredParameters');
//mobile Api
Route::post('login','MobileApi\MobileApiController@login');
Route::get('green_house/{customer_id}','MobileApi\MobileApiController@Greenhouse');
Route::get('session_details/{green_house_id}','MobileApi\MobileApiController@session');
Route::get('green_house_details/{green_house_id}','MobileApi\MobileApiController@GreenHouseCount');
Route::put('user_update/{user_id}','MobileApi\MobileApiController@Update');
Route::get('user_edit/{user_id}','MobileApi\MobileApiController@Edit');
Route::get('session_parameters/{session_id}','MobileApi\MobileApiController@CurrentParameters');
Route::put('password_update/{user_id}','MobileApi\MobileApiController@UpdatePassword');
Route::get('get_actuator_status/{green_house_id}','MobileApi\MobileApiController@GetActuatorStatus');
Route::put('session_active_inactive/{session_id}','MobileApi\MobileApiController@SessionStatus');
Route::get('average_senor_values','MobileApi\MobileApiController@AVGValues');
Route::get('total_days_of_session/{session_id}', 'MobileApi\MobileApiController@TotalDaysOfSession');
Route::get('required_parameters_against_session/{id}', 'MobileApi\MobileApiController@AVGValuesAgainstGreenhouse');
