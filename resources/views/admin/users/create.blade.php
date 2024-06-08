{{-- \resources\views\users\create.blade.php --}}
@extends('layouts.master')
<style>
    .error{
        color: red;
    }
</style>
<style>
    #toggle_btn{
        margin-top: 1%;
    }

</style>
@section('title', '| Add User')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="container">
            <div class='col-lg-12 col-lg-offset-12'>

                <h1><i class='fa fa-user-plus'></i> Add User</h1>
                <hr>

               <form action="{{ route('users.store') }}" method="post" id="registration">
                @csrf

               <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('first_name', 'First Name') }}
                    {{ Form::text('first_name', '', array('class' => 'form-control','required' => '','placeholder' => 'Enter first name')) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('last_name', 'Last Name') }}
                    {{ Form::text('last_name', '', array('class' => 'form-control','required' => '','placeholder' => 'Enter last name')) }}
                </div>
               </div>

              <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', '', array('class' => 'form-control','required' => '','id'=> 'email','placeholder' => 'Enter email name')) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('cnic', 'CNIC') }}
                    {{ Form::text('cnic', '', array('class' => 'form-control','required','placeholder' => 'Enter cnic')) }}
                </div>
              </div>

               <div class="row">
                <div class='form-group col-6'>
                    @foreach ($roles as $role)
                        {{ Form::checkbox('roles[]',  $role->id ) }}
                        {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                    @endforeach
                </div>
               </div>
               <div class="row">
                <div class="form-group col-3">
                    {{ Form::label('phone_num', 'Phone No') }}
                    {{ Form::text('phone_num', '', array('class' => 'form-control','required' => '','placeholder' => 'Enter phone number')) }}
                </div>
                <div class="form-group col-3">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', '', array('class' => 'form-control','required' => '','placeholder' => 'Enter address')) }}
                </div>
               </div>
                <div class="row">
                    <div class="form-group col-3">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control','required' => '','placeholder' => 'Enter password')) }}

                    </div>

                    <div class="form-group col-3">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control','required' => '','placeholder' => 'Enter confirm password')) }}

                    </div>
                </div>

                {{ Form::submit('Save', array('class' => 'btn btn-primary submit-btn')) }}

               </form>

            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" type="text/javascript"></script>

<script>
      var email =  $("#email").val();
    $('#registration').validate({
        rules: {
            email: {
                required: true,
                remote: {
                    url: "{{url('user/checkemail')}}",
                    type: "post",
                    data: {
                        email:$(email).val(),
                        _token:"{{ csrf_token() }}"
                        },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        console.log(data);
                        if (json.msg == "true") {
                            return "\"" + "Email address already in use!" + "\"";
                        } else {
                            return 'true';
                        }
                    }
                }
            }
        },
        messages: {
            email: {
                required: "Email is required!",
                remote: "Email address already in use!"
            }
        }
    });
</script>
@endsection
