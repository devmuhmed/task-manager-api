<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriorityEnum;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    private $taskRepository;
    private $categoryRepository;


    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskRepository->filter($request->all());
        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $validated = $request->validated();
        $assignedTo = Arr::pull($validated,'assigned_to');

        $task = $this->taskRepository->create($validated + ['created_by' => auth()->id()]);

        $task->assignedUsers()->sync($assignedTo);
        return new TaskResource($task);
    }

    public function show($id)
    {
        $task = $this->taskRepository->find($id);
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, $id)
    {
        $validated = $request->validated();
        $assignedTo = Arr::pull($validated,'assigned_to');
        $task = $this->taskRepository->update($id, $validated);

        if($assignedTo){
            $task->assignedUsers()->sync($assignedTo);
        }
        return new TaskResource($task);
    }

    public function destroy($id)
    {
        $this->taskRepository->delete($id);
        return response()->json(['message' => 'Task deleted successfully.']);
    }

    public function changePriority(Request $request, $id)
    {
        $validated = $request->validate([
            'priority' => 'required|'.Rule::in(TaskPriorityEnum::values())
        ]);
        $task = $this->taskRepository->find($id);
        $task->priority = $validated['priority'];
        $task->save();
        return new TaskResource($task);
    }
}
