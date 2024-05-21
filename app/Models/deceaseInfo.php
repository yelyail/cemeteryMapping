<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deceaseInfo extends Model
{
    use HasFactory;
    protected $table = 'tbldeceaseinfo';
    protected $primaryKey = 'deceaseID';
    protected $fillable = [
        'plotInventID',
        'firstName',
        'middleName',
        'lastName',
        'gender',
        'reason',
        'remarks',
        'statusDec',
        'bornDate',
        'diedDate',
        'burialDate',
    ];
    public function plotInvent()
    {
        return $this->belongsTo(plotInvent::class, 'plotInventID', 'plotInventID');
    }
}
