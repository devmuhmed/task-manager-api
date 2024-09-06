<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::Paginate(10);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function find($id)
    {
        return Task::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $task = $this->find($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        $task = $this->find($id);
        $task->delete();
    }

    public function findByCategory($categoryId)
    {
        return Task::where('category_id', $categoryId)->paginate(10);
    }

    public function findByDueDate($date)
    {
        return Task::whereDate('due_date', $date)->paginate(10);
    }

    public function findByPriority($priority)
    {
        return Task::where('priority', $priority)->paginate(10);
    }

    public function filter(array $filters)
    {
        return Task::filter($filters)->paginate(10);
    }
}
