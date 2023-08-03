<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookTrigger;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "lp_playbook_id" => ["required", "exists:lp_playbooks,id"],
            "class_name" => ["required", "max:255"],
        ];
    }
}
