<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookAudience;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "lp_playbook_id" => ["required", "exists:lp_playbooks,id"],
            "class_name" => ["required", "max:255"],
            "exit_action" => ["required", "max:255", "in:CONTINUE,CANCEL"],
        ];
    }
}
