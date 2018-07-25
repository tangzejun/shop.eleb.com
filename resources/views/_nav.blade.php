<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Eleb--Shop</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页<span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shops.index')}}">商家信息管理</a></li>
                        <li><a href="{{route('shopusers.index')}}">商家账户管理</a></li>
                        <li><a href="{{route('shop_categories.index')}}">商家类型管理</a></li>
                        <li><a href="#">帮助页</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">会员用户管理</a></li>
                        <li><a href="#">帮助页</a></li>
                    </ul>
                </li>
                <li class="active"><a href="">活动管理<span class="sr-only">(current)</span></a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" method="get" action="#">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keywords">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                {{csrf_field()}}
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('menucategories.index') }}">菜品分类</a></li>
                        <li><a href="{{ route('menus.index') }}">菜品</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">帮助页</a></li>
                    </ul>
                </li>
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('shopusers.editPassword') }}">修改密码</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <form action="{{route('logout')}}" method="post">
                            {{csrf_field()}}{{method_field('DELETE')}}
                            <button class="btn btn-link">注销</button>
                        </form>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>