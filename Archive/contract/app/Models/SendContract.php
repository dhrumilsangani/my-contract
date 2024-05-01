<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendContract extends Model
{
    use HasFactory;
    
    protected $table = 'send_contract';

    protected $fillable = [
        'contract_url',
        'contract_id',
        'email',
        'message',
        'created_by',
    ];
}
