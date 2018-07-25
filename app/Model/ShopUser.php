<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ShopUser extends Authenticatable
{
    use Notifiable;
    //
    protected $fillable = ['name','email','password','rememberToken','status','shop_id','created_at]','updated_at'];

    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
