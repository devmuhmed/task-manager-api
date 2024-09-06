<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function findByCategory($categoryId);
    public function findByDueDate($date);
    public function findByPriority($priority);
}
