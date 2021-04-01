<?php

namespace App\Http\Resources;

use App\Http\Controllers\GroupController;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'created_user' => $this->created_user,
            'users_count' => $this->users_count,
            'payments_count' => $this->payments_count,
            'is_favorite' => $this->users()->find(Auth::id())->pivot->is_favorite,
            'last_payment' => new PaymentResource($this->last_payment),

            'categories' => PaymentCategoryResource::collection($this->whenLoaded('categories')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'users' => UserResource::collection($this->whenLoaded('users')),

            'links' => [
                'show' => route('group.show', $this),
                'edit' => route('group.edit', $this),
                'toggleFavorite' => route('group.toggleFavorite', $this),
            ]
        ];
    }
}
