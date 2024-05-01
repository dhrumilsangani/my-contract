<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'contract';
   
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'contract_detail',
        'contract_faq',
        'contract_file',
        'status',
    ];

    public function template()
    {
        return $this->hasMany('App\Models\Template', 'contract_id', 'id');
    }

}
