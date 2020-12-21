<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'task_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function childrenTasks()
    {
        return $this->hasMany(Task::class)->with('tasks');
    }
}
