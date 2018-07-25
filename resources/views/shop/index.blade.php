@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>店铺分类</th>
            <th>店铺名称</th>
            <th>店铺图片</th>
            <th>店铺评分</th>
            <th>是否品牌</th>
            <th>准时送达</th>
            <th>蜂鸟配送</th>
            <th>是否保标记</th>
            <th>是否票标记</th>
            <th>是否准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>店公告</th>
            <th>优惠信息</th>
            <th>状态</th>
        </tr>
        @foreach($shops as $shop)
        <tr>
            <td>{{ $shop->id }}</td>
            <td>{{ $shop->shop_category->name }}</td>
            <td>{{ $shop->shop_name }}</td>
            <td><img src="{{ $shop->shop_img }}" width="90" alt=""></td>
            <td>{{ $shop->shop_rating }}</td>
            <td>{{ $shop->brand==1?'是':' 否' }}</td>
            <td>{{ $shop->on_time==1?'是':' 否' }}</td>
            <td>{{ $shop->fengniao==1?'是':' 否' }}</td>
            <td>{{ $shop->bao==1?'是':' 否' }}</td>
            <td>{{ $shop->piao==1?'是':' 否' }}</td>
            <td>{{ $shop->zhun==1?'是':' 否' }}</td>
            <td>{{ $shop->start_send }}</td>
            <td>{{ $shop->send_cost }}</td>
            <td>{{ $shop->notice }}</td>
            <td>{{ $shop->discount }}</td>
            <td>{{ $shop->status==1?'正常':($shop->status==0?'未审核':'禁用') }}</td>
        </tr>
        @endforeach
    </table>
@endsection