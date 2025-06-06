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
}
