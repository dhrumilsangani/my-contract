<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporarilyUser extends Model
{
    use HasFactory;

    protected $table = 'temporarily_user';
    protected $fillable = [
        'email',
        'password',
        'role_id',
    ];
}
