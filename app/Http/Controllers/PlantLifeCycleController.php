<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantInfoModel;
use App\Models\PlantFerModel;
use App\Models\FertilizerSceduleModel;
use App\Models\PlantParameterModel;
use Auth;
Use DB;
class PlantLifeCycleController extends Controller
{
    public function Insert(Request $request){
    
        $plant_name = $request->plant_name;
        $plant_life_duration = $request->plant_life_duration;
        $plant_description = $request->plant_description;
        $range_from = $request->range_from;
        $range_to = $request->range_to;
        $request_value = $request->request_value;
        $threshold = $request->threshold;
        $parameter_id = $request->parameter_id;
        $id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        //$merge_array = array_merge($parameter_id,$range_from,$range_to,$request_value,$threshold);
        //dd($merge_array);
        $plant_id = PlantInfoModel::create([
            'plant_name' => $request->plant_name,
            'plant_description'=> $request->plant_description,
            'plant_life_duration' => $request->plant_life_duration,
            'user_id'=>$id,
            'created_at' => $date,
            'created_by' => $id
        ])->id;
        
            $input = $request->all();
           // dd(count($input['parameter_id']));
            for($i = 0; $i < count($input['parameter_id']); $i++) {

                    $data = [ 
                        'plant_id' => $plant_id,
                        'parameter_id' => $input['parameter_id'][$i],
                        'range_from' => $input['range_from'][$i], 
                        'range_to' => $input['range_to'][$i], 
                        'request_value' => $input['request_value'][$i],
                        'threshold' => $input['threshold'][$i],
                        'created_at' => $date,
                        'created_by' => $id
                    ];

                    PlantParameterModel::create($data);
}

                        $plant_fertilizer_id = PlantFerModel::create([
                            'plant_id' => $plant_id,
                            'fertilizer_id'=>$request->fertilizer_id,
                            'quantity'=>$request->quantity,
                            'time_duration'=>$request->time_duration,
                            'created_at' => $date,
                            'created_by' => $id
                        ])->id;
                       $insert = FertilizerSceduleModel::create([
                        'plant_fertilizer_id' => $plant_fertilizer_id,
                            'day_no' => $request->day_no,
                            'user_id' => $id,
                            'created_at' => $date,
                            'created_by' => $id
                        ]);
                        if ($insert) {
                            return back()->with('success','Data inserted successfully!');

                        }else{
                            return back()->with('error','Ooppsss, Something went wrong!');

                        }



       

    }
    public function ViewPlantLifeCycle($id)
    {
        $plant_info = DB::select("SELECT
                    p.id,
                    p.plant_name,
                    p.plant_description,
                    p.plant_life_duration
                FROM
                    green_house g
                JOIN plant_info p ON
                    p.user_id = g.customer_id
                WHERE
                    g.customer_id = ".$id." AND p.is_deleted = 0
                ORDER BY
                    p.id
                DESC
                    ");
        $parameters = DB::select("SELECT
                i.plant_name,
                pr.range_from,
                pr.range_to,
                pr.request_value,
                pr.threshold,
                p.parameter_name,
                p.id
            FROM
                plant_info i
            JOIN plant_parameter pr ON
                i.id = pr.plant_id
            JOIN parameters p ON
                p.id = pr.parameter_id
            WHERE
                i.user_id = ".$id." AND i.is_deleted = 0
              ORDER BY
                        pr.id
                    DESC ");
        $fertilizer = DB::select("SELECT
                            i.id,
                            i.fertilizer_name,
                            f.quantity,
                            f.time_duration
                        FROM
                            fertilizer_info i
                        JOIN plant_fertilizer f ON
                            f.fertilizer_id = i.id
                        WHERE
                            i.user_id = ".$id." AND i.is_deleted = 0
                        ORDER BY
                            i.id
                        DESC
                            
                        ");
            $fertilizer_details = DB::select("SELECT
                    i.fertilizer_name,
                    f.quantity,
                    f.time_duration,
                    s.day_no,
                    i.id AS fertilizer_id,
                    s.plant_fertilizer_id as id
                FROM
                    fertilizer_info i
                JOIN plant_fertilizer f ON
                    f.fertilizer_id = fertilizer_id
                JOIN fertilizer_schedule s ON s.plant_fertilizer_id = f.fertilizer_id
                WHERE 
                    i.user_id = ".$id." AND s.is_deleted = 0
                ORDER BY
                    s.id
                DESC
    
                    ");
                    return view('customer.view_plant_life',compact('plant_info', 'parameters', 'fertilizer', 'fertilizer_details'));
        
        //dd($fertilizer_details);
    }
}
