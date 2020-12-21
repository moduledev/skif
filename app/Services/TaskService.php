<?php


namespace App\Services;


use App\Models\Task;

class TaskService extends BaseService
{
    public $task;

    public function __construct(Task $task)
    {
        parent::__construct($task);
        $this->task = $task;
    }
}
