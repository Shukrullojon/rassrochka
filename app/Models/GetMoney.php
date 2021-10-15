<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetMoney extends Model
{
    use HasFactory;

    protected $table = 'get_money';

    protected $fillable = [
        'get_id',
        'money_type',
        'price',
        'get_date',
    ];
}
