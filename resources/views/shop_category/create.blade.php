@extends('default')
@section('contents')
    <form action="{{ route('shop_categories.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput1">分类名称</label>
            <input type="text" name="name"  value="{{ old('name') }}" class="form-control" id="exampleInput1" placeholder="name">
        </div>
        <div class="form-group">
            <label>分类图片</label>
            <input type="file" name="img">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="status" value="1"> 是否显示
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