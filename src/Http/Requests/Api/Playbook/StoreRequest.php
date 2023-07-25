<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\Playbook;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "allow_concurrent" => ["sometimes", "boolean"],
            "allow_multiple" => ["sometimes", "boolean"],
            "multiple_buffer_days" => ["sometimes", "integer"],
            "name" => ["required", "max:255"],
        ];
    }
}
