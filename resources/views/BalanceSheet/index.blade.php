@extends('layouts.master')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <style>

            #toggle_btn{
                margin-top: 1%;
            }
        </style>
@section('title')
        Balance Sheet
@endsection


@section('content')


<div class="row">
    <div class="col-md-8 col-sm-8 col-lg-8 col-xl-4">
        <a href="" data-toggle="modal" data-target="#exampleModalLong" id="cash_out">
            <div class="dash-widget">
                <span class="dash-widget-bg5"><i class="fa fa-arrow-up" aria-hidden="true" style="margin-top: 14%"></i></span>
                <div class="dash-widget-info text-right">
                    <span class="widget-title5">DEBIT</span>
                    <h3 style="color: #666;margin-top:6%" class="debit_total"></h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <a href="" data-toggle="modal" data-target="#exampleModalLong" id="cash_in">
            <div class="dash-widget">
                <span class="dash-widget-bg2" ><i class="fa fa-arrow-down" aria-hidden="true" style="margin-top: 14%"></i></span>
                <div class="dash-widget-info text-right">
                    <span class="widget-title2">CREDIT</span>
                    <h3 style="color: #666;margin-top:6%" class="credit_total"></h3>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <a href="\balance_sheet">
            <div class="dash-widget">
                <span class="dash-widget-bg4"><i class="fas fa-dollar-sign" aria-hidden="true" style="margin-top: 14%"></i></span>
                <div class="dash-widget-info text-right">

                    <span class="widget-title4">Balance</span>
                    <h3 style="color: #666;margin-top:6%" class="balance"></h3>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Modal -->
<form action="/save_transaction" method="POST">
    @csrf
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="text" name="ledger_id" id="ledger_id" hidden>

                    <div class="form-group">

                        <select name="customer_id" id="customer_id" class="form-control">
                            <option value="">Select Customer</option>
                            @foreach ($customer_array as $arr)
                            <option value="{{ $arr->id }}">{{ $arr->first_name }}{{ " " }}{{ $arr->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label>Amount</label>
                    <div class="form-group">
                        <input class="form-control" type="text" id="credit" name="amount" value="" required>
                    </div>
                    <label>Description</label>
                    <div class="form-group">
                        <input class="form-control" type="text" id="credit" name="desc" value="" required>
                    </div>
                    <label>Date</label>
                    <div class="form-group">
                        <input class="form-control" type="date" id="date1" name="date1" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


{{-- Main Content --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @elseif ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>

                    @endif


                    {{-- <div class="row">
                        <label for="">Customer</label>
                        <select name="customer_id" id="cust_id" class="form-control col-2" required style="margin-left: 1%">
                                <option value="">Select a Customer</option>
                                @foreach ($customer_array as $array)
                                    <option value="{{ $array->id }}">{{ $array->first_name }}{{ " " }}{{ $array->last_name }}</option>
                                @endforeach
                        </select>

                    </div> --}}

                    <div class="">
                        <form action="get">
                            @csrf
                            <div class="row" style="margin-left:%;margin-top:-1%">
                                <div class="col-2">
                                    <label for="">To Date</label>
                                     <input type="date" name="to_date" id="to_date" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label for="">End Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control">
                               </div>
                                <div class="col-2" style="margin-top: 2.4%">
                                    <button type="button" class="btn btn-success btn-lg" id="search_btn"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br> 
                <table id="mytable" class="table table-striped  dataTable display" style="width: 100%"  cellspacing="0">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th style="color: red">Debit <i class="fa fa-arrow-up" aria-hidden="true"></i></th>
                            <th style="color: green">Credit <i class="fa fa-arrow-down" aria-hidden="true"></i></th>
                            <th style="color: yellowgreen">Balance $</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>



@endsection
@section('scripts')
<script>
    var $j = jQuery.noConflict();
</script>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
       <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
       <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
       <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
       <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        var sum = 0;
        var sum2 = 0;
        var balance = 0;
        var table =  $('#mytable').DataTable({

                destroy: true,
                "scrollX": true,
                "ordering":false,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ 50, 75, 100, "All"],


    "ajax": {
        "url": "{{ route('balance_sheet.balancedata') }}",
        "type": "GET"
    },


    "columns":[


        { "data": "customer_name" },
        { "data": "type" },
        { "data": "date" },
        {"data": "description" },
        { "data": "debit"},
        { "data": "credit" },
        { "data": "feedback" },
        {data: 'action', name: 'action', orderable: false, searchable: false},

    ],
    createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(4)')
            .attr('id', 'debit_'+data.id );
            $( row ).find('td:eq(4)')
            .attr('class', 'debit');
            $( row ).find('td:eq(5)')
            .attr('class','credit');
            $( row ).find('td:eq(6)')
            .attr('id','balance_'+data.id );
            //console.log(data);
            $(data).each(function(e) {
        // alert(data.debit);
         sum += Number(data.debit);
         sum2 += Number(data.credit);
         balance = Number(balance) - Number(data.debit);
    balance = Number(balance) + Number(data.credit);
//alert(balance);
    $("#balance_"+data.id).text(balance);
    $( row ).find('td:eq(6)')
            .text(balance);
});

//alert(sum);
    $(".debit_total").text(sum.toFixed(2));
    $(".credit_total").text(sum2.toFixed(2));
    $(".balance").text(balance.toFixed(2));

    }


});


    // for search between two date and for specific date also
    $("#search_btn").click(function(){
            var end_date = $("#end_date").val();
            var to_date = $("#to_date").val();
                var sum = 0;
        var sum2 = 0;
        var balance = 0;
        var table =  $('#mytable').DataTable({

                destroy: true,
                "scrollX": true,
                "ordering":false,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ 50, 75, 100, "All"],


    "ajax": {
        "url": "{{ route('balance_sheet.search') }}",
        "type": "GET",
        "data":{
            end_date:end_date,
            to_date:to_date
        },
    },


    "columns":[


        { "data": "customer_name" },
        { "data": "type" },
        { "data": "date" },
        {"data": "description" },
        { "data": "debit"},
        { "data": "credit" },
        { "data": "feedback" },
        {data: 'action', name: 'action', orderable: false, searchable: false},

    ],
    createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(4)')
            .attr('id', 'debit_'+data.id );
            $( row ).find('td:eq(4)')
            .attr('class', 'debit');
            $( row ).find('td:eq(5)')
            .attr('class','credit');
            $( row ).find('td:eq(6)')
            .attr('id','balance_'+data.id );
            //console.log(data);
            $(data).each(function(e) {
        // alert(data.debit);
         sum += Number(data.debit);
         sum2 += Number(data.credit);
         balance = Number(balance) - Number(data.debit);
    balance = Number(balance) + Number(data.credit);
//alert(balance);
    $("#balance_"+data.id).text(balance);
    $( row ).find('td:eq(6)')
            .text(balance);
});

//alert(sum);
    $(".debit_total").text(sum.toFixed(2));
    $(".credit_total").text(sum2.toFixed(2));
    $(".balance").text(balance.toFixed(2));

    }


});

    });


        $('#mytable').on('click','.delete_btn',function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('ledger_delete')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();

                            }
                          else{
                                Swal.fire({
                                    title: 'Oopps!',
                                    text: "something went wrong!",
                                    type: 'warning',
                          			})
                          		}
                         }

                        });
                }
              });

        });



    jQuery('a').click(function () {

    if (this.id == 'cash_in') {
        var cash_in = 1;
                $('#ledger_id').val(cash_in);
                $('#exampleModalLongTitle').text('New Cash In');
    }
    else if (this.id == 'cash_out') {
        $('#ledger_id').val("");
                var cash_out = 0;
                $('#ledger_id').val(cash_out);
                $('#exampleModalLongTitle').text('New Cash Out');
    }
});

       var balance = 0;
$("#mytable,.debit,.credit").each(function(){
    var id = $(this).data("debit");
    var credit = $("#credit_"+id).text();
    var debit = $("#debit_"+id).text();
    // console.log(id);
    balance = Number(balance) - Number(debit);
    balance = Number(balance) + Number(credit);
    //console.log(sub);
    //$("#balance_"+id).text(balance);

});
});



//     var balance = 0;

//    for (var i = 0; i < data.length; i++) {
//        var id = data[i][0];
//        //alert(id);
//        balance =  balance - Number(data[i][5]);
//        balance = Number(balance) + Number(data[i][6]) ;
//        console.log("debit"+balance);
//        $('td:eq(7)', row).html( balance );

//    }


</script>
@endsection
