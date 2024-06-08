@extends('layouts.master')

@section('title')
    Intelligent Green House
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
      <a href="/greenhouse">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-home"></i></span>
            <div class="dash-widget-info text-right">
                <h3 style="color:rgb(100, 97, 97)">{{ \DB::table('green_house')->where('is_deleted','=','0')->get()->count() }}</h3>
                <span class="widget-title2">Greenhouse <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <a href="/customers">
            <div class="dash-widget">
            <span class="dash-widget-bg1"><i class="fa fa-user" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3 style="color:rgb(100, 97, 97)">{{ \App\Models\User::role('Customer')->get()->count() }}</h3>
                <span class="widget-title1">Customers <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <a href="/sales">
            <div class="dash-widget">
                <span class="dash-widget-bg4"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3 style="color:rgb(100, 97, 97)">{{ \DB::table('green_house')->where('is_sold','=','1')->where('is_deleted','=','0')->get()->count() }}</h3>
                    <span class="widget-title4">Sales <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
       <a href="#">
        <div class="dash-widget">
            <span class="dash-widget-bg3"><i class="fa fa-money" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3 style="color:rgb(100, 97, 97)"><i class="fa fa-money" aria-hidden="true"></i></h3>
                <span class="widget-title3">Credit <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div>
       </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
        <a href="#">
            <div class="dash-widget">
                <span class="dash-widget-bg2"><i class="fa fa-money" aria-hidden="true"></i></span>
                <div class="dash-widget-info text-right">
                    <h3 style="color:rgb(100, 97, 97)"><i class="fa fa-money" aria-hidden="true"></i></h3>
                    <span class="widget-title2">Debit <i class="fa fa-check" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
       <a href="#">
        <div class="dash-widget">
            <span class="dash-widget-bg2"><i class="fa fa-money" aria-hidden="true"></i></span>
            <div class="dash-widget-info text-right">
                <h3 style="color:rgb(100, 97, 97)"><i class="fa fa-money" aria-hidden="true"></i></h3>
                <span class="widget-title2">Balance <i class="fa fa-check" aria-hidden="true"></i></span>
            </div>
        </div></a>
    </div>
</div>
{{-- <div class="row">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Sales</h4>

                </div>
                <canvas id="linegraph"></canvas>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="chart-title">
                    <h4>Total Customers</h4>
                    <div class="float-right">

                    </div>
                </div> --}}
                    {{-- {!! $chart->container() !!} --}}

                {{-- <script src="{{ $chart->cdn() }}"></script> --}}
                {{-- {!! $chart->script() !!} --}}
                {{-- <canvas id="bargraph"></canvas> --}}
            {{-- </div>
        </div>
    </div>
</div> --}}


@endsection


@section('scripts')

@endsection
