@extends('default')
@section('contents')
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>菜品编号</th>
            <th>所属商家</th>
            <th>分类描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($menucategories as $menucategory)
        <tr>
            <td>{{ $menucategory->id }}</td>
            <td>{{ $menucategory->name }}</td>
            <td>{{ $menucategory->type_accumulation }}</td>
            <td>{{ $menucategory->shop->shop_name }}</td>
            <td>{{ $menucategory->description }}</td>
            <td>{{ $menucategory->is_selected==1?'是':'否' }}</td>
            <td>
                <a href="{{ route('menucategories.edit',[$menucategory]) }}">
                    <button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></button>
                </a>
                <form action="{{ route('menucategories.destroy',[$menucategory]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                </form>
                <a href="{{ route('menucategories.show',[$menucategory]) }}">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </a>
            </td>
        </tr>    
        @endforeach
        <tr>
            <td colspan="17" style="text-align: center">
                <a href="{{ route('menucategories.create') }}"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
        </tr>
    </table>
    {{ $menucategories->links() }}
@endsection