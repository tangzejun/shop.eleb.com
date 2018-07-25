@extends('default')
@section('contents')
    <div class="row">
        <div class="col-lg-1">
            <div class="btn-group-vertical" role="group" aria-label="...">
                <table class="table">
                    <tr>
                        <td><span style="color: #1b6d85;">菜品分类</span></td>
                    </tr>
                    <tr>
                        <td><a href="{{route('menus.index')}}"><button type="button" class="btn btn-default">全部</button></a></td>
                    </tr>
                    @foreach($menucategories as $menucategory)
                    <tr>
                        <td><a href="{{route('menus.index')}}?keyword={{$menucategory->id}}"><button type="button" class="btn btn-default">{{$menucategory->name}}</button></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-lg-11">
            <br>
            <br>
            <form class="form-inline" style="text-align: center" method="get" action="{{route('menus.index')}}">
                <div class="form-group">
                                <input type="hidden" name="keyword" value="{{$id}}">
                    <label for="exampleInputName2">菜品名</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="菜品名称" name="name">
                </div>
                &emsp;&emsp;
                <div class="form-group">
                    <label for="">价格范围</label>
                    <input type="number" class="form-control" id="exampleInputEmail2" name="min_price" placeholder="0">--
                    --<input type="number" class="form-control" id="exampleInputEmail2" name="max_price" placeholder="100">
                </div>
                <button type="submit" class="btn btn-default">&emsp;搜索&emsp;</button>
            </form>
            <br>
            <br>

            <h1 style="text-align: center">菜品信息页面</h1>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>菜品名称</th>
                    <th>评分</th>
                    <th>所属商家ID</th>
                    <th>所属分类ID</th>
                    <th>价格</th>
                    <th>描述</th>
                    <th>月销量</th>
                    <th>评分数量</th>
                    <th>提示信息</th>
                    <th>满意度数量</th>
                    <th>满意度评分</th>
                    <th>商品图片</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->goods_name}}</td>
                        <td>{{$menu->rating}}</td>
                        <td>{{$menu->shop->shop_name}}</td>
                        <td>{{$menu->menucategory->name}}</td>
                        <td>{{$menu->goods_price}}</td>
                        <td>{{$menu->description}}</td>
                        <td>{{$menu->month_sales}}</td>
                        <td>{{$menu->rating_count}}</td>
                        <td>{{$menu->tips}}</td>
                        <td>{{$menu->satisfy_count}}</td>
                        <td>{{$menu->satisfy_rate}}</td>
                        <td><img src="{{$menu->goods_img}}" alt="" style="width: 60px;"></td>
                        <td>{{ $menu->status==1?'上架':'下架' }}</td>
                        <td>
                            {{--修改--}}
                            <a href="{{route("menus.edit",[$menu])}}">
                                <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                            </a>
                            {{--删除--}}
                            <form action="{{route('menus.destroy',[$menu])}}" method="post">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{--添加--}}
                <tr>
                    <td colspan="14" style="text-align: center">
                        <a href="{{route('menus.create')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                    </td>
                </tr>
            </table>
            {{$menus->appends($id)->links()}}
        </div>

    </div>

@endsection
