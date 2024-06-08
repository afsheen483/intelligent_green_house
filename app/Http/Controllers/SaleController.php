<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleModel;
use App\Models\PaymentModel;
use Auth;
use DataTables;
use DB;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sale.index');
    }
    public function saledata(Request $request){

        try {

            $sale = DB::select("SELECT
            s.*,
            CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
            h.name,
            p.debit,
            p.credit,
            p.type,
            p.description
        FROM
            sales s
        JOIN users u ON
            u.id = s.customer_id
        JOIN green_house h ON
            h.id = s.greenhouse_id
        JOIN payments p ON
            p.sale_id = s.id
        WHERE
            s.is_deleted = 0
        ORDER BY
            s.id
        DESC
            ");
                return Datatables::of($sale)->addColumn('action', function ($id) {

                    return '

                    <a href="sale_form/'.$id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |

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
        $data = new SaleModel();
        if ($id > 0) {
            $data = SaleModel::select('sales.*','payments.description')->join('payments','payments.sale_id','sales.id')->find($id);
        }
       // dd($data);
        return view('sale.form',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale_id = SaleModel::create([
            'customer_id' => $request->customer_id,
            'greenhouse_id' => $request->greenhouse_id,
            'amount' => $request->amount,
            'installation_amount' => $request->installation_amount,
            'discount_amount' => $request->discount_amount,
            'advance_amount' => $request->advance_amount,
            'date' => $request->date,
            'created_at' =>  date("Y-m-d h:i:s"),
            'created_by' => Auth::user()->id
        ])->id;

       $insert =  PaymentModel::create([
            'debit' => $request->amount,
            'credit' => '0',
            'type' => "Sale",
            'description' => $request->description,
            'date' => $request->date,
            'sale_id' => $sale_id,
            'customer_id' => $request->customer_id,
            'created_at' =>  date("Y-m-d h:i:s"),
            'created_by' => Auth::user()->id
        ]);
     
         if ($insert) {
                return redirect('/sale')->with('success','Data inserted successfully!');

            }else{
                return redirect('/sale')->with('error','Ooppsss, Something went wrong!');

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
        SaleModel::where('id','=',$id)->update([
            'customer_id' => $request->customer_id,
            'greenhouse_id' => $request->greenhouse_id,
            'amount' => $request->amount,
            'installation_amount' => $request->installation_amount,
            'discount_amount' => $request->discount_amount,
            'advance_amount' => $request->advance_amount,
            'date' => $request->date,
            'updated_at' =>  date("Y-m-d h:i:s"),
            'updated_by' => Auth::user()->id
        ]);

      $insert =  PaymentModel::where('sale_id','=',$id)->update([
            'debit' => $request->amount,
            'credit' => '0',
            'type' => "Sale",
            'description' => $request->description,
            'date' => $request->date,
            'customer_id' => $request->customer_id,
            'updated_at' =>  date("Y-m-d h:i:s"),
            'updated_by' => Auth::user()->id
        ]);
        if ($insert) {
                return redirect('/sale')->with('success','Data updated successfully!');

            }else{
                return redirect('/sale')->with('error','Ooppsss, Something went wrong!');

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
        $del =  SaleModel::where('id','=',$id)->update([
            'is_deleted' => 1,
            ]);
            if ($del) {
               return 1;
            }
    }
}
