<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaybookAudienceResource extends JsonResource
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
            "exit_action" => $this->exit_action,
            "id" => (int) $this->id,
            "playbook" => new PlaybookResource($this->whenLoaded("playbook")),
            "lp_playbook_id" => (int) $this->lp_playbook_id,
            "updated_at" => $this->updated_at,
        ];
    }
}
