<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserShop extends Model
{

    protected $table='user_shops';

    protected $fillable=[
        'user_id',
        'shop_id',
        'showed_at',
        'preferred',
    ];



    
    public function shops()
    {
        return $this->hasMany(Shop::class);
    }



}
