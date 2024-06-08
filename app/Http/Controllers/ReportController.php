<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use DB;
use App\Models\ReportModel;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ReportController extends Controller
{
    public function index()
    {
       return view('Reports.index');
    }
    public function getdata()
    {
        $id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        $data = DB::select('SELECT
    p.session_id,
   CAST( AVG(p.current_temperature) AS decimal(5,1)) AS avg_temperature,
     CAST( AVG(p.current_humidity) AS decimal(5,1)) AS avg_humidity,
     CAST( AVG(p.currrent_soil_moisture) AS decimal(5,1)) AS avg_soil_moisture,
    DAY(p.date) AS day_no,
    pl.request_value AS required_value
FROM
    parameter_log p
    JOIN session s ON p.session_id = s.id
  	JOIN plant_parameter pl ON s.plant_id = pl.plant_id
GROUP BY
    p.session_id
ORDER BY day(p.date)');
        //dd($data);
        foreach ($data as $key) {
            $insert = ReportModel::create([
            'session_id' => $key->session_id,
            'average_temp' => $key->avg_temperature,
            'average_humidity' => $key->avg_humidity,
            'average_soil_moisture' => $key->avg_soil_moisture,
            'day_no' => $key->day_no,
            'created_at' => $date,
            'created_by' => $id
           
            ]);
        }
       
        $report = DB::select("SELECT r.*,s.plant_id,s.green_house_id,s.user_id,s.start_date,s.plant_age,s.status FROM report r JOIN session s ON s.id = r.session_id WHERE r.is_deleted = 0 ORDER BY r.id");
                return Datatables::of($report)->addColumn('action', function ($id) {

                    return '
                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->rawColumns(['action'])->make(true);
    }
    public function historyData($id)
    {
        $user_id = Auth::user()->id;
        $report = DB::select("SELECT
    p.session_id,
   CAST( AVG(p.current_temperature) AS decimal(5,1)) AS avg_temperature,
     CAST( AVG(p.current_humidity) AS decimal(5,1)) AS avg_humidity,
     CAST( AVG(p.currrent_soil_moisture) AS decimal(5,1)) AS avg_soil_moisture,
    DAY(p.date) AS day_no,
    pl.request_value AS required_value
FROM
    parameter_log p
    JOIN session s ON p.session_id = s.id
  	JOIN plant_parameter pl ON s.plant_id = pl.plant_id
    JOIN green_house g ON g.id = s.green_house_id
    WHERE g.id = ".$id." AND g.customer_id = ".$user_id."
GROUP BY
    p.session_id
ORDER BY day(p.date)");

    
            return view('history.index',compact('report'));
}
   
}
