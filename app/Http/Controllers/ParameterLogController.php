<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use DB;
class ParameterLogController extends Controller
{
    public function index()
    {
       return view('ParameterLog.index');
    }
    public function getdata()
    {
        $report = DB::select("SELECT
                    p.*,
                    s.plant_id,
                    s.green_house_id,
                    s.user_id,
                    s.start_date,
                    s.plant_age,
                    s.status
                FROM
                    parameter_log p
                JOIN session s ON
                    s.id = p.session_id
                WHERE
                s.is_deleted = 0
                ORDER BY
                    p.id
                    DESC");
        //dd($report);
                return Datatables::of($report)->addColumn('action', function ($id) {
                    
                    return '
                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->rawColumns(['action'])->make(true); 
    }
   
}
