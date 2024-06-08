<?php

namespace App\Http\Controllers\MobileApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GreenhouseModel;
use App\Models\ParameterLogModel;
use DB;
use App\Models\SessionModel;

class MobileApiController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
       // $password = Hash::make($request->password);

        $data = User::where('email',$email)->first();

        $hash_password = $data->password;
        if (Hash::check($request->password,$hash_password)) {
            return response()->json(["message"=> "Congratulations! successfully login",'data'=>$data]);
        }else{
            return response()->json(["message"=> "user not found!","status"=>404]);
            //return response(null, 204);
        }
    }
    public function Greenhouse($id)
    {
        $data = DB::select("SELECT
        g.*,
        s.id AS session_id
    FROM
        green_house g
    JOIN users u ON
        u.id = g.customer_id
    JOIN session s ON
        s.green_house_id = g.id
    WHERE
        g.customer_id = ".$id."");
        return response()->json($data);
    }
    public function session($id)
    {
        $id_found = GreenhouseModel::find($id);
        if ($id_found) {
            $current =  Carbon::now()->toDateString();
            //return $current;
            $current_date = date('Y-m-d');
            $data = DB::select("SELECT
            g.id as plant_id,
            s.id as session_id,
            s.start_date,
            s.plant_age,
            s.status,
            g.name,
            r.average_temp,
            r.average_humidity,
            r.average_soil_moisture,
            r.day_no
        FROM
            green_house g
        JOIN session s ON
            s.green_house_id = g.id
       LEFT JOIN report r ON r.session_id = s.id
        WHERE
            g.id = ".$id." AND s.status = 1");

             return response()->json(["data" => $data]);
        }else{
            return response()->json(["message"=> "data not found!","status"=>404]);
        }

    }
    public function GreenHouseCount($id)
    {
        $id_found = GreenhouseModel::find($id);
        // return $id_found;
        if ($id_found) {
            $current =  Carbon::now()->toDateString();
            //return $current;
            $current_date = date('Y-m-d');
            $data = DB::select("SELECT
            p.plant_name,
            s.start_date,
            s.status,
            p.plant_description,
            p.plant_life_duration as session_total_days,
            g.name as green_house_name,
            r.average_temp,r.average_humidity,r.average_soil_moisture
        FROM session s
        JOIN green_house g ON g.id = s.green_house_id
        JOIN plant_info p ON p.id = s.plant_id
         LEFT JOIN report r ON r.session_id = s.id
        WHERE g.id = ".$id."");
       
            return response()->json($data);
            } 
            else {
                return response()->json(["message" => "data not found!", "status" => 404]);
            }
        }
       
    public function Update(Request $request,$id)
    {
        $id_found = User::find($id);
        if ($id_found) {
            if ($request->password == null) {

            //    $data =  User::where('id','=',$id)->update([
            //         'email' => $request->email,
            //         'first_name' => $request->first_name,
            //         'last_name' => $request->last_name,
            //         'address' => $request->address,
            //         'cnic' => $request->cnic,
            //         'phone_num' => $request->phone_num,

            //     ]);
            //   $data =   DB::update("UPDATE
            //     `users`
            // SET
            //     `first_name` =

            //     '{$request->first_name}',
            //     `last_name` =

            //     '{$request->last_name}',
            //     `cnic` =

            //     '{$request->cnic}',
            //     `phone_num` =

            //     '{$request->phone_num}',
            //     `address` =

            //     '{$request->address}',
            //     `email` =

            //     '{$request->email}'
            // WHERE
            // id = '{$id}'");
              $data =  $id_found->update($request->all());
            }else{
                //$data =  $id_found->update($request->all());
                //dd('true');
                //dd($request->password);
                 User::where('id','=',$id)->update([
                    'password' => Hash::make($request->password),
                    'password_confirmation' => $request->password,
                ]);
                $data =  $id_found->update($request->all());
                // $data =   User::where('id','=',$id)->update([
                //     'email' => $request->email,
                //     'password' => Hash::make($request->password),
                //     'password_confirmation' => $request->password,
                //     'first_name' => $request->first_name,
                //     'last_name' => $request->last_name,
                //     'address' => $request->address,
                //     'cnic' => $request->cnic,
                //     'phone_num' => $request->phone_num,

                // ]);
                // $pass = Hash::make($request->password);
                // $data =   DB::update("UPDATE
                //      `users`
                //  SET
                //      `first_name` =

                //      '{$request->first_name}',
                //      `last_name` =

                //      '{$request->last_name}',
                //      `cnic` =

                //      '{$request->cnic}',
                //      `phone_num` =

                //      '{$request->phone_num}',
                //      `address` =

                //      '{$request->address}',
                //      `email` =

                //      '{$request->email}',
                //      `password` = '{$pass}',
                //      `password_confirmation` = '{$request->password}'
                //  WHERE
                //  id = '{$id}'");
            }
            if ($data) {
                return response()->json("data has been updated!", 200);
            }else{
                return response()->json(['message'=>'Record Not Found!'],404);
            }
        }
    }
    public function CurrentParameters($id)
    {
        $id_found = SessionModel::find($id);
        if ($id_found) {
            $data = DB::select("SELECT * FROM parameter_log WHERE session_id = " . $id . "");
            if ($data != NULL) {
                return response()->json(["data" => $data]);
            } else {
                return response()->json(["message" => "data not found!", "status" => 404]);
            }
        } else {
            return response()->json(["message" => "data not found!", "status" => 404]);
        }


    }
    public function Edit($id)
    {
        $data = User::find($id);
        if ($data != NULL) {
            return response()->json(["data"=>$data]);
        }else{
            return response()->json(["message"=> "data not found!","status"=>404]);
        }
    }
    public function UpdatePassword(Request $request,$id)
    {
         try {
            $hashedPassword = User::find($id);
            //  return($hashedPassword->password);
            if (\Hash::check($request->old_password , $hashedPassword->password)) {
              if (!\Hash::check($request->new_password , $hashedPassword->password)){
                   $users = User::find($id);
                   $user_id = $id;
                   $users_password = $request->new_password;
                  User::where('id','=',$user_id)->update([
                      'password' => Hash::make($users_password),
                  ]);

                   return response()->json(["message"=> "password updated successfully!","status"=>204]);
                 }

                 else{
                       return response()->json(["message"=> "new password can not be the old password!","status"=>404]);
                     }

                }

               else{

                    return response()->json(["message"=> "old password doesnt matched!","status"=>404]);
                  }



        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function GetActuatorStatus($id)
    {
        $data = GreenhouseModel::find($id);
        if ($data) {
           $status = GreenhouseModel::where('id',$id)->get();
           if ($status) {
                return response()->json(["data" => $status, "status" => 204]);

           }else{
                return response()->json(["message" => 'data does not exist', "status" => 204]);

           }

        }
    }
    public function SessionStatus(Request $request,$id)
    {
        $status = $request->status;
       $data = SessionModel::find($id);
       if ($data) {
            if ($status == 1) {
                $update = SessionModel::where('green_house_id', $id)->update([
                    'status' => '1'
                ]);
                return response()->json(["message" => 'Session has been activated now']);

               
            }
            if ($status == 0) {
                $update = SessionModel::where('green_house_id', $id)->update([
                    'status' => '0'
                ]);
                return response()->json(["message" => 'Session has been deactivated now']);

              
            }
           
       }
    }
    public function AVGValues(Request $request)
    {
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
    if ($data) {
            return response()->json(["data" => $data, "status" => 204]);

    }else{
            return response()->json(["message" => 'data doest not exist', "status" => 404]);

    }
    }
    public function TotalDaysOfSession($id)
    {
        $id_found = SessionModel::find($id);
        if ($id_found) {
            $current =  Carbon::now()->toDateString();
            //return $current;
            $current_date = date('Y-m-d');
            $data = DB::select("SELECT
            g.id as plant_id,
            s.id as session_id,
            s.start_date,
            g.name,
            r.average_temp,
            r.average_humidity,
            r.average_soil_moisture,
            r.day_no
        FROM
            green_house g
        JOIN session s ON
            s.green_house_id = g.id
       LEFT JOIN report r ON r.session_id = s.id
        WHERE
            s.id = ".$id." AND s.status = 1");
             //return response()->json($data);

            if ($data) {
                $start_date = $data[0]->start_date;

                $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $start_date);
                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $current);
                $different_days = $start_date->diffInDays($end_date);
                return response()->json(["total_days_of_session" => $different_days + 1]);
            }else {
            return response()->json(["message" => "data not found!", "status" => 404]);
        }

            
           
        } else {
            return response()->json(["message" => "data not found!", "status" => 404]);
        }
    }
    public function AVGValuesAgainstGreenhouse($id)
    {
                    $data = DB::select('SELECT
            p.request_value,pr.parameter_name,l.current_temperature,l.current_humidity,l.currrent_soil_moisture
            FROM
                green_house g
            JOIN plant_info i ON
                i.user_id = g.customer_id
            JOIN plant_parameter p ON
                p.plant_id = i.id
            JOIN fertilizer_info f ON
                f.user_id = g.customer_id
            JOIN fertilizer_schedule s ON
                s.plant_fertilizer_id = f.id
            JOIN parameters pr ON
            pr.id = p.parameter_id
            JOIN plant_fertilizer pf ON
            pf.fertilizer_id = f.id
            JOIN parameter_log l ON l.session_id = s.id
            WHERE
                s.id = '.$id.'
                GROUP BY p.parameter_id');
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(["message" => 'data doest not exist', "status" => 404]);
        }
    }
}
