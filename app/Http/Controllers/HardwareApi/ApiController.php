<?php

namespace App\Http\Controllers\HardwareApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\ParameterLogModel;
use App\Models\GreenhouseModel;
use App\Models\SessionModel;
use phpDocumentor\Reflection\Types\Null_;

class ApiController extends Controller
{
    public function GetSession($serial_number)
    {
        $id_found = DB::select("SELECT
        g.*
    FROM
        green_house g
    WHERE
        g.serial_number = ".$serial_number."");
        //dd($id_found);
         if ($id_found) {
        $current =  Carbon::now()->toDateString();
        //return $current;
        $current_date = date('Y-m-d');
        $data = DB::select("SELECT
        g.id as plant_id,
        s.id as session_id,
        s.start_date
    FROM
        green_house g
    JOIN session s ON
        s.green_house_id = g.id
    WHERE
        g.serial_number = ".$serial_number."
        AND s.status = 1");
        //dd($data);

       if($data){
            $start_date = $data[0]->start_date;

        $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $start_date);
        $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $current);
        $different_days = $start_date->diffInDays($end_date);
        $session_id = (int)$data[0]->session_id;
        $plant_id = (int)$data[0]->plant_id;
        return response()->json(["session_id" => $session_id ,"day_no" => $different_days+1,"plant_id"=> $plant_id]);


       }else{
            return response()->json(["session_id" => 0, "day_no" => 0, "plant_id" => 0]);
        }
         } else {
            return response()->json(["session_id" => 0, "day_no" => 0, "plant_id" => 0]);
        }
    }

    public function CreateParameterLog(Request $request)
    {
        //return $request->all();
        $data = ParameterLogModel::create([
            'session_id' => $request->session_id,
            'current_temperature' => $request->current_temperature,
            'current_humidity' => $request->current_humidity,
            'currrent_soil_moisture' => $request->currrent_soil_moisture,
            'date' => date('Y-m-d'),
        ]);
        if ($data) {
            return response()->json("data has been inserted successfully!", 200);
        }
        else{
                return response()->json("something wrong");
            }
        
    //     if(isset($_GET['current_temperature']) && isset($_GET['current_humidity']) && isset($_GET['currrent_soil_moisture'])){
    //         $current_temperature = $_GET['current_temperature'];
    //         $current_date = date('Y-m-d');
    //         $current_humidity = $_GET['current_humidity'];
    //         $currrent_soil_moisture = $_GET['currrent_soil_moisture'];
    //         $session_id = $_GET['session_id'];
    //         //$qr = DB::insert("INSERT INTO `parameter_log`(`session_id`,`current_temperature`, `current_humidity`, `currrent_soil_moisture`,`date`) VALUES ('$session_id','$current_temperature','$current_humidity','$currrent_soil_moisture','$current_date')");
    //         //$result_qr = mysqli_query($conn,$qr);
    //         $qr  = ParameterLogModel::create([
    //             'session_id' => $session_id,
    //             'current_temperature' => $current_temperature,
    //             'current_humidity' => $current_humidity,
    //             'currrent_soil_moisture' => $currrent_soil_moisture,
    //             'date' => $current_date
    //         ]);
    //         if($qr){
    //             return response()->json("Successfylly added");
    //         }else{
    //             return response()->json("something wrong");
    //         }
    // }
}
    public function ActuatorStatus(Request $request,$serial_number)
    {
        
       $data = GreenhouseModel::where("serial_number",$serial_number)->get();
       //return $data;
       if ($data) {
           $fan_status = $request->fan_status;
           $motor_status = $request->motor_status;
           $light_status = $request->sun_light_status;
           $heater_status = $request->heater_status;
           if ($fan_status == Null) {
                $fan_status = 0;
                
           }
           if ($motor_status == NULL) {
                $motor_status = 0;
               
           }
           if ($heater_status == NULL) {
                $heater_status = 0;
           }
           if ($light_status == NULL ) {
                $light_status = 0;
               
           }
           if ($fan_status <=1 || $motor_status <=1 || $light_status <=1 || $heater_status <=1) {
                $update = GreenhouseModel::where('serial_number', $serial_number)->update([
                    'fan_status' => $fan_status,
                    'motor_status' => $motor_status,
                    'sun_light_status' => $light_status,
                    'heater_status' => $heater_status,
                ]);
                if ($fan_status == 1) {
                    return response()->json("Fan is ON");
                }
                
                elseif ($motor_status == 1) {
                    return response()->json("Motor is ON");
                }
               
                elseif ($light_status == 1) {
                    return response()->json("SunLight is ON");
                }
               
                elseif ($heater_status == 1) {
                    return response()->json("Heater is ON");
                }
                
              
           }
            // if ($fan_status == 0 || $motor_status == 0 || $light_status == 0 || $heater_status == 0) {
            //     $update = GreenhouseModel::where('serial_number', $serial_number)->update([
            //         'fan_status' => $fan_status,
            //         'motor_status' => $motor_status,
            //         'sun_light_status' => $light_status,
            //         'heater_status' => $heater_status,
            //     ]);
                
            //     if ($fan_status == 0) {
            //         return response()->json("Fan is OFF");
            //     }
               
            //     elseif ($motor_status == 0) {
            //         return response()->json("Motor is OFF");
            //     }
               
            //     elseif ($light_status == 0) {
            //         return response()->json("SunLight is OFF");
            //     }
                
            //     elseif ($heater_status == 0) {
            //         return response()->json("Heater is OFF");
            //     }

            // }
    
      }
    }
    public function GetSessionID($id)
    {
        //$session = '';
        $data = GreenhouseModel::find($id);
        if ($data) {
           $session = DB::select('SELECT s.id FROM session s  WHERE s.green_house_id = '.$id.' AND s.status = 1');
           //return $session[0]->id;
           if ($session) {
                return response()->json($session[0]->id);

           }else{
               return 0;
           }
           
        }
    }
    public function getRequiredParameters($id,$day_no)
    {
        $data = DB::select("SELECT p.id
                    FROM
                        plant_parameter pr
                    JOIN parameters p ON
                        p.id = pr.parameter_id
                    WHERE
                        pr.range_from <= ".$day_no." AND pr.range_to >= ".$day_no."
                     GROUP BY pr.plant_id");
        if ($data) {
            $humidity = DB::select("SELECT CASE WHEN pr.request_value IS NULL THEN 0 ELSE pr.request_value END AS ReqHumidity
                    FROM
                        plant_parameter pr
                    JOIN parameters p ON
                        p.id = pr.parameter_id
                    WHERE
                        p.parameter_name = 'Humidity' AND pr.range_from <= ".$day_no." AND pr.range_to >= ".$day_no." AND pr.plant_id = ".$id." 
                     ");
            $sunlight = DB::select("SELECT CASE WHEN pr.request_value IS NULL THEN 0 ELSE pr.request_value END AS ReqSunLight
                    FROM
                        plant_parameter pr
                    JOIN parameters p ON
                        p.id = pr.parameter_id
                    WHERE
                        p.parameter_name = 'SunLight' AND pr.range_from <= ".$day_no." AND pr.range_to >= ".$day_no." AND pr.plant_id = ".$id." 
                     ");
            $Temperature = DB::select("SELECT CASE WHEN pr.request_value IS NULL THEN 0 ELSE pr.request_value END AS ReqTemperature
                    FROM
                        plant_parameter pr
                    JOIN parameters p ON
                        p.id = pr.parameter_id
                    WHERE
                        p.parameter_name = 'Temperature' AND pr.range_from <= ".$day_no." AND pr.range_to >= ".$day_no." AND pr.plant_id = ".$id." 
                     ");
            $SoilMoisture = DB::select("SELECT CASE WHEN pr.request_value IS NULL THEN 0 ELSE pr.request_value END AS ReqSoilMoisture
                    FROM
                        plant_parameter pr
                    JOIN parameters p ON
                        p.id = pr.parameter_id
                    WHERE
                        p.parameter_name = 'SoilMoisture' AND pr.range_from <= ".$day_no." AND pr.range_to >= ".$day_no . " AND pr.plant_id = ".$id." 
                     ");
           
        }
        if ($data) {
            return response()->json(["ReqHumidity" => $humidity[0]->ReqHumidity, "ReqSunLight" => $sunlight[0]->ReqSunLight, "ReqTemperature" => $Temperature[0]->ReqTemperature, "ReqSoilMoisture" => $SoilMoisture[0]->ReqSoilMoisture]);
        } else {
            return 0;
        }
    }
}
