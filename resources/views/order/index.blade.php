@extends('default')
@section('contents')
    <style>
        a{
            text-decoration:none;
            color:white;
        }

    </style>




    <table class="table table-bordered table-responsive">
        <tr>
            <th>订单编号</th>
            <th>	详细地址</th>
            <th>收货人姓名</th>
            <th>收货人电话</th>
            <th>		价格</th>
            <th>下单时间</th>
            <th>订单状态</th>
            <th>操作</th>

        </tr>
        @foreach($orders as $order)


            <tr>
                <td>{{$order->sn}}</td>
                <td>{{$order->city}}{{$order->county}}{{$order->address}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->created_at}}</td>
                <td>@if ($order->status==0)
                        待支付
                        @elseif($order->status==-1)
                    已取消
                    @elseif($order->status==1)
                    待发货
                    @elseif($order->status==2)
                    待确认
                    @elseif($order->status==3)
                    完成
                    @endif

                </td>
               <td><a href="{{route('orders.show',$order->id)}}"><button class="btn">详情</button></a></td>

                {{--<td>--}}

                    {{--<button class="btn btn-warning btn-xs"> <a href="{{route('MenuCategries.edit',[$MenuCategrie->id])}}">修改</a></button>--}}
                    {{--<form action="{{route('MenuCategries.destroy',[$MenuCategrie->id])}}" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--{{ method_field('DELETE') }}--}}
                        {{--<button type="submit"  class="btn   btn-danger btn-xs">删除</button>--}}
                    {{--</form>--}}

                {{--</td>--}}
            </tr>
        @endforeach
        {{--<tr >--}}
            {{--<td colspan="6">--}}
                {{--<button class="btn btn-block"><a href="{{route('MenuCategries.create')}}">增加菜品</a></button>--}}
        {{--</td>--}}

        {{--</tr>--}}
        <tr >
            <td colspan="8">
                <a href="{{route('statistics')}}"><button class="btn-block btn btn-info">查看统计</button></a>
            </td>
        </tr>

    </table>



    @stop