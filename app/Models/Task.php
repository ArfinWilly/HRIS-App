<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'assignedTo',
        'dueDate',
        'status',
    ];
    protected $dates = ['deleted_at'];

    public function getDueDateAttribute($value)
    {
        $result = Carbon::createFromFormat('Y-m-d', $value)->diffForHumans(now());

        return $result;
    }

    public function employee()
    {  
        return $this->belongsTo(Employee::class , 'assignedTo');
    }
}
