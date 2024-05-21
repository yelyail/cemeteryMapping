<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plotInvent extends Model
{
    use HasFactory;

    protected $table = 'tblplotinvent';
    protected $primaryKey = 'plotInventID';

    protected $fillable = [
        'ownerID',
        'cemName',
        'plotNum',
        'plotTotal',
        'plotPrice',
        'plotAvailable',
        'plotMaintenanceFee',
        'size',
        'stat',
        'establishmentDate',
        'purchaseDate',
        'renewalDate',
    ];
    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'ownerID', 'ownerID');
    }
    public function decease()
    {
        return $this->hasOne(deceaseInfo::class, 'plotInventID', 'plotInventID');
    }
    public function getStatusAttribute()
    {
        if ($this->decease) {
            return 'occupied';
        } elseif ($this->ownerID) {
            return 'reserved';
        } else {
            return 'available';
        }
        
    }
    
}