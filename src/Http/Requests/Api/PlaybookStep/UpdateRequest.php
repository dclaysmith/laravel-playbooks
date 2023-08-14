<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookStep;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "condition_class_name" => ["sometimes", "nullable", "max:255"],
            "name" => ["sometimes", "required", "max:255"],
            "sort_order" => ["sometimes", "integer"]
        ];
    }
}
