<?php

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Métodos para el ecommerce
    public function isAdmin(): bool
    {
        return $this->hasRole(['admin', 'super-admin']);
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('customer');
    }

    public function isVendor(): bool
    {
        return $this->hasRole('vendor');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // Para respuestas API
    public function getUserPermissions(): array
    {
        return $this->getAllPermissions()->pluck('name')->toArray();
    }

    public function getUserRoles(): array
    {
        return $this->getRoleNames()->toArray();
    }
}