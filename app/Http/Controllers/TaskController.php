<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

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
        $task = $this->taskRepository->create($request->validated());
        return new TaskResource($task);
    }

    public function show($id)
    {
        $task = $this->taskRepository->find($id);
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, $id)
    {
        $task = $this->taskRepository->update($id, $request->validated());
        return new TaskResource($task);
    }

    public function destroy($id)
    {
        $this->taskRepository->delete($id);
        return response()->json(['message' => 'Task deleted successfully.']);
    }
}
