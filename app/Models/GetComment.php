<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetComment extends Model
{
    use HasFactory;
    
    protected $table = 'get_comment';
    
    protected $fillable = [
        'get_id',
        'comment',
        'created_at',
        'updated_at',
    ];
}
