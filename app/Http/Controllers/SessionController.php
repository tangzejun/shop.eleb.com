<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
    public function login()
    {
        if(Auth::check()){
            //登录成功
            return redirect()->route('shops.index')->with('success','登录成功');
        }
        return view('session/index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'captcha' => 'required|captcha',
        ],[
            'name.required'=>'请输入用户名',
            'password.required'=>'请输入密码',
            'captcha.required' => '请输入验证码',
            'captcha.captcha' => '验证码错误',
        ]);
        //验证数据
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->rememberToken)){
            $status = \auth()->user()->status;
            $shop_id = \auth()->user()->shop_id;
            $shop_status = Shop::where('id',$shop_id)->value('status');
            if ($status == 0 || $shop_status <= 0){
                Auth::logout();
                return redirect()->route('login')->with('success','当前商户账号异常,暂时无法登录');
            }else{
                //验证成功
                return redirect()->route('shops.index')->with('success','登录成功');
            }
        }
        //未登录成功
        return redirect()->route('login')->with('success','用户名或密码错误,请重新登录');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','注销成功');
    }
}
