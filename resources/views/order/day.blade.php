@extends('default')
@section('contents')
    <h1>选则详细日期</h1>
    <form action="{{route('order.day')}}" method="get">
        <input type="date" name="date" >
        <input type="submit" value="查询">

    </form>
    <h2> {{$date}}共有:</h2>


    <h3><span style="color: red; text-align: center">  {{$count}}单</span></h3>
    <a href="{{route('statistics')}}"> <button class="btn btn-info btn-lg">返回</button></a>


    @stop