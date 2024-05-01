<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    use HasFactory;

    protected $table = 'payment_details';

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'transaction_id',
        'transaction_status',
        'payment_session_id',
        'payment_type',
        'currency'
    ];
}
