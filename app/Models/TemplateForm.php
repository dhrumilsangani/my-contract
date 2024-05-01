<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateForm extends Model
{
    use HasFactory;

    protected $table = 'template_form';
   
    protected $fillable = [
        'template_id',
        'contract_id',
        'label',
        'name',
        'type',
        'meta',
        'is_required',
        'status',
    ];
}
