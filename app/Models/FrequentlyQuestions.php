<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentlyQuestions extends Model
{
    use HasFactory;

    protected $table = 'frequently_questions';
   
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'contract_id',
        'template_id',
        'questions',
        'description',
        'status',
    ];
}
