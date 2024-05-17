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
        'maintainRec_ID',
        'transactRef',
        'transactType',
        'totalCost',
        'transactDateTime',
    ];
    public function maintenanceRecord()
    {
        return $this->belongsTo(MaintenanceRecord::class, 'maintainRec_ID', 'maintainRec_ID');
    }
    
}
