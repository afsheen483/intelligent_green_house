<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FertilizerModel;
use App\Models\FertilizerSceduleModel;
use Auth;
use DataTables;
use DB;

class FertilizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fertilizer.index');
    }
    public function getdata(Request $request){

        try {

            $parameter = DB::select("SELECT
           *
        FROM
        fertilizer_info

        WHERE
            is_deleted = 0
        ORDER BY
            id
        DESC
            ");
                return Datatables::of($parameter)->addColumn('action', function ($id) {

                    return '

                    <a href="fertilizer_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

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
        $plant_info = new FertilizerModel();
        if ($id > 0) {
           $plant_info = FertilizerModel::find($id);
        }
        return view('fertilizer.forms',compact('plant_info'));
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
        $insert = FertilizerModel::create([
            'fertilizer_name' => $request->fertilizer_name,
            'user_id'=>$id,
            'created_at' => $date,
            'created_by' => $id
        ]);
            if ($insert) {
                return back()->with('success','Data inserted successfully!');

            }else{
                return back()->with('error','Ooppsss, Something went wrong!');

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
        FertilizerModel::where('id','=',$id)->update([
            'fertilizer_name' => $request->fertilizer_name,
            'updated_at' => $date,
            'updated_by'=>$user_id,
        ]);
        return redirect('fertilizer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del =  FertilizerSceduleModel::where('plant_fertilizer_id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
    public function GetDataSchedule($id)
    {
        $plant_info = new FertilizerSceduleModel();
        if ($id > 0) {
            $plant_info = FertilizerSceduleModel::find($id);
        }
        return view('fertilizer_sche.form',compact('plant_info'));
    }
    public function FertilizerUpdate(Request $request,$id)
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
