<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// Standards Facades
use Hash;


class FakeController extends Controller
{
    //

    /**
     * Uplaod Data For First uses (Create new User,Collections of shops ...)
     */
    public function dumpData(){

        $user  = \App\User::create([
        'email'=>'contact@domain.fr',
        'password'=>Hash::make('root'),
        ]);
        dump('An user was created '.$user->email);


        for($i=0;$i<10;$i++){
            $shop = \App\Shop::create([
                'title'=>'Shop number '.$i,
                'picture'=>'shop/shop.jpg',
                'distance'=>$i+7,
                'showed_at'=>null
            ]);
        }
        dump(\App\Shop::count().' shops were created');

    }

}
