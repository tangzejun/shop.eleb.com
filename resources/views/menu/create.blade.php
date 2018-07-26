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
    <h1>添加菜品</h1>
    @include('_error')
    <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInput1">菜品名称</label>
            <input type="text" name="goods_name"  value="{{ old('goods_name') }}" class="form-control" id="exampleInput1" placeholder="goods_name">
        </div>
        <div class="form-group">
            <label for="exampleInput1">菜品评分</label>
            <input type="text" name="rating"  value="{{ old('rating') }}" class="form-control" id="exampleInput1" placeholder="rating">
        </div>
        <div class="form-group">
            <label for="exampleInput1">所属商家</label>
            <input type="text" name="shop_id"  value="{{ auth()->user()->shop_id }}" class="form-control" id="exampleInput1" placeholder="rating" readonly>
        </div>
        <div class="form-group">
            <label for="exampleInput1">所属分类</label>
            <select name="category_id" class="form-control">
                @foreach($menucategories as $menucategory)
                    <option value="{{ $menucategory->id }}">{{ $menucategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInput1">菜品价格</label>
            <input type="decimal" name="goods_price"  value="{{ old('goods_price') }}" class="form-control" id="exampleInput1" placeholder="goods_price">
        </div>
        <div class="form-group">
            <label for="exampleInput6">菜品描述</label>
            <textarea class="form-control" rows="3" name="description" placeholder="description">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInput1">月销量</label>
            <input type="text" name="month_sales"  value="{{ old('month_sales') }}" class="form-control" id="exampleInput1" placeholder="month_sales">
        </div>
        <div class="form-group">
            <label for="exampleInput1">评分数量</label>
            <input type="text" name="rating_count"  value="{{ old('rating_count') }}" class="form-control" id="exampleInput1" placeholder="rating_count">
        </div>
        <div class="form-group">
            <label for="exampleInput1">提示信息</label>
            <input type="text" name="tips"  value="{{ old('tips') }}" class="form-control" id="exampleInput1" placeholder="tips">
        </div>
        <div class="form-group">
            <label for="exampleInput1">满意度数量</label>
            <input type="text" name="satisfy_count"  value="{{ old('satisfy_count') }}" class="form-control" id="exampleInput1" placeholder="satisfy_count">
        </div>
        <div class="form-group">
            <label for="exampleInput1">满意度评分</label>
            <input type="text" name="satisfy_rate"  value="{{ old('satisfy_rate') }}" class="form-control" id="exampleInput1" placeholder="satisfy_rate">
        </div>
        <div class="form-group">
            <label>菜品图片</label>
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
        <div class="checkbox">
            <label>
                <input type="checkbox" name="status" value="1"> 上架
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