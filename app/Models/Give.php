<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Give extends Model
{
    use HasFactory;

    protected $table = 'gives';

    protected $fillable = [
        'give_name',
        'give_time',
        'phone',
        'product_name',
        'product_lifetime',
        'lifetime_type',
        'day',
        'money_type',
        'price',
        'total_price',
        'overpayment',
        'month_pay',
        'status',
        'notification',
        'comment',
    ];

    public static $createRules = [
        'give_name' => 'required',
        'give_time' => 'required',
        'phone' => 'required',
        'product_name' => 'required',
        'product_lifetime' => 'required',
        'lifetime_type' => 'required',
        'day' => 'required',
        'money_type' => 'required',
        'price' => 'required',
        'total_price' => 'required',
        'month_pay' => 'required',
    ];

    public static $updateRules = [

    ];

    public function Money(){
        return $this->hasMany(GiveMoney::class,'give_id','id')->orderByDesc('id');
    }

    public function Com(){
        return $this->hasMany(GiveComment::class,'give_id','id')->orderByDesc('id');
    }

    public function Check($id){
        $today = date("Y-m-d");
        $giveMoney = GiveMoney::where('give_id',$id)->where('give_date',$today)->first();
        if(empty($giveMoney))
            return false;
        else
            return true;
    }
}
