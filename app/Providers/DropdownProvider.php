<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Auth;
class DropdownProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){

             $view->with('customer_array',\App\Models\User::role('Customer')->get());
            });
            view()->composer('*',function($view){

                $view->with('igh_array',DB::table('green_house')->where('is_deleted','=','0')->get());
               });
               view()->composer('*',function($view){

                $view->with('plant_array',DB::table('plant_info')->where('is_deleted','=','0')->get());
               });
               view()->composer('*',function($view){

                $view->with('parameter_array',DB::table('parameters')->where('is_deleted','=','0')->get());
               });
               view()->composer('*',function($view){

                $view->with('fertilizer_array',DB::table('fertilizer_info')->where('is_deleted','=','0')->get());
               });
                 view()->composer('*', function ($view) {


            if (\Auth::check()) {
                $view->with('customer_igh', \DB::table('green_house')->where('customer_id', \Auth::user()->id)->where('is_deleted', '=', '0')->get());
            } else {
                $view->with('customer_igh', null);
            }
        });
               
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
