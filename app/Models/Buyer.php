<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $table = 'tblowner';
    protected $primaryKey = 'ownerID'; 
    protected $fillable = [
        'fullName',
        'contactNum',
        'email',
        'address',
    ];
    public function plotInvent()
    {
        return $this->hasMany(plotInvent::class, 'ownerID', 'ownerID');
    }
}