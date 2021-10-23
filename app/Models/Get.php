<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Get extends Model
{
    use HasFactory;

    protected $table = 'gets';

    protected $fillable = [
        'get_name',
        'get_time',
        'phone',
        'product_name',
        'product_lifetime',
        'lifetime_type',
        'day',
        'money_type',
        'price',
        'total_price',
        'overpayment',
        'status',
        'notification',
        'comment',
    ];

    public static $createRules = [
        'get_name' => 'required',
        'get_time' => 'required',
        'phone' => 'required',
        'product_name' => 'required',
        'product_lifetime' => 'required',
        'lifetime_type' => 'required',
        'day' => 'required',
        'money_type' => 'required',
        'price' => 'required',
        'total_price' => 'required',
    ];

    public static $updateRules = [

    ];

    public function Money(){
        return $this->hasMany(GetMoney::class,'get_id','id')->orderByDesc('id');
    }

    public function Com(){
        return $this->hasMany(GetComment::class,'get_id','id')->orderByDesc('id');
    }

    public function Check($id){
        $today = date("Y-m-d");
        $getMoney = GetMoney::where('get_id',$id)->where('get_date',$today)->first();
        if(empty($getMoney))
            return false;
        else
            return true;
    }
}
