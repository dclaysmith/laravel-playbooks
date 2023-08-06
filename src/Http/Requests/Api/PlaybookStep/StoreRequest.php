<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookStep;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "lp_playbook_id" => ["required", "exists:lp_playbooks,id"],
            "condition_class_name" => ["sometimes", "nullable", "max:255"],
            "name" => ["required", "max:255"],
        ];
    }
}
