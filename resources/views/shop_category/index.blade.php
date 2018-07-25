@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shop_categories as $shop_category)
        <tr>
            <td>{{ $shop_category->id }}</td>
            <td>{{ $shop_category->name }}</td>
            <td><img src="{{ $shop_category->img }}" width="90" alt=""></td>
            <td>{{ $shop_category->status==1?'显示':'隐藏' }}</td>
            <td>
                <a href="{{ route('shop_categories.edit',[$shop_category]) }}">
                    <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                </a>
                <form action="{{ route('shop_categories.destroy',[$shop_category]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: center">
                <a href="{{ route('shop_categories.create') }}"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
        </tr>
    </table>
    {{ $shop_categories->links() }}
@endsection