@extends('layouts.master')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        <style>
            #toggle_btn{
                margin-top: 1%;
            }

        </style>
@section('title')
Plant Fertilizer
@endsection

@section('content')
<div class="card">

    <div class="card-header">

       <a href="plant_fertilizer_form/0" class="btn btn-success" style="float: right">+ Add New Plant's Fertilizer</a>
             <h6 class="card-title text-bold">Fertilizer List</h6>

    </div>
    <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped  dataTable display" id="mytable" style="width: 100%"  cellspacing="0">

                    <thead>
                        <tr>
                            <th>Plant Name</th>
                            <th>Fertilizer Name</th>
                            <th>Quantity</th>
                            <th>Time Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>

            $(document).ready(function() {

                var table =  $('#mytable').DataTable({

                destroy: true,
                "scrollX": true,
                "ordering":false,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ 50, 75, 100, "All"],


    "ajax": {
        "url": "{{ route('plant_fertilizer.getdata') }}",
        "type": "GET"
    },


    "columns":[


        { "data": "plant_name" },
        { "data": "fertilizer_name" },
        { "data": "quantity" },
        { "data": "time_duration" },
        {data: 'action', name: 'action', orderable: false, searchable: false},

    ],

});


            });
</script>




         <script>
             $(document).ready(function(){
                $('#mytable').on('click', '.delete_btn', function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('plant_fertilizer_delete')}}/"+delete_id;
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
