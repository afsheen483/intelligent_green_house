{{-- \resources\views\permissions\create.blade.php --}}
@extends('layouts.master')

@section('title', '| Create Permission')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Add Permission</h1>
    <br>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) 
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}

        @endforeach
    @endif
    <br>
    {{ Form::submit('Save', array('class' => 'btn btn-primary submit-btn')) }}

    {{ Form::close() }}

</div>

@endsection