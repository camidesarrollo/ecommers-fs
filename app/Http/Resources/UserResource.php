<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'phone' => $this->phone,
            'rut' => $this->rut,
            'pasaporte' => $this->pasaporte,
            'status' => $this->status,
            'avatar' => $this->avatar ? asset($this->avatar) : null,
            'roles' => $this->getRoleNames()->toArray(),
            'permissions' => $this->getAllPermissions()->pluck('name')->toArray(),
            'isAdmin' => $this->hasRole(['admin', 'super-admin']),
            'isVendor' => $this->hasRole('vendor'),
            'isCustomer' => $this->hasRole('customer'),
            'isActive' => $this->status === false,
            'createdAt' => $this->created_at?->toDateTimeString(),
            'updatedAt' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
