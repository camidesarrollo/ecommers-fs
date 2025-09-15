<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'avatar' => $this->avatar ? asset($this->avatar) : null, // URL completa
            'roles' => $this->getRoleNames()->toArray(), // Roles asignados
            'permissions' => $this->getAllPermissions()->pluck('name')->toArray(), // Permisos completos
            'isAdmin' => $this->hasRole(['admin', 'super-admin']),
            'isVendor' => $this->hasRole('vendor'),
            'isCustomer' => $this->hasRole('customer'),
            'isActive' => $this->status === 'active',
            'createdAt' => $this->created_at?->toDateTimeString(),
            'updatedAt' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
