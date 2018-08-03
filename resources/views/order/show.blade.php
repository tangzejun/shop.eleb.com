@extends('default')
@section('contents')
    <style>
        span{
            color: red;
        }
    </style>
    <h1>状态
    <span>
        @if($order->status==0)
            未支付
            @elseif($order->status==-1)
            未付款,已取消
        @elseif($order->status==1)
           已支付, 待发货
        @elseif($order->status==2)
            已发货,待确认
        @elseif($order->status==3)
            完成
            @endif
        </span>
        </h1>
  @foreach($OrderGoods as $orderGood)
    <div style="border: solid">
        <h4>菜品名称:</h4>
      <span>  {{$orderGood->goods_name}}</span>
        <br>
        <h4>菜品数量:</h4>
        <span>  {{$orderGood->amount}}</span>
        <br>
        <h4>收货地址:</h4>
        <span> {{$order->city.$order->county.$order->address}}</span>
        <br>

        <h4>收件人姓名:</h4>
        <span> {{$order->name}}</span>
        <br>

        <h4>收件人电话:</h4>
        <span> {{$order->tel}}</span>
        <br>
        <h4>下单时间:</h4>
        <span> {{$orderGood->created_at}}</span>
        <br>

        <br>
    </div>
    <hr>
  @endforeach

 @if($order->status==0)
     <a href="{{route('orders.status',['status'=>-1,'id'=>$order->id])}}">   <button class="btn btn-danger"> 取消订单</button></a>
    @elseif($order->status==1)
     <a href="{{route('orders.status',['status'=>2,'id'=>$order->id])}}"> <button class="btn  btn-info">发货</button></a>
    @endif
    @stop