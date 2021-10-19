<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveMoney extends Model
{
    use HasFactory;

    protected $table = 'give_money';

    protected $fillable = [
        'give_id',
        'price',
        'give_date',
        'money_type',
    ];
}
