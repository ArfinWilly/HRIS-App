<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presence extends Model
{
    use SoftDeletes, HasFactory ;
    
    protected $fillable = [
        'employeeId',
        'date',
        'checkIn',
        'checkOut',
        'status',
    ];
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
