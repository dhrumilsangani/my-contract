<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Content extends Model
{
    use HasFactory;

    protected $table = 'content';
    use sluggable;

    protected $fillable = [
        'title',
        'content',
        'content_slug',
        'status',
    ];

    public function sluggable()
    {
        return [
            'content_slug' => [
                'source' => 'title'
            ]
        ];
    }
}
