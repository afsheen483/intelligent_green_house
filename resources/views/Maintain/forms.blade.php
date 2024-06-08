@extends('layouts.master')

@section('title')
    New Maintainance Query
@endsection

@section('content')

<div class="card">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      <h5 class="title"> New Maintainance Query </h5>
    </div>
    <div class="card-body">
     @if (request()->id == 0)
       <form method="POST" action="{{ url('maintainance_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('maintainance_update',['id'=>$maintain->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 15%">
        <div class="row">
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label for="">IGH Name</label>
                <select name="green_house_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($igh_array as $igh)
                        @if($igh->id == $maintain->green_house_id)

                          <option value="{{ $igh->id }}" selected>{{ $igh->name }}</option>

                        @else
                          <option value="{{ $igh->id }}">{{ $igh->name }}</option>

                        @endif
                    @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-3 p1-5">
            <div class="form-group">
              <label for="">Customer Name</label>
              <select name="user_id" id="" class="form-control" required>
                  <option value="">Select</option>
                  @foreach ($customer_array as $arr)
                      @if($arr->id == $maintain->user_id)
                          <option value="{{ $arr->id }}" selected>{{ $arr->first_name }}{{ " " }}{{ $arr->last_name }}</option>
                      @else
                            <option value="{{ $arr->id }}">{{ $arr->first_name }}{{ " " }}{{ $arr->last_name }}</option>

                      @endif
              @endforeach
              </select>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-3 p1-5">
                <div class="form-group">
                    <label class="display-block">Work Hours</label>
                    <input class="form-control" type="number" name="work_hours"  required value="{{ is_null($maintain->work_hours) ? '' : $maintain->work_hours }}">
                </div>
            </div>
            <div class="col-md-3 p1-5">
                <div class="form-group">
                    <label class="display-block">Location</label>
                        <input class="form-control" type="text" name="location" min="1"  required placeholder="Enter location" value="{{ is_null($maintain->location) ? '' : $maintain->location }}">
                </div>
            </div>
          </div>
         <div class="row">
            <div class="col-md-6 p1-5">
                <div class="form-group">
                    <label class="display-block">Note</label>
                        <textarea name="note" id="" cols="10" rows="5" class="form-control">{{ is_null($maintain->note) ? '' : $maintain->note }}</textarea>
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 p1-5">
                <div class="form-group">
                    <label class="display-block">Feedback</label>
                        <textarea name="feedback" id="" cols="10" rows="5" class="form-control">{{ is_null($maintain->feedback) ? '' : $maintain->feedback }}</textarea>
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
