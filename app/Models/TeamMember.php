<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_member';
   
    protected $fillable = [
        'name',
        'image',
        'positions',
        'facebook',
        'twitter',
        'linkedin',
        'status',
    ];
}
