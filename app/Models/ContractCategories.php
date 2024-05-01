<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractCategories extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'contract_categories';

    protected $fillable = [
        'categories_name',
        'image',
        'status',
    ];

    public function subCategories()
    {
            return $this->hasMany(SubCategories::class,'categories_id');
    }
}
