<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Standards Facades
use Validator;
use Auth;
use Carbon\Carbon;

class ShopController extends Controller
{
    
    /**
     * Constructor to auto login the first user 
     */
    public function __construct()
    {
        $user = \App\User::first();
        if($user){
            if(!Auth::user())
            Auth::login($user);
        }else
        dd("Please type this link 'localhost:8000/fake-data' first !");
    }

    /**
     * Get preffered page with it's shops collection / nearbies one
     * 
     */
    public function getMain()
    {
        // fields to display
        $fields=[
            'shops.id AS id',
            'shops.title AS title',
            'shops.picture AS picture',
            'shops.distance AS distance',
        ];
        // get shops collection (not the liked ones, date)
        $shops = \App\Shop::leftJoin('user_shops','user_shops.shop_id','shops.id')
        ->where('user_shops.showed_at','<=',Carbon::now()->subHour(2))
        ->orWhere('user_shops.showed_at','=',null)
        ->orWhere('user_shops.prefered',false)
        ->orderBy('shops.distance')
        ->select($fields)
        ->get();
        return view('nearby')->with('shops',$shops);
    }

    /**
     * Get preffered page with it's shops collection / nearbies one
     * 
     */
    public function getPreffered()
    {
        // fields to display
        $fields=[
            'shops.id AS id',
            'shops.title AS title',
            'shops.picture AS picture',
            'shops.distance AS distance',
        ];
        // get shops collection (  )
        $shops = \App\Shop::leftJoin('user_shops','user_shops.shop_id','shops.id')
        ->where('user_shops.preferred',true)
        ->orderBy('shops.distance')
        ->select($fields)
        ->get();
        return view('preferred')
        ->with('shops',$shops);
    }

    /**
     * Like a shop 
     */
    public function likeShop(Request $request)
    {
       // Validate comming data
       $validator = Validator::make($request->all(),[
           'id'=>'required|exists:shops,id'
       ]);
       
       //check existence or create new one with necessary updates
       if($liked_shop = \App\UserShop::where('shop_id',$request->id)->first())
       $liked_shop->update([
           'preferred'=>true,
       ]);
       else
       \App\UserShop::create([
        'user_id'=>Auth::user()->id,
        'shop_id'=>$request->id,
        'showed_at'=>null,
        'preferred'=>true,
       ]);

        // return json response 
        return response()->json('great its done', 200);

    }

    /**
     * Dislike a shop 
     */
    public function dislikeShop(Request $request)
    {
        // Validate comming data
        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:shops,id'
        ]);

        //check existence and update it (update the showed_at field so it won't be shown within next 2 hours)
        if($disliked_shop = \App\UserShop::where('shop_id',$request->id)->first())
        $disliked_shop->update([
        'showed_at'=>Carbon::now()
        ]);

        // return json response 
        return response()->json('great its done', 200);
    }

   /**
     * Remove a shop from preferred list
     * 
     */
    public function removePreferred(Request $request)
    {
        // Validate comming data
        $validator = Validator::make($request->all(),[
            'id'=>'required|exists:shops,id'
        ]);

        //check existence and update it (update the preferred field so it won't be shown in preferred list)
        if($disliked_shop = \App\UserShop::where('shop_id',$request->id)->first())
        $disliked_shop->update([
            'preferred'=>false
        ]);
        
        // return json response 
        return response()->json('great its done', 200);
    }

}
