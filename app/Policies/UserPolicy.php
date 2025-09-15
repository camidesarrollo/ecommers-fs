<?php
namespace App\Policies;

use App\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view users');
    }

    public function view(User $user, User $model): bool
    {
        // Puede ver su propio perfil o si tiene permisos
        return $user->id === $model->id || $user->can('view users');
    }

    public function create(User $user): bool
    {
        return $user->can('create users');
    }

    public function update(User $user, User $model): bool
    {
        // Puede actualizar su propio perfil o si tiene permisos
        return $user->id === $model->id || $user->can('edit users');
    }

    public function delete(User $user, User $model): bool
    {
        // No puede eliminar su propia cuenta
        return $user->id !== $model->id && $user->can('delete users');
    }
}
