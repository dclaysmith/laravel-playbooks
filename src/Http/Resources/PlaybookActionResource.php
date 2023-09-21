<?php

namespace Dclaysmith\LaravelPlaybooks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaybookActionResource extends JsonResource
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
            "action_class_name" => $this->action_class_name,
            "case" => $this->case,
            "configuration" => $this->configuration,
            "created_at" => $this->created_at,
            "id" => (int) $this->id,
            "name" => $this->name,
            "playbook" => new PlaybookResource($this->whenLoaded("playbook")),
            "lp_playbook_id" => (int) $this->lp_playbook_id,
            "playbook_step" => new PlaybookStepResource($this->whenLoaded("playbookStep")),
            "lp_playbook_step_id" => (int) $this->lp_playbook_step_id,
            "sort_order" => (int) $this->sort_order,
            "updated_at" => $this->updated_at,
        ];
    }
}
