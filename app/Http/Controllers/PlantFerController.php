<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantFerModel;
use App\Models\FertilizerSceduleModel;
use Auth;
use DataTables;
use DB;
class PlantFerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plant_fertilizer.index');
    }
    public function getdata(Request $request){

        try {

            $parameter = DB::select("SELECT
            f.*,
            i.fertilizer_name,
            p.plant_name
        FROM
            plant_fertilizer f
        JOIN fertilizer_info i ON
            i.id = f.fertilizer_id
        JOIN plant_info p ON
            p.id = f.plant_id
        WHERE
            f.is_deleted = 0
        ORDER BY
            f.id
        DESC

            ");
                return Datatables::of($parameter)->addColumn('action', function ($id) {

                    return '

                    <a href="plant_fertilizer_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

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
        $plant_info = new PlantFerModel();
        if ($id > 0) {
           $plant_info = PlantFerModel::find($id);
        }
        return view('plant_fertilizer.forms',compact('plant_info'));
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
        PlantFerModel::create([
            'plant_id' => $request->plant_id,
            'fertilizer_id'=>$request->fertilizer_id,
            'quantity'=>$request->quantity,
            'time_duration'=>$request->time_duration,
            'created_at' => $date,
            'created_by' => $id
        ]);
        return redirect('plant_fertilizer');
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
        $update = PlantFerModel::where('id','=',$id)->update([
            'plant_id' => $request->plant_id,
            'fertilizer_id'=>$request->fertilizer_id,
            'quantity'=>$request->quantity,
            'time_duration'=>$request->time_duration,
            'updated_at' => $date,
            'updated_by'=>$user_id,
        ]);
        if ($update) {
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
        $del =  PlantFerModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
    public function updateSche(Request $request,$id)
    {
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        $update = FertilizerSceduleModel::where('id', '=', $id)->update([
            'day_no' => $request->day_no,
            'updated_at' => $date,
            'updated_by' => $user_id,
        ]);
        if ($update) {
            return redirect('view_plantlife/'.$user_id.'')->with('success', 'Data updated successfully!');
        } else {
            return redirect('view_plantlife/'.$user_id.'')->with('error', 'Ooppsss, Something went wrong!');
        }
    }
}
