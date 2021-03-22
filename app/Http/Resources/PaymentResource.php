<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'amount' => $this->amount,
            'created_at' => $this->created_at->format('d.m.Y H:i'),
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => PaymentCategoryResource::collection($this->whenLoaded('category')),
        ];
    }
}
