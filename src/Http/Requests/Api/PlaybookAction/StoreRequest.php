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
            "case" => ["required", "max:255"],
            "configuration" => ["sometimes", "json", "max:255"],
            "action_class_name" => ["required",  "max:255"],
            "name" => ["required", "max:255"],
            "sort_order" => ["required", "integer"]
        ];
    }
}
