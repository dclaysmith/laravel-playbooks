<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookAction;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "lp_playbook_id" => ["required", "exists:lp_playbooks,id"],
            "lp_playbook_step_id" => ["required", "exists:lp_playbook_steps,id"],
            "condition_class_name" => ["sometimes", "nullable", "max:255"],
            "name" => ["required", "max:255"],
        ];
    }
}
