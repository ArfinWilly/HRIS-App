<?php

namespace App\Models;

use App\Models\Employee;
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

    public function employee()
    {  
        return $this->belongsTo(Employee::class , 'assignedTo');
    }
}
