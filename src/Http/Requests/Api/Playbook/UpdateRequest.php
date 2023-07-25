<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\Page;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "allow_concurrent" => ["sometimes", "required", "boolean"],
            "allow_multiple" => ["sometimes", "required", "boolean"],
            "multiple_buffer_days" => ["sometimes", "nullable", "integer"],
            "name" => ["sometimes", "required", "max:255"],
        ];
    }
}
