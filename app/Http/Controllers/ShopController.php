<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\Shop_category;
use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //列表
    public function index()
    {
        $shops = Shop::paginate(5);
        return view('shop/index',compact('shops'));
    }

    //添加
    public function create()
    {
        $shops = Shop::all();
        //获取分类
        $shop_categories = Shop_category::all();
        return view('shop/create',compact('shop_categories','shops'));
    }

    //添加保存
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required|max:20|unique:shop_users',
            'email'=>'required|email|unique:shop_users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'shop_id'=>'required',
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:20|unique:shops',
            'start_send'=>'required|numeric',
            'send_cost'=>'required|numeric',
            'notice'=>'required|max:200',
            'discount'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'名称不能为空',
            'name.max'=>'名称长度不能大于20位',
            'name.unique'=>'该名称已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已存在',
            'password.required'=>'密码必须填写',
            'password.min'=>'密码长度不能小于6位',
            'password_confirmation.required'=>'请确认密码',
            'password.confirmed'=>'两次输入密码不一致',
            'shop_id.required'=>'所属商户必须选择',
            'shop_category_id.required'=>'店铺所属类型必选',
            'shop_name.required'=>'店铺名称必填',
            'shop_name.max'=>'店铺名称最大不能超过20个字符',
            'shop_name.unique'=>'店铺名称不能重复',
            'start_send.required'=>'起送金额必填',
            'start_send.numeric'=>'起送金额必须为数字',
            'send_cost.numeric'=>'配送金额必须为数字',
            'send_cost.required'=>'配送费必须填写',
            'notice.required'=>'店公告必须填写',
            'notice.max'=>'店公告最大字数不能超过200',
            'discount.required'=>'店铺优惠信息必须填写',
            'captcha.required' => '请填写验证码',
            'captcha.captcha' => '验证码错误',

        ]);
        if (!$request->brand){
            $request->brand =0;
        }
        if (!$request->on_time){
            $request->on_time =0;
        }
        if (!$request->fengniao){
            $request->fengniao =0;
        }
        if (!$request->bao){
            $request->bao =0;
        }
        if (!$request->piao){
            $request->piao =0;
        }
        if (!$request->zhun){
            $request->zhun =0;
        }
        //处理上传文件
//        $file = $request->shop_img;
//        $fileName = $file->store('public/shop_img');
//        $fileName = url(Storage::url($fileName));
        $storage = Storage::disk('oss');
        $fileName = $storage->putFile('shop',$request->shop_img);
        DB::beginTransaction();
        try{
            $shops = Shop::create([
                'shop_category_id'=>$request->shop_category_id,
                'shop_name'=>$request->shop_name,
                'shop_img'=>$storage->url($fileName),
                'shop_rating'=>$request->shop_rating,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'status'=>0
            ]);
           $shopusers = ShopUser::create([
               'name'=>$request->name,
               'email'=>$request->email,
               'password'=>bcrypt($request->password),
               'status'=>0,
               'shop_id'=>$request->shop_id
           ]);
           if ($shops &&  $shopusers){
               DB::commit();
               return redirect()->route('shops.index')->with('success','添加成功');
           }
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->route('shops.create')->with('success','添加成功');
        }
    }
}
