<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentModel;
use Auth;
use DataTables;
use DB;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Expense.index');
    }
    public function getData(Request $request)
    {
        $data =   DB::select("SELECT
                    *
                FROM
                    payments p
                WHERE
                    p.is_deleted = 0 AND p.type = 'Expense'
                ORDER BY
                    p.id
                DESC
        ");
         return Datatables::of($data)->addColumn('action', function ($id) {
                    
            return ' <a href="expense_edit/'. $id->id.'" style="color: blue;cursor: pointer;" class="edit" data-id='.$id->id.'  ><i class="fa fa-edit"></i></a> |
                
                    <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
              ';
         })->rawColumns(['action'])->make(true); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = PaymentModel::find($id);
        return view('Expense.forms',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $insert =  PaymentModel::create([
            'type'=>"Expense",
            'description' => $request->desc,
            'debit' => $request->amount,
            'credit'=>'0',
            'date' => $request->date,
            'created_by'=> Auth::user()->id
        ]);
        
        if ($insert) {
                return redirect('expense')->with('success','Data inserted successfully!');

            }else{
                return redirect('expense')->with('error','Ooppsss, Something went wrong!');

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
       $insert = PaymentModel::where('id','=',$id)->update([
            'type'=>"Expense",
            'description' => $request->desc,
            'debit' => $request->amount,
            'credit'=>'0',
            'date' => $request->date,
            'updated_by'=> Auth::user()->id
        ]);
       if ($insert) {
                return redirect('expense')->with('success','Data updated successfully!');

            }else{
                return redirect('expense')->with('error','Ooppsss, Something went wrong!');

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
        $delete =  PaymentModel::where('id','=',$id)->update([
            'is_deleted' => $id,
            
        ]);
      if ($delete) {
          return 1;
      }
    }
    public function search(Request $request)
    {

        if ($request->to_date != NULL && $request->end_date != NULL) {
            //dd($request->end_date);
            $data = DB::select("SELECT
             p.*
            
         FROM
             payments p
       
         WHERE
             p.is_deleted = 0 AND p.type = 'Expense' AND p.date <= '" . date("Y/d/m", strtotime($request->end_date)) . "' AND p.date >= '" . date("Y/d/m", strtotime($request->to_date)) . "' AND p.type = 'Expense'
             ORDER BY
             p.id
         DESC
             
             ");

            return Datatables::of($data)->addColumn('action', function ($id) {

                return ' <a href="expense_edit/' . $id->id . '" style="color: blue;cursor: pointer;" class="edit" data-id=' . $id->id . '  ><i class="fa fa-edit"></i></a> |
                   
                       <a  style="color: red;cursor: pointer;" id="' . $id->id . '" data-delete="' . $id->id . '" class="delete_btn"><i class="fa fa-trash"></i></a>
                 ';
            })->rawColumns(['action'])->make(true);
        }
        if ($request->to_date) {

            $data = DB::select("SELECT
             p.*
         FROM
             payments p
         
         WHERE
             p.is_deleted = 0 AND p.type = 'Expense' AND p.date = '" . date("Y/d/m", strtotime($request->to_date)) . "'  
             ORDER BY
             p.id
         DESC         
             ");
            return Datatables::of($data)->addColumn('action', function ($id) {

                return ' <a href="expense_edit/' . $id->id . '" style="color: blue;cursor: pointer;" class="edit" data-id=' . $id->id . '  ><i class="fa fa-edit"></i></a> |
                    
                        <a  style="color: red;cursor: pointer;" id="' . $id->id . '" data-delete="' . $id->id . '" class="delete_btn"><i class="fa fa-trash"></i></a>
                  ';
            })->rawColumns(['action'])->make(true);
            //return view("Expense.index",compact('data'));
        }
        if ($request->end_date) {
            //dd($request->all());
            $data = DB::select("SELECT
        p.*
    FROM
        payments p

    WHERE
        p.is_deleted = 0 AND p.type = 'Expense' AND p.date = '" . date("Y/d/m", strtotime($request->end_date)) . "'  AND p.type = 'Expense'
        ORDER BY
        p.id
    DESC
       
        ");
            return Datatables::of($data)->addColumn('action', function ($id) {

                return ' <a href="expense_edit/' . $id->id . '" style="color: blue;cursor: pointer;" class="edit" data-id=' . $id->id . '  ><i class="fa fa-edit"></i></a> |
            
                <a  style="color: red;cursor: pointer;" id="' . $id->id . '" data-delete="' . $id->id . '" class="delete_btn"><i class="fa fa-trash"></i></a>
          ';
            })->rawColumns(['action'])->make(true);
        }
    }
}
