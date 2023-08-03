<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaybookTriggerResource extends JsonResource
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
            "updated_at" => $this->updated_at,
            "class_name" => $this->class_name,
            "id" => (int) $this->id,
            "playbook" => new PlaybookResource($this->whenLoaded("playbook")),
            "playbook_id" => (int) $this->playbook_id,
            "updated_at" => $this->updated_at,
        ];
    }
}
