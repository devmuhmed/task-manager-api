<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePriorityRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\CategoryService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
class TaskController extends Controller
{
    private $taskService;
    private $categoryService;


    public function __construct(TaskService $taskService, CategoryService $categoryService)
    {
        $this->taskService = $taskService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->filter($request->all());
        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $assignedTo = Arr::pull($validated,'assigned_to');

        $task = $this->taskService->create($validated + ['created_by' => auth()->id()]);

        $task->assignedUsers()->sync($assignedTo);
        return new TaskResource($task);
    }

    public function show($id)
    {
        $task = $this->taskService->find($id);
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, $id)
    {
        $validated = $request->validated();
        $assignedTo = Arr::pull($validated,'assigned_to');
        $task = $this->taskService->update($id, $validated);

        if($assignedTo){
            $task->assignedUsers()->sync($assignedTo);
        }
        return new TaskResource($task);
    }

    public function destroy($id)
    {
        $this->taskService->delete($id);
        return response()->json(['message' => 'Task deleted successfully.']);
    }

    public function changePriority(ChangePriorityRequest $request, $id)
    {
        $task = $this->taskService->changePriority($id, $request->validated());
        return new TaskResource($task);
    }
}
