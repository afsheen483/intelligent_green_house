<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use DB;
use App\Models\PaymentModel;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BalanceSheet.index');
    }
    public function balancedata(Request $request)
    {
        try {
            $balance = DB::select("SELECT
                p.*,
                CONCAT(u.first_name,' ',u.last_name) AS customer_name,
                CONCAT(a.first_name,' ',a.last_name) AS admin_name,
                m.note,
                m.feedback,
                m.green_house_id,
                m.work_hours,
                m.location
            FROM
                payments p
            LEFT JOIN maintainanace m ON
                m.id = p.maintain_id
            LEFT JOIN users u ON
                p.customer_id = u.id
            LEFT JOIN users a ON
                a.id = p.user_id
            WHERE
                p.is_deleted = 0
                ORDER BY p.id
            DESC
        ");
                return Datatables::of($balance)->addColumn('action', function ($id) {

                    return '
                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      ';
                 })->addColumn('debit',function ($debit)
                 {
                     return is_null($debit->debit) ? '0' : $debit->debit;
                 })->addColumn('credit',function ($credit)
                 {
                     return is_null($credit->credit) ? '0' : $credit->credit;
                 })->rawColumns(['action','credit','debit'])->make(true);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
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
    public function SaveTransaction(Request $request){
        //dd($request->loan);

        if ($request->ledger_id == 1 ) {
           $insert = PaymentModel::create([
                'customer_id' => $request->customer_id,
                'date' => $request->date1,
                'description' => $request->desc,
                'credit' => $request->amount,
                'type' => 'Customer',
                'debit' => 0,
                'created_by' => Auth::user()->id,
            ]);
        }
            if ($request->ledger_id == 0 ) {
               $insert = PaymentModel::create([
                    'customer_id' => $request->customer_id,
                    'date' => $request->date1,
                    'description' => $request->desc,
                    'debit' => $request->amount,
                    'credit'=>0,
                    'type' => 'Customer',
                    'created_by' => Auth::user()->id,
                ]);
        }

        if ($insert) {
                return redirect('/balance_sheet')->with('success','Data inserted successfully!');

            }else{
                return redirect('/balance_sheet')->with('error','Ooppsss, Something went wrong!');

            }
    }
    public function search(Request $request)
    {
        //dd($request->to_date);

        if ($request->to_date != NULL && $request->end_date != NULL) {

            $balance = DB::select("SELECT
             p.*,
             CONCAT(u.first_name,' ',u.last_name) AS customer_name,
             CONCAT(a.first_name,' ',a.last_name) AS admin_name,
             m.note,
             m.feedback,
             m.green_house_id,
             m.work_hours,
             m.location
         FROM
             payments p
         LEFT JOIN maintainanace m ON
             m.id = p.maintain_id
         LEFT JOIN users u ON
             p.customer_id = u.id
         LEFT JOIN users a ON
             a.id = p.user_id
         WHERE
             p.is_deleted = 0 AND AND p.date <= '" . date("Y/d/m", strtotime($request->end_date)) . "' AND p.date >= '" . date("Y/d/m", strtotime($request->to_date)) . "'
             ORDER BY p.id
         DESC


             
             ");

            return Datatables::of($balance)->addColumn('action', function ($id) {

                return '
                    <a  style="color: red;cursor: pointer;" id="' . $id->id . '" data-delete="' . $id->id . '" class="delete_btn"><i class="fa fa-trash"></i></a>
                  ';
            })->addColumn('debit', function ($debit) {
                return is_null($debit->debit) ? '0' : $debit->debit;
            })->addColumn('credit', function ($credit) {
                return is_null($credit->credit) ? '0' : $credit->credit;
            })->rawColumns(['action', 'credit', 'debit'])->make(true);
        }
        if ($request->to_date) {

            $balance = DB::select("SELECT
             p.*,
             CONCAT(u.first_name,' ',u.last_name) AS customer_name,
             CONCAT(a.first_name,' ',a.last_name) AS admin_name,
             m.note,
             m.feedback,
             m.green_house_id,
             m.work_hours,
             m.location
         FROM
             payments p
         LEFT JOIN maintainanace m ON
             m.id = p.maintain_id
         LEFT JOIN users u ON
             p.customer_id = u.id
         LEFT JOIN users a ON
             a.id = p.user_id
         WHERE
             p.is_deleted = 0 AND p.date = '" . date("Y/d/m", strtotime($request->to_date)) . "'
             ORDER BY p.id
         DESC

   
             ");
            return Datatables::of($balance)->addColumn('action', function ($id) {

                return '
                    <a  style="color: red;cursor: pointer;" id="' . $id->id . '" data-delete="' . $id->id . '" class="delete_btn"><i class="fa fa-trash"></i></a>
                  ';
            })->addColumn('debit', function ($debit) {
                return is_null($debit->debit) ? '0' : $debit->debit;
            })->addColumn('credit', function ($credit) {
                return is_null($credit->credit) ? '0' : $credit->credit;
            })->rawColumns(['action', 'credit', 'debit'])->make(true);
            //return view("Expense.index",compact('data'));
        }
        if ($request->end_date) {
            //dd($request->all());
            $balance = DB::select("SELECT
        p.*,
        CONCAT(u.first_name,' ',u.last_name) AS customer_name,
        CONCAT(a.first_name,' ',a.last_name) AS admin_name,
        m.note,
        m.feedback,
        m.green_house_id,
        m.work_hours,
        m.location
    FROM
        payments p
    LEFT JOIN maintainanace m ON
        m.id = p.maintain_id
    LEFT JOIN users u ON
        p.customer_id = u.id
    LEFT JOIN users a ON
        a.id = p.user_id
    WHERE
        p.is_deleted = 0 AND p.date = '" . date("Y/d/m", strtotime($request->end_date)) . "'
        ORDER BY p.id
    DESC
       
        ");
            return Datatables::of($balance)->addColumn('action', function ($id) {

                return '
            <a  style="color: red;cursor: pointer;" id="' . $id->id . '" data-delete="' . $id->id . '" class="delete_btn"><i class="fa fa-trash"></i></a>
          ';
            })->addColumn('debit', function ($debit) {
                return is_null($debit->debit) ? '0' : $debit->debit;
            })->addColumn('credit', function ($credit) {
                return is_null($credit->credit) ? '0' : $credit->credit;
            })->rawColumns(['action', 'credit', 'debit'])->make(true);
        }
    }
}
