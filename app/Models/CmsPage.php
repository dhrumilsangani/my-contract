<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class CmsPage extends Model
{
    use HasFactory;

    protected $table = 'cms_page';
    use SoftDeletes;
    use sluggable;

    protected $fillable = [
        'page_title',
        'page_content',
        'page_slug',
        'status',
    ];

    public function sluggable()
    {
        return [
            'page_slug' => [
                'source' => 'page_title'
            ]
        ];
    }
}
