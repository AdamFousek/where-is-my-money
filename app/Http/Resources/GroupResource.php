<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'created_at' => $this->created_at->format('d.m.Y H:i'),
            'created_user' => new UserResource($this->createdUser),
            'user_count' => count($this->users),
            'is_favorite' => $this->whenPivotLoaded('group_user', function () {
                return $this->pivot->is_favorite;
            }),
            'payment' => $this->whenLoaded('payments', function() {
                return new PaymentResource($this->payments()->latest()->first());
            }),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
