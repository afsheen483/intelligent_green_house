<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use DB;
use App\Models\SessionModel;
class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Session.index');

    }
    public function getdata(Request $request){

        try {

            $sessions = DB::select("SELECT
            s.*,
                    g.name,
                    p.plant_name
                FROM session
                    s
                JOIN plant_info p ON
                    p.id = s.plant_id
                JOIN green_house g ON
                    g.id = s.green_house_id

                WHERE
                    s.is_deleted = 0
                ORDER BY
                    s.id
                DESC
            ");
            
                return Datatables::of($sessions)->addColumn('action', function ($id) {

                    return '<a  style="color: green;cursor: pointer;" id="'.$id->id.'" data-check="'.$id->id.'" class="check_btn"><i class="fa fa-check"></i></a> |

                    <a href="session_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->addColumn('status', function ($user) {
                if ($user->status == 0) return '<span class="btn btn-sm bg-success-light">ON</span>';
                if ($user->status == 1) return '<span class="btn btn-sm bg-danger-light">OFF</span>';
                return 'Cancel';
                 })->rawColumns(['action','status'])->make(true);





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
        $session = new SessionModel();
        if ($id > 0) {
            $session = SessionModel::find($id);
        }
        return view('Session.forms',compact('session'));
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
        SessionModel::create([
            'plant_id' => $request->plant_id,
            'green_house_id' => $request->green_house_id,
            'user_id' => $id,
            'start_date' => $request->start_date,
            'plant_age' => $request->plant_age,
            'created_at' => $date,
            'created_by' => $id
        ]);
        return redirect('sessions');
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
        $userid = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        SessionModel::where('id',$id)->update([
            'plant_id' => $request->plant_id,
            'green_house_id' => $request->green_house_id,
            'user_id' => $userid,
            'start_date' => $request->start_date,
            'plant_age' => $request->plant_age,
            'updated_at' => $date,
            'updated_by' => $userid
        ]);
        return redirect('sessions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del =  SessionModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
    public function UpdateStatus($id)
    {
        // $up =  SessionModel::where('id', '=', $id)->update([
        //     'status' => 1,
        // ]);
        // if ($up) {
        //     return 1;
        // }else{

        // }
        $is_active = SessionModel::where('id', '=', $id)->get();
        //dd($is_active);
        if ($is_active[0]->status == 0) {
            $update = SessionModel::where('id', '=', $id)->update([
                'status' => '1'
            ]);
            if ($update) {
                return 1;
            }
        }
        if ($is_active[0]->status == 1) {
            $update = SessionModel::where('id', '=', $id)->update([
                'status' => '0'
            ]);
            if ($update) {
                return 0;
            }
        }
    }
}
