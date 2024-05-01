<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractData extends Model
{
    use HasFactory;

    protected $table = 'contract_data';

    protected $fillable = [
        'contract_name',
        'template_id',
        'contract_id',
        'created_by',
        'one_coontract_status',
    ];

    public function formData()
    {
        return $this->hasMany(TemplateFieldData::class,'contract_data_id');
    }

    public function contract()
    {
        return $this->hasMany(Contract::class, 'id', 'contract_id');
    }
}
