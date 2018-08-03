<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //设置权限
    protected $fillable = ['status'];

    public function member()
    {
        return $this->belongsTo(Member::class,'user_id','id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
