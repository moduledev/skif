<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->all();
        return view('admin.task.index', compact('tasks'));
    }

    public function create()
    {

        return view('admin.task.create');
    }

    public function edit($id)
    {
        return view('admin.task.edit', compact('id'));
    }

    public function update($id, Request $request)
    {
        $this->taskService->update($id, $request);
    }

    public function delete($id)
    {
        $this->taskService->delete($id);
    }

    public function store(Request $request)
    {
        $task = $this->taskService->create($request);
        return response()->json(['success' => "Задача $task->name была успешно добавлена"]);
    }

    public function getTasks()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * @param int
     * @return TaskResource
     */
    public function getTask($id)
    {
        return new TaskResource(Task::findOrFail($id));
    }
}
