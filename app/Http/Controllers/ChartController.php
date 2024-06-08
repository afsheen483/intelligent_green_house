<?php

namespace App\Http\Controllers;

use App\Models\SaleModel;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
class ChartController extends Controller
{

    public function index()
    {
        $id = Auth::user()->id;
        // $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        // ->whereYear('created_at', date('Y'))
        //     ->groupBy(DB::raw("Month(created_at)"))
        //     ->pluck('count', 'month_name');
        $users = DB::select("SELECT
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
    JOIN green_house g ON s.green_house_id = g.id
WHERE g.customer_id = ".$id."
GROUP BY
    p.session_id
ORDER BY day(p.date)");
        //dd($data);
        $required_value = $users[0]->required_value;
        $data = $users[0];
//dd($data);
        //return view('website.home', compact('required_value', 'data'));
    }
}
