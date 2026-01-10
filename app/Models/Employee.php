<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fullName',
        'email',
        'phoneNumbe',
        'birthDate',
        'hireDate',
        'departmentId',
        'roleId',
        'status',
        'salary',
    ];
    protected $dates = ['deleted_at'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assignedTo');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employeeId');
    }

    public function presence()
    {
        return $this->hasMany(Presence::class, 'employeeId');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employeeId');
    }
}
