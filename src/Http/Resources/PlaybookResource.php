<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaybookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "allow_concurrent" => (bool) $this->allow_concurrent,
            "allow_multiple" => (bool) $this->allow_multiple,
            "created_at" => $this->created_at,
            "id" => (int) $this->id,
            "multiple_buffer_days" => (int)$this->multiple_buffer_days,
            "name" => $this->name,
            "updated_at" => $this->updated_at,
        ];
    }
}
