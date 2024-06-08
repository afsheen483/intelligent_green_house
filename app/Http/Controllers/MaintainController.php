<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;
use App\Models\MaintainModel;
class MaintainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Maintain.index');
    }


    public function getdata(Request $request){

        try {

            $maintain = DB::select("SELECT
            m.*,
            CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
            g.name
        FROM
            maintainanace m
        JOIN green_house g ON
            g.id = m.green_house_id
        JOIN users u ON
            m.user_id = u.id
        WHERE
            m.is_deleted = 0
        ORDER BY
            m.id
        DESC 

            ");
                return Datatables::of($maintain)->addColumn('action', function ($id) {

                    return '

                    <a href="maintainance_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

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
        $maintain = new MaintainModel();
        if ($id > 0) {
            $maintain = MaintainModel::find($id);
        }
        return view('Maintain.forms',compact('maintain'));
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
       $insert = MaintainModel::create([
            'note' => $request->note,
            'feedback' => $request->feedback,
            'user_id' => $id,
            'green_house_id'=> $request->green_house_id,
            'work_hours' => $request->work_hours,
            'location' => $request->location,
            'created_at' => $date,
            'created_by' => $id
        ]);
        if ($insert) {
                return redirect()->back()->with('success','Your query has been submitted successfully!');

            }else{
                return redirect()->back()->with('error','Ooppsss, Something went wrong!');

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
        $id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
       $insert = MaintainModel::where('id',$id)->update([
            'note' => $request->note,
            'feedback' => $request->feedback,
            'user_id' => $request->user_id,
            'green_house_id'=> $request->green_house_id,
            'work_hours' => $request->work_hours,
            'location' => $request->location,
            'updated_at' => $date,
            'updated_by' => $id
        ]);
        if ($insert) {
                return redirect('maintainance')->with('success','Data updated successfully!');

            }else{
                return redirect('maintainance')->with('error','Ooppsss, Something went wrong!');

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
        $del =  MaintainModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
}
