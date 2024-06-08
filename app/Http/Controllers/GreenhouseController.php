<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GreenhouseModel;
use Auth;
use DataTables;
use DB;
class GreenhouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('greenhouse.index');
    }

    public function getdata(Request $request){

        try {

            $green_house = DB::select("SELECT
                h.*,
                CONCAT(u.first_name, ' ', u.last_name) AS customer_name
            FROM
                green_house h
            JOIN users u ON
                u.id = h.customer_id
            WHERE
                h.is_deleted = 0
            ORDER BY h.id DESC");
                return Datatables::of($green_house)->addColumn('action', function ($id) {

                    return '

                    <a href="greenhouse_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->rawColumns(['action'])->make(true);





         } catch (\Throwable $th) {

             dd($th);
         }
    }
    public function inventorydata(Request $request){

        try {

            $green_house = DB::select("SELECT
                h.*,
                CONCAT(u.first_name, ' ', u.last_name) AS customer_name
            FROM
                green_house h
            JOIN users u ON
                u.id = h.customer_id
            WHERE
                h.is_deleted = 0 AND
                h.is_sold = 0
            ORDER BY h.id DESC");
                return Datatables::of($green_house)->addColumn('action', function ($id) {

                    return'

                    <a href="greenhouse_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->rawColumns(['action'])->make(true);





         } catch (\Throwable $th) {

             dd($th);
         }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $green_house = new GreenhouseModel();
        if ($id > 0) {
           $green_house = GreenhouseModel::find($id);
        }
        return view('greenhouse.forms',compact('green_house'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        $insert = GreenhouseModel::create([
            'mac_address' => $request->mac_address,
            'name'=> $request->name,
            'serial_number' => $request->serial_number,
            'soil_nodes' => $request->soil_node,
            'temperature_nodes' => $request->temp_node,
            'humidity_nodes' => $request->humidity_node,
            'green_house_location' => $request->location,
            'amount' => $request->amount,
            'customer_id'=>$request->customer_name,
            'created_at' => $date,
            'created_by' => $id
        ]);
         if ($insert) {
                return redirect('greenhouse')->with('success','Data inserted successfully!');

            }else{
                return redirect('greenhouse')->with('error','Ooppsss, Something went wrong!');

            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
       $update = GreenhouseModel::where('id','=',$id)->update([
            'mac_address' => $request->mac_address,
            'name'=> $request->name,
            'serial_number' => $request->serial_number,
            'soil_nodes' => $request->soil_node,
            'temperature_nodes' => $request->temp_node,
            'humidity_nodes' => $request->humidity_node,
            'green_house_location' => $request->location,
            'amount' => $request->amount,
            'customer_id'=>$request->customer_name,
            'updated_at' => $date,
            'updated_by'=>$user_id,
        ]);
        
          if ($update) {
                return redirect('greenhouse')->with('success','Data updated successfully!');

            }else{
                return redirect('greenhouse')->with('error','Ooppsss, Something went wrong!');

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
      $del =  GreenhouseModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
}
