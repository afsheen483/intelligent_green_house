@extends('layouts.master')

@section('title')
New Add Fertilizer
@endsection

@section('content')

<div class="card">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      <h5 class="title">New Add Fertilizer</h5>
    </div>
    <div class="card-body">
     @if (request()->id == 0)
       <form method="POST" action="{{ url('fertilizer_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('fertilizer_update',['id'=>$plant_info->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 2%">
        <div class="row">

              <div class="col-md-3 p1-5">
                <div class="form-group">
                  <label>Fertilizer Name</label>
                  <input type="text" name="fertilizer_name" required class="form-control" placeholder="Request value" value="{{ is_null($plant_info->fertilizer_name) ? '' :  $plant_info->fertilizer_name}}">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6 p1-5">
                <button class="btn btn-success submit-btn">Save</button>
            </div>
         </div>





      </form>
    </div>
</div>








@endsection

@section('scripts')
    <script>
      $(document).ready(function(){
        // $("#add").click(function(){
        //     $("#hide").toggle();
        // });
      });
    </script>
@endsection
