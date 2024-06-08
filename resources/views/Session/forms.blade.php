@extends('layouts.master')

@section('title')
    New Session
@endsection

@section('content')

<div class="card">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      <h5 class="title">New Session</h5>
    </div>
    <div class="card-body">
     @if (request()->id == 0)
       <form method="POST" action="{{ url('session_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('session_update',['id'=>$session->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 15%">
        <div class="row">
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label for="">Plant Name</label>
                <select name="plant_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($plant_array as $arr)
                        @if ($session->plant_id == $arr->id)
                            <option value="{{ $arr->id }}" selected>{{ $arr->plant_name }}</option>
                        @else
                        <option value="{{ $arr->id }}">{{ $arr->plant_name }}</option>

                        @endif
                    @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label for="">IGH Name</label>
                <select name="green_house_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($igh_array as $arr)
                            @if ($session->green_house_id == $arr->id)
                                <option value="{{ $arr->id }}" selected>{{ $arr->name }}</option>
                            @else
                            <option value="{{ $arr->id }}">{{ $arr->name }}</option>

                            @endif
                    @endforeach
                </select>
            </div>
          </div>
          </div>
          <div class="row">

            <div class="col-md-3 p1-5">
                <div class="form-group">
                    <label class="display-block">Start Date</label>
                    <input class="form-control" type="date" name="start_date"  required value="{{ is_null($session->start_date) ? date('Y-d-m') : $session->start_date }}">
                </div>
            </div>

          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label class="display-block">Plant Age</label>
                    <input class="form-control" type="number" name="plant_age" min="1"  required placeholder="enter plant age" value="{{ is_null($session->plant_age) ? '' : $session->plant_age }}">
            </div>
        </div>
    </div>

         <div class="row">
            <div class="col-md-6 p1-5">
                <button class="btn btn-success submit-btn">Save</button>
            </div>
         </div>
        </div>

      </form>
    </div>
</div>








@endsection

@section('scripts')
    <script>
      $(document).ready(function(){

      });
    </script>
@endsection
