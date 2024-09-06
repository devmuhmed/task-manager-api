<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date->toDateString(),
            'status' => $this->status,
            'priority' => $this->priority,
            'category_id' => $this->category_id,
            'category' => CategoryResource::make($this->category),
        ];
    }
}
