<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ShopUsersController extends Controller
{
    //
    public function editPassword()
    {
        return view('shopuser/password');
   }

    public function updatePassword(Request $request)
    {
        //数据验证
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ],[
            'old_password.required'=>'请输入旧密码',
            'password.required'=>'请设置新密码',
            'password.confirmed'=>'两次密码输入不一致,请重新输入',
        ]);


        if(Hash::check($request->old_password,auth()->user()->password)){
            //密码正确,跳转登录页面,重新登录
            $new_password = bcrypt($request->password);
            $id = auth()->user()->id;
            ShopUser::where('id',$id)->update([
                'password'=>$new_password,
            ]);
            Auth::logout();
            //修改保存成功,跳转登录页面
            return redirect('login')->with('success','密码修改成功,请重新登录');
        }else{
            //旧密码输入不正确
            return redirect()->route('shopusers.editPassword')->with('danger','旧密码输入错误,请重新输入');
        }
   }
}
