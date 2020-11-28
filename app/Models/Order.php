<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    protected $guarded = [];
   // protected $fillable = ['clientName', 'clientTel', 'clientEmail', 'clientCountry', 'clientCity', 'clientAddress', 'clientComment', 'cart_storage', 'promo', 'total_price', 'type_pay', 'status', 'created_by', 'updated_at'];

    public function user_guest(){
        if(Auth::guest()){
            //user is a guest/visitor
            if(Session::has('user_id')){
                $uniqid = Session::get('user_id');
                $userId = $uniqid;
            }else{
                $uniqid = uniqid();
                Session::put('user_id',$uniqid);
                $userId = $uniqid;
            }
        }else{
            //user login
            $userId = Auth::id();
        }
        return $userId;
    }
}


