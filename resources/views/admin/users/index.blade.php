{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.master')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <style>

      #toggle_btn{
          margin-top: 1%;
      }
  </style>
@section('title', 'Users')

@section('content')

<div class="col-lg-12 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> User Administration <a href="/roles" class="btn btn-default pull-right">Roles</a>
    <a href="/permissions" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%">

            <thead>
                <tr>

                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>CNIC</th>
                    <th>Phone Number</th>
                    <th>Date/Time Added</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody></tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success submit-btn">Add User</a>

</div>

@endsection

@section('scripts')
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
            "url": "{{ route('user.getdata') }}",
            "type": "GET",
        },

        "columns":[
            { "data": "first_name" },
            { "data": "email" },
            { "data": "address" },
            { "data": "cnic"},
            { "data": "phone_num" },
            { data: "created_at",name: 'created_at' },
            { "data": "name" },
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ],

     });
     $('#mytable').on('click', '.check_btn', function () {
          var id = $(this).data("check");
          console.log(id);
          var url = "{{url('active_status_user')}}/"+id;

                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Congratulations!',
                                text:'User has been deactivated successfully!',
                                type: 'success',
                              })
                              location.reload();
                         }if(data == 0){
                            Swal.fire({
                                title:'Congratulations!',
                                text:'User has been activated successfully!',
                                type: 'success',
                              })
                              location.reload();
                         }

                        }

              });

        });

        $('#mytable').on('click', '.delete_btn', function () {
          var delete_id = $(this).data("delete");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('user_delete')}}/"+delete_id;
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
                        type : 'DELETE',
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
