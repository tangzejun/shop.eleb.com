@extends('default')
@section('css_files')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

@stop
@section('js_files')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@section('contents')
    <h1>注册商家账号</h1>
    <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
        @include('_error')
        <div class="form-group">
            <label for="exampleInput1">名称</label>
            <input type="text" name="name"  value="{{ old('name') }}" class="form-control" id="exampleInput1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">确认密码</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2" placeholder="Password">
        </div>
        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <br>
    <h1>添加商家信息</h1>
        <div class="form-group">
            <label for="exampleInput1">店铺名称</label>
            <input type="text" name="shop_name"  value="{{ old('shop_name') }}" class="form-control" id="exampleInput1" placeholder="shop_name">
        </div>
        <div class="form-group">
            <label>店铺分类</label>
            <select name="shop_category_id" class="form-control">
                @foreach($shop_categories as $shop_category)
                    <option value="{{ $shop_category->id }}">{{ $shop_category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>店铺图片</label>
            <input type="hidden" name="img" id="img_url">
        {{--<input type="file" name="img">--}}
        <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="img" width="90">
        </div>
        <div class="form-group">
            <label for="exampleInput2">店铺评分</label>
            <input type="text" name="shop_rating"  value="{{ old('shop_rating') }}" class="form-control" id="exampleInput2" placeholder="shop_ratinge">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="brand" value="1"> 是否品牌
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="on_time" value="1"> 是否准时达
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="fengniao" value="1"> 是否蜂鸟配送
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="bao" value="1"> 是否保标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="piao" value="1"> 是否票标记
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="zhun" value="1"> 是否准标记
            </label>
        </div>
        <div class="form-group">
            <label for="exampleInput3">起送金额</label>
            <input type="number" name="start_send"  value="{{ old('start_send') }}" class="form-control" id="exampleInput3" placeholder="start_send">
        </div>
        <div class="form-group">
            <label for="exampleInput4">配送费</label>
            <input type="number" name="send_cost"  value="{{ old('send_cost') }}" class="form-control" id="exampleInput4" placeholder="send_cost">
        </div>
        <div class="form-group">
            <label for="exampleInput5">店公告</label>
            {{--<input type="text" name="notice"  value="{{ old('notice') }}" class="form-control" id="exampleInput5" placeholder="notice">--}}
            <textarea class="form-control" rows="3" name="notice" placeholder="notice">{{ old('notice') }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInput6">优惠信息</label>
            {{--<input type="text" name="notice"  value="{{ old('notice') }}" class="form-control" id="exampleInput6" placeholder="notice">--}}
            <textarea class="form-control" rows="3" name="discount" placeholder="discount">{{ old('discount') }}</textarea>

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

@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,


            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{ route('upload') }}",


            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:"{{ csrf_token() }}"
            }
        });
        console.debug(11);

        uploader.on('uploadSuccess',function (file,response) {
            console.log(response)

            $('#img').attr('src',response.fileName)
            $('#img_url').val(response.fileName)
        });
    </script>
@endsection