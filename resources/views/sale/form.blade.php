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
       <form method="POST" action="{{ url('sale_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('sale_update',['id'=>$data->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 15%">
        <div class="row">
          <div class="col-md-4 p1-5">
            <div class="form-group">
                <label class="">Customer Name</label>
                <select name="customer_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($customer_array as $cust)
                       @if ($data->customer_id == $cust->id)
                        <option value="{{ $cust->id }}" selected>{{ $cust->first_name }}{{ " " }}{{ $cust->last_name }}</option>
                       @else
                        <option value="{{ $cust->id }}">{{ $cust->first_name }}{{ " " }}{{ $cust->last_name }}</option>
                       @endif
                    @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-4 p1-5">
            <div class="form-group">
                <label class="">Greenhouse Name</label>
                <select name="greenhouse_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($igh_array as $igh)
                       @if ($data->greenhouse_id == $igh->id)
                        <option value="{{ $igh->id }}" selected>{{ $igh->name }}</option>
                       @else
                        <option value="{{ $igh->id }}">{{ $igh->name }}</option>
                       @endif
                    @endforeach
                </select>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-4 p1-5">
              <div class="form-group">
                  <label>Amount</label>
                  <input  type="text" name="amount" id="" value="{{ is_null($data->amount) ? '' : $data->amount }}" class="form-control" placeholder="Enter amount" required>

              </div>
            </div>
            <div class="col-md-4 p1-5">
                <div class="form-group">
                    <label class="display-block">Installation Amount</label>
                    <input class="form-control" type="text" name="installation_amount" placeholder="Enter installation_amount" required value="{{ is_null($data->installation_amount) ? '' : $data->installation_amount }}">
                </div>
            </div>
          </div>
         <div class="row">
          <div class="col-md-4 p1-5">
            <div class="form-group">
                <label class="display-block">Discount Amount</label>
                    <input class="form-control" type="text" name="discount_amount" placeholder="Enter discount amount" required value="{{ is_null($data->discount_amount) ? '' : $data->discount_amount }}">
            </div>
        </div>
            <div class="col-md-4 p1-5">
                <div class="form-group">
                    <label class="display-block">Advance amount</label>
                    <input class="form-control" type="text" name="advance_amount" id="" value="{{ is_null($data->advance_amount) ? '' : $data->advance_amount }}" placeholder="Enter humidity node" required>
                </div>
              </div>
         </div>
         <div class="row">
          <div class="col-md-8 p1-5">
            <div class="form-group">
                <label class="display-block">Date</label>
                <input class="form-control" type="date" name="date" id="" value="{{ is_null($data->date) ? date('Y-d-m') : $data->date }}" placeholder="Enter location of IGH" required>
            </div>
        </div>
         </div>
         <div class="row">
          <div class="col-md-8 p1-5">
              <label for="">Description</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ is_null($data->date) ? '' : $data->description }}</textarea>
        </div>
         </div>
<br>
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
