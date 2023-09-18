<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'title',
        'agreementNumber',
        'agreementType',
        'partner',
        'unit',
        'signDate',
        'startDate',
        'endDate',
        'fileName',
    ];

    protected $keyType = 'string';

    public $incrementing = false;
}
