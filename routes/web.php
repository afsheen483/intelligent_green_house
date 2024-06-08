<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ChartController;

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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('permissions',function()
{
    return view('admin.permissions.index');
});
Route::get('roles',function()
{
    return view('admin.roles.index');
});

Route::get('user_create/{id}',function()
{
    return view('admin.users.create');
});

//routes for greenhouse crud

Route::get('/greenhouse','GreenhouseController@index')->name('greenhouse')->middleware('auth');
Route::get('/greenhouse/getdata','GreenhouseController@getdata')->name('greenhouse.getdata')->middleware('auth');
Route::get('greenhouse_form/{id}','GreenhouseController@create')->middleware('auth');
Route::post('greenhouse_store','GreenhouseController@store')->middleware('auth');
Route::PUT('greenhouse_update/{id}','GreenhouseController@update')->middleware('auth');
Route::put('greenhouse_delete/{id}','GreenhouseController@destroy')->middleware('auth');

// inventory
Route::get('/inventory','GreenhouseController@index')->name('inventory')->middleware('auth');
Route::get('inventory/inventorydata','GreenhouseController@inventorydata')->name('inventory.inventorydata')->middleware('auth');

// sales
Route::get('/sale','SaleController@index')->name('sale')->middleware('auth');
Route::get('sale/saledata','SaleController@saledata')->name('sale.saledata')->middleware('auth');
Route::get('/sale_form/{id}','SaleController@create')->middleware('auth');
Route::post('sale_store','SaleController@store')->middleware('auth');
Route::put('sale_update/{id}','SaleController@update')->middleware('auth');
Route::put('sale_delete/{id}','SaleController@destroy')->middleware('auth');


// balance sheet and ledger route
Route::get('/balance_sheet','PaymentController@index')->name('balance_sheet')->middleware('auth');
Route::get('balance_sheet/balancedata','PaymentController@balancedata')->name('balance_sheet.balancedata')->middleware('auth');
Route::post('/customer_ledger','PaymentController@store')->middleware('auth');
Route::get('balance_search_by_date/search','PaymentController@search')->name('balance_sheet.search')->middleware('auth');

// Route::get('/ledger','PaymentController@index')->name('ledger');
// Route::get('ledger/getdata','PaymentController@getdata')->name('ledger.getdata');




// Customer request route
Route::get('/customer_request','RequestController@index')->name('customer_request')->middleware('auth');
Route::get('customer_request/getdata','RequestController@getdata')->name('customer_request.getdata')->middleware('auth');

// report route


Route::get('/reports','ReportController@index')->name('reports')->middleware('auth');
Route::get('reports/getdata','ReportController@getdata')->name('reports.getdata')->middleware('auth');

// parameter log routes
Route::get('/parameter_log','ParameterLogController@index')->name('parameter_log')->middleware('auth');
Route::get('parameter_log/getdata','ParameterLogController@getdata')->name('parameter_log.getdata')->middleware('auth');


// session route
Route::get('/sessions','SessionController@index')->name('sessions')->middleware('auth');
Route::get('sessions/getdata','SessionController@getdata')->name('sessions.getdata')->middleware('auth');
Route::get('session_form/{id}','SessionController@create')->middleware('auth');
Route::post('session_store','SessionController@store')->middleware('auth');
Route::PUT('session_update/{id}','SessionController@update')->middleware('auth');
Route::put('session_delete/{id}','SessionController@destroy')->middleware('auth');
Route::put('session_status_update/{id}','SessionController@UpdateStatus');

// maintain route
Route::get('/maintainance','MaintainController@index')->name('maintainance')->middleware('auth');
Route::get('maintainance/getdata','MaintainController@getdata')->name('maintainance.getdata')->middleware('auth');
Route::get('maintainance_form/{id}','MaintainController@create')->middleware('auth');
Route::post('maintainance_store','MaintainController@store')->middleware('auth');
Route::PUT('maintainance_update/{id}','MaintainController@update')->middleware('auth');
Route::put('maintainance_delete/{id}','MaintainController@destroy')->middleware('auth');


// users route
Route::resource('users', 'UserController')->middleware('auth');
Route::get('user','UserController@index')->name('user')->middleware('auth');
Route::get('user/getdata','UserController@getdata')->name('user.getdata')->middleware('auth');
Route::get('/users_edit/{id}', 'UserController@edit')->middleware('auth');
Route::delete('/user_delete/{delete_id}','UserController@destroy')->middleware('auth');
// Route for check email
Route::post('user/checkemail', 'UserController@userEmailCheck')->middleware('auth');
Route::post('edit/checkemail', 'UserController@editEmailCheck')->middleware('auth');



// role route
Route::resource('roles', 'RoleController')->middleware('auth');
Route::get('/roles_edit/{id}', 'RoleController@edit')->middleware('auth');

// permission route
Route::resource('permissions', 'PermissionController')->middleware('auth');
Route::get('/permission_edit/{id}', 'PermissionController@edit')->middleware('auth');


// profile
Route::get('/profile','ProfileSettings@profile')->middleware('auth');
Route::get('/change_password',function(){
    return view('ProfileSettings.change_password');
})->middleware('auth');
Route::put('/change_password','ProfileSettings@ChangePassword')->middleware('auth');


// login and authentication
Route::get('/dashboard', function () {
    if (Auth::check()) {
        return view('admin.dashboard');
    }
    return view('newlogin');
})->name('login');
Route::get('/login', function () {
    if (Auth::check()) {
        return view('admin.dashboard');
    }
    return view('newlogin');
})->name('login');

Route::get('dashboard',function(){
    return view('admin.dashboard');
});

Route::post('/login_customer','ProfileSettings@LoginAndExpire')->middleware('auth');

// expense route
Route::get('expense','ExpenseController@index')->name('expense')->middleware('auth');
Route::get('expense/getdata','ExpenseController@getdata')->name('expense.getdata')->middleware('auth');
Route::post('expense_insert','ExpenseController@store')->middleware('auth');
Route::get('expense_edit/{id}','ExpenseController@create')->middleware('auth');
Route::put('expense_update/{id}','ExpenseController@update')->middleware('auth');
Route::put('expense_delete/{id}','ExpenseController@destroy')->middleware('auth');
Route::get('expense_search_by_date/search','ExpenseController@search')->name('expense.search')->middleware('auth'); 




// routes for customer login module
Route::get('customer_home/{id}',function(){
   
     return view('website.home');
})->middleware('auth');


// customer module
Route::get('customers','CustomerController@index')->name('customers')->middleware('auth');
Route::get('customers/getdata','CustomerController@getdata')->name('customers.getdata')->middleware('auth');

// transaction save
Route::post('save_transaction','PaymentController@SaveTransaction')->middleware('auth');


// customer's website

Route::get('/',function(){
    return view('customer.dashboard');
});
Route::get('/demo',function(){
    return view('customer.demo');
})->middleware('auth');
Route::get('/about',function(){
    return view('customer.about');
});
Route::get('/contact',function(){
    return view('customer.contact');
});

Route::get('/request',function(){
    return view('customer.request');
});

// Request for new igh
Route::post('request_save','RequestController@store')->middleware('auth');;

// route for plant basic info
Route::get('plant_basic_info','PlantInfoController@index')->name('plant_basic_info')->middleware('auth');
Route::get('plant_basic_info/getdata','PlantInfoController@getdata')->name('plant_basic_info.getdata')->middleware('auth');
Route::get('plantinfo_form/{id}','PlantInfoController@create')->middleware('auth');
Route::post('plantinfo_store','PlantInfoController@store')->middleware('auth');
Route::PUT('plantinfo_update/{id}','PlantInfoController@update')->middleware('auth');
Route::put('plantinfo_delete/{id}','PlantInfoController@destroy')->middleware('auth');


// route for plant parameter

Route::get('plant_parameter','PlantParameterController@index')->name('plant_parameter')->middleware('auth');
Route::get('plant_parameter/getdata','PlantParameterController@getdata')->name('plant_parameter.getdata')->middleware('auth');
Route::get('plantpara_form/{id}','PlantParameterController@create')->middleware('auth');
Route::post('plantpara_store','PlantParameterController@store')->middleware('auth');
Route::PUT('plantpara_update/{id}','PlantParameterController@update')->middleware('auth');
Route::put('plantpara_delete/{id}','PlantParameterController@destroy')->middleware('auth');



// route for fertilizer

Route::get('fertilizer','FertilizerController@index')->name('fertilizer')->middleware('auth');
Route::get('fertilizer/getdata','FertilizerController@getdata')->name('fertilizer.getdata')->middleware('auth');
Route::get('fertilizer_form/{id}','FertilizerController@create')->middleware('auth');
Route::post('fertilizer_store','FertilizerController@store')->middleware('auth');
Route::PUT('fertilizer_update/{id}','FertilizerController@update')->middleware('auth');
Route::put('fertilizer_delete/{id}','FertilizerController@destroy')->middleware('auth');


// route for plant fertilizer

Route::get('plant_fertilizer','PlantFerController@index')->name('plant_fertilizer')->middleware('auth');
Route::get('plant_fertilizer/getdata','PlantFerController@getdata')->name('plant_fertilizer.getdata')->middleware('auth');
Route::get('plant_fertilizer_form/{id}','PlantFerController@create')->middleware('auth');
Route::post('plant_fertilizer_store','PlantFerController@store')->middleware('auth');
Route::PUT('plant_fertilizer_update/{id}','PlantFerController@update')->middleware('auth');
Route::put('plant_fertilizer_delete/{id}','PlantFerController@destroy')->middleware('auth');


//routes for plant lifecycle
Route::get('/life_cycle',function(){
    return view('customer.plant_life_cycle');
})->middleware('auth');
Route::post('insert_plant_lifecycle','PlantLifeCycleController@Insert')->middleware('auth');


// Route::get('test',function(){
//     return view('dashboard');
// });
// Route::get('customer_home/{id}', [ChartController::class, 'index']);


// customer website routes
Route::get('plant_details/{id}','CustomerController@show')->middleware('auth');
Route::put('fan_status/{id}','CustomerController@fanupdate')->middleware('auth');
Route::put('motor_status/{id}', 'CustomerController@motorupdate')->middleware('auth');
Route::put('heater_status/{id}', 'CustomerController@heaterupdate')->middleware('auth');
Route::put('session_status/{id}', 'CustomerController@lightupdate')->middleware('auth');
Route::get('/view_plantlife/{id}', 'PlantLifeCycleController@ViewPlantLifeCycle')->middleware('auth');
Route::put('plant_fertilizer_schedule_delete/{id}','FertilizerController@destroy');
Route::get('fertilizer_schedule/{id}','FertilizerController@GetDataSchedule');
Route::put('plantfertilizer_schedule_update/{id}','FertilizerController@FertilizerUpdate');
Route::get('igh_history/{id}','ReportController@historyData');