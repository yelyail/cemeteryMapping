<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenanceRecord extends Model
{
    use HasFactory;
    protected $table = 'tblmaintenance';

    protected $primaryKey = 'maintainRec_ID';
    protected $fillable =[
        'staffID',
        'deceaseID',
        'maintenanceName',
        'maintainDescription',
        'renewalPeriod',
        'amount',
        'renewalPaymentDate',
    ];
    public function stafftbl()
    {
        return $this->belongsTo(User::class, 'staffID', 'staffID');
    }

    public function decease()
    {
        return $this->belongsTo(DeceaseInfo::class, 'deceaseID', 'deceaseID');
    }
}
