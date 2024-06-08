@extends('layouts.master')

@section('title')
    New Greenhouse
@endsection

@section('content')

<div class="card">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      <h5 class="title">New Greenhouse</h5>
    </div>
    <div class="card-body">
     @if (request()->id == 0)
       <form method="POST" action="{{ url('greenhouse_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('greenhouse_update',['id'=>$green_house->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 15%">
        <div class="row">
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label for="">IGH Name</label>
                <input class="form-control" type="text" name="name" placeholder="Enter IGH name" required value="{{ is_null($green_house->name) ? '' : $green_house->name }}">
            </div>
          </div>
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label for="">Mac Address</label>
                <input class="form-control" type="text" name="mac_address" placeholder="Enter mac address" required value="{{ is_null($green_house->mac_address) ? '' : $green_house->mac_address }}">
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-3 p1-5">
              <div class="form-group">
                  <label>Serial Number</label>
                  <input  type="text" name="serial_number" id="" value="{{ is_null($green_house->serial_number) ? '' : $green_house->serial_number }}" class="form-control" placeholder="Enter serial number" required>

              </div>
            </div>
            <div class="col-md-3 p1-5">
                <div class="form-group">
                    <label class="display-block">Soil Node</label>
                    <input class="form-control" type="text" name="soil_node" placeholder="Enter soil node" required value="{{ is_null($green_house->soil_nodes) ? '' : $green_house->soil_nodes }}">
                </div>
            </div>
          </div>
         <div class="row">
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label class="display-block">Temperature Node</label>
                    <input class="form-control" type="text" name="temp_node" placeholder="Enter temperature node" required value="{{ is_null($green_house->temperature_nodes) ? '' : $green_house->temperature_nodes }}">
            </div>
        </div>
            <div class="col-md-3 p1-5">
                <div class="form-group">
                    <label class="display-block">Humditiy Node</label>
                    <input class="form-control" type="text" name="humidity_node" id="" value="{{ is_null($green_house->humidity_nodes) ? '' : $green_house->humiditity_nodes }}" placeholder="Enter humidity node" required>
                </div>
              </div>
         </div>
         <div class="row">
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label class="display-block">Location</label>
                <input class="form-control" type="text" name="location" id="" value="{{ is_null($green_house->green_house_location) ? '' : $green_house->green_house_location }}" placeholder="Enter location of IGH" required>
            </div>
        </div>
            <div class="col-md-3 p1-5">
                <div class="form-group">
                    <label class="display-block">Amount</label>
                    <input class="form-control" type="text" name="amount" id="" value="{{ is_null($green_house->amount) ? '' : $green_house->amount }}" placeholder="Enter amount" required>
                </div>
            </div>
         </div>
         <div class="row">
          <div class="col-md-6 p1-5">
            <div class="form-group">
                <label class="">Customer Name</label>
                <select name="customer_name" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($customer_array as $data)
                       @if ($green_house->customer_id == $data->id)
                        <option value="{{ $data->id }}" selected>{{ $data->first_name }}{{ " " }}{{ $data->last_name }}</option>
                       @else
                        <option value="{{ $data->id }}">{{ $data->first_name }}{{ " " }}{{ $data->last_name }}</option>
                       @endif
                    @endforeach
                </select>
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
