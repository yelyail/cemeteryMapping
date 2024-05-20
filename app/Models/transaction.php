<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'tbltransaction';

    protected $primaryKey = 'transactID';
    protected $fillable =[
        'deceaseID',
        'transactRef',
        'transactType',
        'totalCost',
        'transactDateTime',
    ];
    public function deceaseInfo()
    {
        return $this->belongsTo(deceaseInfo::class, 'deceaseID', 'deceaseID');
    }
    
}
