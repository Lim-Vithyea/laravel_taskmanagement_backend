<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertask extends Model
{
    use HasFactory;
    protected $table = 'user_task';

    protected $fillable = [
        'task_title',
        'task_desc',
        'start_date',
        'end_date',
        'employee_id',
        'status',
        'priority_task',
    ];
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status');
    }

    public function priority()
    {
        return $this->belongsTo(TaskPriorities::class, 'priority_task');
    }
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
