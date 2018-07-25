@extends('default')
@section('contents')
    <h1>修改密码</h1>
    <form action="{{ route('shopusers.updatePassword') }}" method="post">
        @include('_error')
        <div class="form-group">
            <label for="exampleInput1">名称</label>
            <input type="text" name="name"  value="{{auth()->user()->name}}" class="form-control" id="exampleInput1" placeholder="name" readonly>
        </div>
        <div class="form-group">
            <label for="examplePassword">旧密码</label>
            <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">确认密码</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Password">
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