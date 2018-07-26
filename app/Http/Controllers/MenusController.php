<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenusController extends Controller
{
    ////验证是否登录
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $menucategories = MenuCategory::all();
        $id = $_GET['keyword']??'';
        $name = $_GET['name']??'';
        $max = $_GET['max_price']??'';
        $min = $_GET['min_price']??'';
        //判断是否根据类型查找
        if($id){
            //判断根据类型查询后,根据名字模糊查询
            if($name != null){
                //根据名字后,再根据金额
                if($max != null && $min != null){
                    $menus = Menu::where('goods_name','like',"%{$name}%")
                        ->where('category_id',$id)
                        ->where('goods_price','<',$max)
                        ->where('goods_price','>',$min)
                        ->paginate(5);
                }else{
                    $menus = Menu::where('goods_name','like',"%{$name}%")
                        ->where('category_id',$id)
                        ->paginate(5);
                }
                //根据金额查找
            }elseif ($max != null && $min != null){
                $menus = Menu::where('goods_name','like',"%{$name}%")
                    ->where('category_id',$id)
                    ->where('goods_price','<',$max)
                    ->where('goods_price','>',$min)
                    ->paginate(5);
                //不根据名字,也不根据金额
            }else{
                //echo 111;
                $menus = Menu::where('category_id',$id)->paginate(5);
            }
        }elseif ($name){
            //echo 222;
            $menus = Menu::where('goods_name','like',"%{$name}%")->paginate(5);
        }elseif ($max != null && $min != null){
            // echo 333;
            $menus = Menu::where('goods_price','>',$min)
                ->where('goods_price','<',$max)
                ->paginate(1);
        }else{
            // echo 444;
            $menus = Menu::paginate(5);
        };
        return view('menu/index',['menucategories'=>$menucategories,'menus'=>$menus,'id'=>$id]);
    }

    public function create()
    {
        $menucategories = MenuCategory::all();
        return view('menu/create',compact('menucategories'));
    }

    public function store(Request $request)
    {
        //数据验证
        $request->validate([
            'goods_name'=>'required|max:20',
            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required|max:50',
            'tips'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'goods_name.required'=>'菜品名称必须输入',
            'goods_name.max'=>'菜品名称必须小于20个字符',
            'goods_price.required'=>'价格必须输入',
            'description.required'=>'必须输入菜品描述',
            'tips.required'=>'提示信息必须输入',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if (!$request->status){
            $request->status =0;
        }
        //处理上传文件
//        $file = $request->goods_img;
//        $fileName = $file->store('public/goods_img');
//        $fileName = url(Storage::url($fileName));
//        $storage = Storage::disk('oss');
//        $fileName = $storage->putFile('menu',$request->goods_img);
        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>$request->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$request->month_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'goods_img'=>$request->img,
            'status'=>$request->status,
        ]);
        return redirect()->route('menus.index')->with('success','添加成功');
    }

    public function edit(Menu $menu)
    {
        $menucategories = MenuCategory::all();
        return view('menu/edit',compact('menu','menucategories'));
    }

    public function update(Menu $menu,Request $request)
    {
        //数据验证
        $request->validate([
            'goods_name'=>'required|max:20',
            'category_id'=>'required',
            'goods_price'=>'required',
            'description'=>'required|max:50',
            'tips'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'goods_name.required'=>'菜品名称必须输入',
            'goods_name.max'=>'菜品名称必须小于20个字符',
            'goods_price.required'=>'价格必须输入',
            'description.required'=>'必须输入菜品描述',
            'tips.required'=>'提示信息必须输入',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);
        if (!$request->status){
            $request->status =0;
        }
        //处理上传文件
        if($request->img != null){
            $fillName = $request->img;
        }else{
            $fillName = $request->old_img;
        }
        $menu->update([
            'goods_name'=>$request->goods_name,
            'rating'=>$request->rating,
            'shop_id'=>$request->shop_id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>$request->month_sales,
            'rating_count'=>$request->rating_count,
            'tips'=>$request->tips,
            'satisfy_count'=>$request->satisfy_count,
            'satisfy_rate'=>$request->satisfy_rate,
            'goods_img'=>$fillName,
            'status'=>$request->status,
        ]);
        //设置提示信息
        return redirect()->route('menus.index')->with('success','更新成功');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','删除成功');
    }
}
