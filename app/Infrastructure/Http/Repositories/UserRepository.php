<?php

namespace App\Infrastructure\Http\Repositories;

use App\Application\Services\MailService;
use App\Domain\Models\User;
use App\Domain\RepositoriesInterface\UserRepositoryInterface;
use App\Application\DTOs\UserDTO;
use App\Application\DTOs\UserFilterDTO;
use App\Application\DTOs\EmailPreferenceDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Infrastructure\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Google_Client;

class UserRepository implements UserRepositoryInterface
{
    protected Builder $model;

    public function __construct()
    {
        $this->model = User::query();
    }

    /**
     * Listar usuarios con filtros y paginación
     */
    public function list(array|UserFilterDTO $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        if ($filters instanceof UserFilterDTO) {
            $filters = $filters->toArray();
        }

        $query = $this->model->newQuery();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', "%{$filters['email']}%");
        }

        if (!empty($filters['role'])) {
            $query->whereHas('roles', function (Builder $q) use ($filters) {
                $q->where('name', $filters['role']);
            });
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status'] ? true : false);
        }

        $perPage = $filters['perPage'] ?? $perPage;

        return $query->paginate($perPage);
    }

    /**
     * Crear un usuario
     */
    public function create(array|UserDTO $data): User
    {
        if ($data instanceof UserDTO) {
            $data = $data->toArray();
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->status = $data['status'] ?? false;
        $user->avatar = $data['avatar'] ?? null;
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        if (!empty($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    /**
     * Actualizar un usuario
     */
    public function update(int|User $id, array|UserDTO $data): User
    {
        $user = $id instanceof User ? $id : $this->findById($id);

        if (!$user) {
            throw new \Exception("Usuario no encontrado.");
        }

        if ($data instanceof UserDTO) {
            $data = $data->toArray();
        }

        $user->fill([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
            'status' => $data['status'] ?? $user->status,
            'avatar' => $data['avatar'] ?? $user->avatar,
        ]);

        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    /**
     * Buscar un usuario por ID
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Eliminar usuario (soft delete)
     */
    public function delete(int $id): bool
    {
        $user = $this->findById($id);
        if (!$user) {
            return false;
        }
        return $user->delete();
    }

    /**
     * Restaurar usuario eliminado
     */
    public function restore(int $id): ?User
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            return $user;
        }
        return null;
    }

    /**
     * Obtener todos los usuarios activos
     */
    public function all(): Collection
    {
        return User::where('status', true)->get();
    }

    /**
     * Paginación genérica
     */
    public function paginate($modelo, $perPage): LengthAwarePaginator
    {
        // Si es un Query Builder
        if ($modelo instanceof \Illuminate\Database\Eloquent\Builder) {
            $query = $modelo;
        }
        // Si es un string que representa un modelo
        elseif (is_string($modelo) && class_exists($modelo)) {
            $query = $modelo::query();
        }
        // Por defecto usamos Category::query()
        else {
            $query = User::query();
        }

        return $query->paginate($perPage);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function register(array|UserDTO $data): User
    {
        // 1️⃣ Convertir a DTO si viene como array
        if (is_array($data)) {
            $data = UserDTO::fromArray($data);
        }

        // 2️⃣ Crear el usuario
        $user = $this->create($data);

        // 3️⃣ Asignar roles
        if (!empty($data->roles)) {
            $user->syncRoles($data->roles);
        }

        // 4️⃣ Asignar permisos directos
        if (!empty($data->permissions)) {
            $user->syncPermissions($data->permissions);
        }

        // 5️⃣ Crear automáticamente EmailPreference
        $emailPreferenceRepository = new EmailPreferenceRepository();

        $emailPreferenceDTO = new EmailPreferenceDTO([
            'user_id'          => $user->id,
            'unsubscribe_token' => null, // se generará automáticamente en el modelo
            'marketing_emails' => true,
            'order_emails'     => true,
            'newsletter'       => true,
            'promotions'       => true,
            'product_updates'  => true,
            'is_unsubscribed'  => false,
            'unsubscribed_at'  => null,
        ]);

        $emailPreferenceRepository->create($emailPreferenceDTO);

        // 6️⃣ Enviar correo de bienvenida
        $mailService = new MailService();
        $mailService->sendWelcomeEmail($data->email, $data->name, "BIENVENIDO15");

        return $user;
    }


    /**
     * Login de usuario
     * @param string $email
     * @param string $password
     * @param string|null $deviceName
     * @return array|null
     * @throws \Exception
     */

    public function login(string $email, string $password, ?string $deviceName = null): array
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            throw new \Exception("Usuario no encontrado.");
        }

        if (!$user->isActive()) {
            throw new \Exception("El usuario está inactivo.");
        }

        if (!Hash::check($password, $user->password)) {
            throw new \Exception("Contraseña incorrecta.");
        }

        // Crear token de acceso
        $token = $user->createToken($deviceName ?? 'default_device')->plainTextToken;

        return [
            'user' => new UserResource($user), // Usa el resource para ocultar campos sensibles
            'token' => $token,
        ];
    }

    public function loginGoogle(array $data): array
    {
        $token = $data['token'] ?? null;
        $deviceName = $data['device_name'] ?? 'default_device';

        if (!$token) {
            throw new \Exception("Token de Google requerido.");
        }

        $client = new \Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($token);

        if (!$payload) {
            throw new \Exception("Token de Google inválido.");
        }

        $email = $payload['email'];
        $name = $payload['name'];

        // Buscar usuario
        $user = self::findByEmail($email);

        $isNewUser = false;

        if (!$user) {
            // Crear usuario con DTO
            $dto = new \App\Application\DTOs\UserDTO([
                'name' => $name,
                'email' => $email,
                'password' => \Illuminate\Support\Str::random(16),
                'status' => true
            ]);

            $user = self::register($dto);
            $isNewUser = true;
        }

        // Generar token Sanctum
        $token = $user->createToken($deviceName)->plainTextToken;

        return [
            'user' => \App\Application\DTOs\UserDTO::fromModel($user),
            'token' => $token,
            'isNewUser' => $isNewUser
        ];
    }
}
