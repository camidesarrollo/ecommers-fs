<?php
/**
 * =============================================================================
 * MODELO: app/Models/StoreSetting.php
 * =============================================================================
 */

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class StoreSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'key',
        'value',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Obtener una configuración por su clave
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("store_setting_{$key}", 3600, function () use ($key, $default) {
            $setting = self::where('key', $key)
                ->where('is_active', true)
                ->first();

            return $setting?->value ?? $default;
        });
    }

    // Método helper para obtener settings activos por key
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->where('is_active', true)->first();
        return $setting ? $setting->value : $default;
    }


    /**
     * Establecer una configuración
     */
    public static function set(string $key, mixed $value, string $type = 'general'): bool
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'is_active' => true,
            ]
        );

        Cache::forget("store_setting_{$key}");
        Cache::forget('store_settings_all');

        return (bool) $setting;
    }

    /**
     * Obtener todas las configuraciones agrupadas por tipo
     */
    public static function getAllGrouped(): array
    {
        return Cache::remember('store_settings_all', 3600, function () {
            return self::where('is_active', true)
                ->get()
                ->groupBy('type')
                ->map(function ($items) {
                    return $items->pluck('value', 'key');
                })
                ->toArray();
        });
    }

    /**
     * Obtener configuraciones por tipo
     */
    public static function getByType(string $type): array
    {
        return Cache::remember("store_settings_type_{$type}", 3600, function () use ($type) {
            return self::where('type', $type)
                ->where('is_active', true)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Limpiar toda la caché de configuraciones
     */
    public static function clearCache(): void
    {
        Cache::forget('store_settings_all');
        
        $keys = self::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("store_setting_{$key}");
        }
        
        $types = self::distinct('type')->pluck('type');
        foreach ($types as $type) {
            Cache::forget("store_settings_type_{$type}");
        }
    }

    /**
     * Boot method para limpiar caché al guardar/eliminar
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($setting) {
            Cache::forget("store_setting_{$setting->key}");
            Cache::forget("store_settings_type_{$setting->type}");
            Cache::forget('store_settings_all');
        });

        static::deleted(function ($setting) {
            Cache::forget("store_setting_{$setting->key}");
            Cache::forget("store_settings_type_{$setting->type}");
            Cache::forget('store_settings_all');
        });
    }
}