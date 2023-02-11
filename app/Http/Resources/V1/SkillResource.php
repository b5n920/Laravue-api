<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class SkillResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'owner' => User::find($this->user_id)->name,
            'name' => $this->name,
            'slug' => $this->slug,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
