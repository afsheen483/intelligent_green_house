<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use App\Models\RequestModel;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Customer_Request.index');
    }


    public function getdata()
    {
        $request = DB::select("SELECT * FROM customer_request
            ORDER BY id DESC");
                return Datatables::of($request)->addColumn('action', function ($id) {

                    return '<a href="view_green_house/ '. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;"><i class="fa fa-eye"></i></a> |

                    <a href="green_house_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->rawColumns(['action'])->make(true);
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
        RequestModel::create([
        'customer_name' => $request->name,
        'email' => $request->email,
        'phone_no' => $request->phone_no,
        'address' => $request->address,
        'description' => $request->desc,
        'created_at' => date("Y-m-d h:i:s")
        ]);
        return redirect()->back()->with('message', 'Congratulation! Your request has been submitted.');

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
        //
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
