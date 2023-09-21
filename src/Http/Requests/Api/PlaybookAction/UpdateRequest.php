<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Requests\Api\PlaybookAction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'configuration' => $this->configuration,
        ]);
    }

    public function rules(): array
    {
        return [
            "case" => ["sometimes", "required", "max:255"],
            "configuration" => ["sometimes", "nullable", "max:255"],
            "action_class_name" => ["sometimes", "nullable", "max:255"],
            "name" => ["sometimes", "required", "max:255"],
            "sort_order" => ["sometimes", "integer"]
        ];
    }
}
