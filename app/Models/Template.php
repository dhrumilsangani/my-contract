<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'template';
   
    protected $fillable = [
        'contract_id',
        'template_name',
        'form_json_data',
        'status',
    ];

    public function contract()
    {
        return $this->hasMany('App\Models\Contract', 'id', 'contract_id');
    }

    public function templateForm()
    {
            return $this->hasMany(TemplateForm::class,'template_id');
    }

    public function templateQuestions()
    {
            return $this->hasMany(FrequentlyQuestions::class,'template_id');
    }

}
