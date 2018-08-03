<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //判断是否登录
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //return Auth::user()->id;
        $orders=Order::where('shop_id',Auth::user()->shop_id)->get();
        return view('Order/index',['orders'=>$orders]);
    }

    public function show(Order $order)
    {

        $OrderGoods=OrderGood::where('order_id',$order->id)->get();
        return view('Order/show',['OrderGoods'=>$OrderGoods,'order'=>$order]);
    }

    public function status(Request $request)
    {
        $order= Order::find($request->id);
        $order->update([
            'status'=>$request->status
        ]);
        if ($request->status==-1){
            $a='取消成功';
        }else {
            $a='发货成功';
        }
        session()->flash('success', $a);
        return redirect('orders');

    }
    //统计
    public function statistics()
    {
        $day= Order::where('created_at','>',date('Y-m-d  00:00:00',time()))->count();//本日
        $monthtime=mktime(0,0,0,date('m'),1,date('Y'));//当前月时间
        $month= Order::where('created_at','>',date('Y-m',$monthtime))->count();//月
        $yeartiame = mktime(0,0,0,1,1,date('Y'));
        $year= Order::where('created_at','>',date('Y',$yeartiame))-> count();
        return view('Order/statistics',['day'=>$day,'month'=>$month,'year'=>$year]);

    }

    public function month(Request $request)
    {
        $m=date('m');
        $y=date('Y');
        if ($request->month){
            $m=$request->month;
        }
        if ($request->year){
            $y=$request->year;
        }
        //当前月时间
        $monthtime=mktime(0,0,0,$m,1,$y);
        //当前年
//        $yeartiame = mktime(0,0,0,1,1,date('Y'));
//        $year= Order::where('created_at','>',date('Y',$yeartiame))-> count();
        $count= Order::where('created_at','>',date('Y-m',$monthtime))
            ->where('created_at','<',date('Y-m',mktime(0,0,0,$m+1,1,$y)))

            ->count();//月
        return view('Order/month',['m'=>$m,'y'=>$y,'count'=>$count]);

    }

    public function day(Request $request)
    {
        $date=date('Y-m-d',time());
        $time=mktime(0,0,0,date('m'),date('d'),date('Y'));

        if ($request->date){

            $time  = strtotime($request->date);

            $date  = $request->date;
        }
        $count= Order::where('created_at','>',date('Y-m-d',$time))
            ->where('created_at','<',date('Y-m-d',$time+(3600*24)))
            ->count();
        return view('order/day',['date'=>$date,'count'=>$count]);
    }

}
