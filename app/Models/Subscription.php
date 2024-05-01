<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    
    protected $fillable = [
        'user_id',
        'total_amount',
        'from_date',
        'to_date',
        'type',
        'status',
    ];
}
