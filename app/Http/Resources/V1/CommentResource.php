<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Skill;

class CommentResource extends JsonResource
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
            'skills_id' => $this->skills_id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
