<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmendAgreement extends Model
{
    use HasFactory;

    protected $table = 'amend_agreement';

    protected $fillable = [
        'contract_data_id',
        'amend_agreement',
        'amend_header',
        'amend_content',
    ];
}
