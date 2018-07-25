<?php

namespace App\Http\Controllers;

use App\Model\Shop_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Shop_categoryController extends Controller
{
    //
    public function index()
    {
        $shop_categories = Shop_category::paginate(5);
        return view('shop_category/index',compact('shop_categories'));
    }

    public function create()
    {
        return view('shop_category/create');
    }

    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required|max:10',
            //验证码
            'captcha'=>'required|captcha'
        ],[
            'name.required'=>'分类名称不能为空',
            'name.max'=>'分类名称不能超过10个字',
            'captcha.required'=>'验证码未填写',
            'captcha.captcha'=>'验证码不正确',
        ]);
        //处理上传文件
        $file = $request->img;
        $fileName = $file->store('public/img');
        $fileName = url(Storage::url($fileName));
        //没有勾选显示就默认隐藏
        if (!$request->status){
            $request->status =0;
        }
        $model = Shop_category::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$fileName
        ]);
        return redirect()->route('shop_categories.index')->with('success','添加成功');
    }

    public function edit(Shop_category $shop_category)
    {
        return view('shop_category/edit',compact('shop_category'));
    }

    public function update(Shop_category $shop_category,Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required|max:10',
            //验证码
            'captcha'=>'required|captcha'
        ],[
            'name.required'=>'分类名称不能为空',
            'name.max'=>'分类名称不能超过10个字',
            'captcha.required'=>'验证码未填写',
            'captcha.captcha'=>'验证码不正确',
        ]);
        //没有勾选显示就默认隐藏
        if (!$request->status){
            $request->status =0;
        }
        //处理文件上传
        $file = $request->img;
        $data = [
            'name'=>$request->name,
            'status'=>$request->status,
        ];
        if($file){//有文件上传
            $fileName = $file->store('public/img');
            $fileName = url(Storage::url($fileName));
            $data['img']=$fileName;
        }
        $shop_category->update($data);
        //设置提示信息
        return redirect()->route('shop_categories.index')->with('success','更新成功');
    }

    public function destroy(Shop_category $shop_category)
    {
        $shop_category->delete();
        //设置提示信息
        return redirect()->route('shop_categories.index')->with('success','删除成功');
    }
}
