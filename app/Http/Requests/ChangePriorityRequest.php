<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangePriorityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'priority' => 'required|'.Rule::in(TaskPriorityEnum::values())
        ];
    }
}
