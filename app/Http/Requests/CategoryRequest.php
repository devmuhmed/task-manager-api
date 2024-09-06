<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255|unique:categories,name,id',
            'description' => 'nullable|string',
        ];

        if ($this->isMethod('put')) {
            $rules['name'] = 'sometimes|string|max:255|unique:categories,name,'.$this->route('category');
            $rules['description'] = 'sometimes|string';
        }

        return $rules;
    }
}
