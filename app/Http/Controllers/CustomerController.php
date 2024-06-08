<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GreenhouseModel;
use App\Models\SessionModel;
use Auth;
use DataTables;
use DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.customer');
    }
    public function getdata() {
        //Get all users and pass it to the view
           try {

           // $user = User::all();
           $user = User::whereHas(
            'roles', function($q){
                $q->where('name','=' ,'Customer')->orWhere('name','=','customer');
            }
        )->get();
            return Datatables::of($user)->addColumn('name',function($role){
                return $role->roles()->pluck('name')->implode(' ');
            })->editColumn('created_at', function ($contact){
                return date('F d, Y h:ia', strtotime($contact->created_at) );
            })->addColumn('action', function ($id) {
                return '<a href="users_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |
                    <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                  '; })->rawColumns(['action'])->make(true);
           } catch (\Exception $e) {
              dd($e);
                //return back()->with('msg', $e->getMessage());
           }
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = GreenhouseModel::find($id);
        if ($data) {
            return $data;
            //return view('website.home',compact('data'));
        } else {
            return '0';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fanupdate(Request $request, $id)
    {
            $fan_status = $request->fan_status;
            //dd($fan_status);
            if ($fan_status == 'on') {
                $fan_status = 0;
            $data = GreenhouseModel::where('id', $id)->update([
                'fan_status' => $fan_status
            ]);
            }
            elseif ($fan_status == 'true') {
                $fan_status = 0;
            $data = GreenhouseModel::where('id', $id)->update([
                'fan_status' => $fan_status
            ]);
            }else{
                $fan_status = 1;
            $data = GreenhouseModel::where('id', $id)->update([
                'fan_status' => $fan_status
            ]);
            } 
            if ($data) {
               return 1;
            }else{
                return 0;
            }
    }
    public function motorupdate(Request $request, $id)
    {
        $motor_status = $request->motor_status;
        if ($motor_status == 'on') {
            $motor_status = 0;
            $data = GreenhouseModel::where('id', $id)->update([
                'motor_status' => $motor_status
            ]);
        }
        elseif ($motor_status == 'true') {
            $motor_status = 0;
            $data = GreenhouseModel::where('id', $id)->update([
                'motor_status' => $motor_status
            ]);
        } else {
            $motor_status = 1;
            $data = GreenhouseModel::where('id', $id)->update([

                'motor_status' => $motor_status
            ]);
        }
        if ($data) {
            return 1;
        } else {
            return 0;
        }
    }
    public function heaterupdate(Request $request, $id)
    {
    
        $heater_status = $request->heater_status;
        //dd($heater_status);
        if ($heater_status == 'on') {
            $heater_status = 0;
            $data = GreenhouseModel::where('id', $id)->update([
                'heater_status' => $heater_status
            ]);
        }
        elseif ($heater_status == 'true') {
            $heater_status = 0;
            $data = GreenhouseModel::where('id', $id)->update([
                'heater_status' => $heater_status
            ]);
        } else {
            $heater_status = 1;
            $data = GreenhouseModel::where('id', $id)->update([
                'heater_status' => $heater_status

            ]);
        }
        if ($data) {
            return 1;
        } else {
            return 0;
        }
    }
    public function lightupdate(Request $request,$id)
    {
       $flag = $request->flag;
      if ($flag == 1) {
            $update = GreenhouseModel::select('green_house')->join('session', 'session.green_house_id', 'green_house.id')->update([
                'status' => 1
            ]);
            return 1;
      }else{
            $update = GreenhouseModel::select('green_house')->join('session', 'session.green_house_id', 'green_house.id')->update([
                'status' => 0
            ]);
            return 0;
      }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
