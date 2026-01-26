<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use SoftDeletes ;
    
    protected $fillable = [
        'employeeId',
        'leaveReason',
        'startDate',
        'endDate',
        'status',
    ];
    protected $dates = ['deleted_at'] ;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
