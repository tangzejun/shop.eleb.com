@extends('default')
@section('contents')

    <h1>选则年月</h1>
    <form action="{{route('order.month')}}" method="get">
        <select name="year" class="form-group">
            @for($i=0;$i<=4;$i++)
                <option value="{{date('Y')-$i}}">{{date('Y')-$i}}</option>
            @endfor
        </select>
        <select name="month">
            @for($i=1;$i<=12;$i++)
                <option value="{{$i}}">{{$i}}月</option>
            @endfor
        </select>
        <button type="submit" class="btn btn-info btn-lg">查询</button>
    </form>

    <hr>
   <h2> {{$y}}年{{$m}}月共有:</h2>

    
                        <h3><span style="color: red; text-align: center">   {{$count}}单</span></h3>
    <a href="{{route('statistics')}}"> <button class="btn btn-info btn-lg">返回</button></a>
    @stop