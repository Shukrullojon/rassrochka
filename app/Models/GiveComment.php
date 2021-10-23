<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveComment extends Model
{
    use HasFactory;

    protected $table = 'give_comment';

    protected $fillable = [
        'give_id',
        'comment',
        'created_at',
        'updated_at',
    ];
}

