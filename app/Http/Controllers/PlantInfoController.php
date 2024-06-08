<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantInfoModel;
use Auth;
use DataTables;
use DB;
class PlantInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plant info.index');
    }
    public function getdata(Request $request){

        try {

            $green_house = DB::select("SELECT
               *

            FROM
                plant_info
            WHERE
                is_deleted = 0
            ORDER BY id DESC");
                return Datatables::of($green_house)->addColumn('action', function ($id) {

                    return '

                    <a href="plantinfo_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

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
        $plant_info = new PlantInfoModel();
        if ($id > 0) {
           $plant_info = PlantInfoModel::find($id);
        }
        return view('plant info.forms',compact('plant_info'));
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
        PlantInfoModel::create([
            'plant_name' => $request->plant_name,
            'plant_description'=> $request->plant_description,
            'plant_life_duration' => $request->plant_life_duration,
            'user_id'=>$id,
            'created_at' => $date,
            'created_by' => $id
        ]);
        return redirect('plant_basic_info');
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
        $insert=  PlantInfoModel::where('id','=',$id)->update([
            'plant_name' => $request->plant_name,
            'plant_description'=> $request->plant_description,
            'plant_life_duration' => $request->plant_life_duration,
            'updated_at' => $date,
            'updated_by'=>$user_id,
        ]);
        if ($insert) {
            return redirect('view_plantlife/'.$user_id.'')->with('success', 'Data updated successfully!');
        } else {
            return redirect('view_plantlife/'.$user_id.'')->with('error', 'Ooppsss, Something went wrong!');
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
        $del =  PlantInfoModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
}
