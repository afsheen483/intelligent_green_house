@extends('layouts.master')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

        <style>
            #toggle_btn{
                margin-top: 1%;
            }

        </style>
@section('title')
    Expense
@endsection

@section('content')
<div class="card">

    <div class="card-header">

             <a href="#" class="btn btn-success" style="float: right" data-toggle="modal" data-target="#newmodel">+ Add New Expense</a>
            <h6 class="card-title text-bold">Expenses</h6>


    </div>
    <div style="margin-left:2%;">
         <form id="search_date" action="get">
            @csrf
            <div class="row" >
                <div class="col-2">
                    <label for="">To Date</label>
                     <input type="date" name="to_date" id="to_date" class="form-control">
                </div>
                <div class="col-2">
                    <label for="">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
               </div>
                <div class="col-2" style="margin-top: 2.4%">
                    <button type="button" class="btn btn-success btn-lg" id="search_btn"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form> 
    </div>
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
                <div class="table-responsive">
                    <table class="table table-striped  dataTable display" id="mytable" style="width: 100%"  cellspacing="0">

                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>



            {{-- model --}}
  <div class="modal  fade" id="newmodel" tabindex="-1" role="dialog" aria-labelledby="newmodelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newmodelLabel">Add New Expense</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('expense_insert') }}" id="form" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label>Amount</label>
                            <div class="form-group">
                               <input type="text" name="amount" id="" class="form-control" placeholder="Enter amount"  required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Description</label>
                            <div class="form-group">
                               <input type="text" name="desc" id="" class="form-control" placeholder="Enter Description"  required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label>Date</label>
                            <div class="form-group">
                               <input type="date" name="date" id="" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-success">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>


    {{-- end model --}}


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

            jQuery(document).ready(function($) {

                var table =  $('#mytable').DataTable({

                destroy: true,
                "scrollX": true,
                "ordering":false,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ 50, 75, 100, "All"],


    "ajax": {
        "url": "{{ route('expense.getdata') }}",
        "type": "GET"
    },


    "columns":[


        { "data": "date" },
        { "data": "debit" },
        {"data": "description" },
        {data: 'action', name: 'action', orderable: false, searchable: false},

    ],

       createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(0)')
            .attr('id', 'date_'+data.id );
            $( row ).find('td:eq(1)')
            .attr('id','amount_'+data.id );
            $( row ).find('td:eq(2)')
            .attr('id','desc_'+data.id );




    }
});

        // search the dates
            $("#search_btn").click(function(){
                // var values = $("#search_date").serialize();
                var end_date = $("#end_date").val();
                var to_date = $("#to_date").val();
                var table =  $('#mytable').DataTable({

                destroy: true,
                "scrollX": true,
                "ordering":false,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ 50, 75, 100, "All"],
                            "ajax": {
                            "url": "{{ route('expense.search') }}",
                            "data":{
                                end_date:end_date,
                                to_date:to_date
        },
                            "type": "GET"
                            },

                "columns":[


                { "data": "date" },
                { "data": "debit" },
                {"data": "description" },
                {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
                            createdRow: function( row, data, dataIndex ) {
                            $( row ).find('td:eq(0)')
                            .attr('id', 'date_'+data.id );
                            $( row ).find('td:eq(1)')
                            .attr('id','amount_'+data.id );
                            $( row ).find('td:eq(2)')
                            .attr('id','desc_'+data.id );




                            }
                            });

            });
            });



             jQuery(document).ready(function($){
                $('#mytable').on('click', '.delete_btn', function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('expense_delete')}}/"+delete_id;
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
             });
         </script>
@endsection
