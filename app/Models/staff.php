<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;
    protected $table = 'tblstaff';
    protected $primaryKey = 'staffID';
    protected $fillable = [
        'name',
        'role',
        'contactNum',
        'contactEmail',
    ];
}
