<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Domain\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Listar usuarios (solo admins)
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $users = User::with(['roles', 'permissions'])
            ->when($request->role, function ($query, $role) {
                return $query->role($role);
            })
            ->when($request->search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate($request->per_page ?? 15);

        return response()->json([
            'success' => true,
            'data' => $users->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'status' => $user->status,
                    'roles' => $user->getUserRoles(),
                    'permissions' => $user->getUserPermissions(),
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ];
            })
        ]);
    }

    // Crear usuario
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'status' => 'active',
        ]);

        // Asignar roles
        if ($request->roles) {
            $user->assignRole($request->roles);
        } else {
            $user->assignRole('customer');
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'status' => $user->status,
                'roles' => $user->getUserRoles(),
                'permissions' => $user->getUserPermissions(),
            ],
            'message' => 'Usuario creado exitosamente'
        ], 201);
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'status' => 'sometimes|in:active,inactive,suspended',
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name'
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'status']));

        // Actualizar roles si se proporcionan
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'status' => $user->status,
                'roles' => $user->getUserRoles(),
                'permissions' => $user->getUserPermissions(),
            ],
            'message' => 'Usuario actualizado exitosamente'
        ]);
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuario eliminado exitosamente'
        ]);
    }

    // Asignar rol específico
    public function assignRole(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);

        $user->assignRole($request->role);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user->name,
                'roles' => $user->getUserRoles(),
            ],
            'message' => 'Rol asignado exitosamente'
        ]);
    }

    // Remover rol específico
    public function removeRole(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);

        $user->removeRole($request->role);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $user->name,
                'roles' => $user->getUserRoles(),
            ],
            'message' => 'Rol removido exitosamente'
        ]);
    }
}