@extends('default')
@section('contents')
    <h1>添加菜品分类</h1>
    @include('_error')
    <form action="{{ route('menucategories.store') }}" method="post">
        <div class="form-group">
            <label for="exampleInput1">分类名称</label>
            <input type="text" name="name"  value="{{ old('name') }}" class="form-control" id="exampleInput1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInput6">分类描述</label>
            <textarea class="form-control" rows="3" name="description" placeholder="description">{{ old('description') }}</textarea>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_selected" value="1"> 是否默认分类
            </label>
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@endsection