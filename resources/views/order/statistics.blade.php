@extends('default')
@section('contents')
    <a href="{{route('order.month')}}"> <button class="btn btn-info">查询月订单</button></a>
    <a href="{{route('order.day')}}"> <button class="btn btn-info">查询详细日期订单</button></a>
    <h1>订单统计</h1>
  <h3>  今日订单总计:</h3>

    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
{{$day}}
        </div>
    </div>


    <h3> 本月订单总计:</h3>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">

           {{$month}}
        </div>
    </div>

    <h3>今年订单总计:</h3>

    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
            {{$year}}
        </div>
    </div>


    @stop