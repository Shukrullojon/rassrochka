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

    ];

    public static $updateRules = [

    ];

    public function Money(){
        return $this->hasMany(GetMoney::class,'get_id','id');
    }
}
