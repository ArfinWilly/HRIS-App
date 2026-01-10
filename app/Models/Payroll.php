<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes ;

    protected $fillable = [
        'employeeId',
        'salary',
        'bonuses',
        'deductions',
        'netSalary',
        'paymentDate',
    ];
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
