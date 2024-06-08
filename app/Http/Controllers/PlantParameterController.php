<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantParameterModel;
use Auth;
use DataTables;
use DB;

class PlantParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plant_parameter.index');
    }

    public function getdata(Request $request){

        try {

            $parameter = DB::select("SELECT
            p.*,
            i.plant_name,
            m.parameter_name
        FROM
            plant_parameter p
        JOIN plant_info i ON
            i.id = p.plant_id
        JOIN parameters m ON
            m.id = p.parameter_id
        WHERE
            p.is_deleted = 0
        ORDER BY
            p.id
        DESC
            ");
                return Datatables::of($parameter)->addColumn('action', function ($id) {

                    return '

                    <a href="plantpara_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

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
        $plant_info = new PlantParameterModel();
        if ($id > 0) {
           $plant_info = PlantParameterModel::find($id);
        }
        return view('plant_parameter.forms',compact('plant_info'));
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
        PlantParameterModel::create([
            'plant_id' => $request->plant_id,
            'parameter_id'=> $request->parameter_id,
            'range_from' => $request->range_from,
            'range_to' => $request->range_to,
            'threshold' => $request->threshold,
            'request_value' => $request->request_value,
            'created_at' => $date,
            'created_by' => $id
        ]);
        return redirect('plant_parameter');
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
       $update =  PlantParameterModel::where('id','=',$id)->update([
            'plant_id' => $request->plant_id,
            'parameter_id'=> $request->parameter_id,
            'range_from' => $request->range_from,
            'range_to' => $request->range_to,
            'threshold' => $request->threshold,
            'request_value' => $request->request_value,
            'updated_at' => $date,
            'updated_by'=>$user_id,
        ]);
        if ($update) {
            return redirect('view_plantlife/'.$user_id.'')->with('success', 'Data updated successfully!');
        }else{
            return redirect('view_plantlife/'.$user_id.'')->with('error', 'something went wrong!');

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
        $del =  PlantParameterModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
}
