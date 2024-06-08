@extends('layouts.master')

@section('title')
    Edit Expense
@endsection

@section('content')
   
<div class="card">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      <h4 class="title">Edit Expense <i class="fa fa-pencil"></i></h4>
    </div>
    <div class="card-body">

    <form method="POST" action="{{ url('expense_update',['id'=>$data->id])}}">
      @csrf
      @method('PUT')

      <div class="container" style="margin-left: 15%">
        <div class="row">
            <div class="col-6">
                <label>Amount</label>
                <div class="form-group">
                   <input type="text" name="amount" id="" class="form-control" placeholder="Enter amount"  required value="{{ $data->debit }}">
                </div>
            </div>
        </div>
          
        
         
        <div class="row">
            <div class="col-6">
                <label>Description</label>
                <div class="form-group">
                    <textarea name="desc" id="" cols="30" rows="10" class="form-control">{{ $data->description }}</textarea>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-6">
                <label>Date</label>
                <div class="form-group">
                   <input type="date" name="date" id="" class="form-control" value="{{ $data->date }}" required>
                </div>
            </div>
        </div>
         
         <div class="row">
            <div class="col-md-6 p1-5">
                <button class="btn btn-success submit-btn">Update</button>
            </div>
         </div>
        </div>
   
      </form>
    </div>
</div>
  






    
@endsection

@section('scripts')
 
@endsection