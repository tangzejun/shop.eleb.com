<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //设置权限
    protected $fillable = ['goods_name','rating','shop_id','category_id','goods_price','description','month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'];

    //设置关联
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id','id');
    }

    public function menucategory(){
        return $this->belongsTo(MenuCategory::class,'category_id','id');
    }
}
