<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategories extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sub_categories';

    protected $fillable = [
        'categories_id',
        'sub_categories_name',
        'status',
    ];

    public function contract()
    {
        return $this->hasMany(Contract::class,'sub_category_id');
    }
}
