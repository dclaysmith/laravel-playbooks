<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaybookStepResource extends JsonResource
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
            "created_at" => $this->created_at,
            "condition_class_name" => $this->condition_class_name,
            "id" => (int) $this->id,
            "name" => $this->name,
            "playbook" => new PlaybookResource($this->whenLoaded("playbook")),
            "lp_playbook_id" => (int) $this->lp_playbook_id,
            "sort_order" => (int) $this->sort_order,
            "updated_at" => $this->updated_at,
        ];
    }
}
