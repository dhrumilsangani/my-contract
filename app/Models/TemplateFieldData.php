<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateFieldData extends Model
{
    use HasFactory;
    protected $table = 'template_field_data';
    protected $fillable = [
        'contract_data_id',
        'field_id',
        'template_id',
        'meta_key',
        'meta_value',
    ];
}
