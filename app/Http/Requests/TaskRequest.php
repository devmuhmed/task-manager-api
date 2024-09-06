<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'status' => 'required|string|'.Rule::in(TaskStatusEnum::values()),
            'priority' => 'required|string|'.Rule::in(TaskPriorityEnum::values()),
            'category_id' => 'required|exists:categories,id',
        ];

        if ($this->isMethod('put')) {
            $rules['title'] = 'sometimes|string|max:255';
            $rules['description'] = 'sometimes|string';
            $rules['due_date'] = 'sometimes|date';
            $rules['status'] = 'sometimes|string|'.Rule::in(TaskStatusEnum::values());
            $rules['priority'] = 'sometimes|string|'.Rule::in(TaskPriorityEnum::values());
            $rules['category_id'] = 'sometimes|exists:categories,id';
        }

        return $rules;
    }
}
