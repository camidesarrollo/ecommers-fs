<?php

namespace App\Application\DTOs;

class CategoryDTO
{
    public ?int $id;
    public string $name;
    public string $slug;
    public ?string $bgClass;
    public ?string $description;
    public ?string $image;
    public int $sort_order;
    public bool $is_active;
    public ?int $parent_id;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->slug = $data['slug'];
        $this->bgClass = $data['bgClass'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->image = $data['image'] ?? null;
        $this->sort_order = $data['sort_order'] ?? 0;
        $this->is_active = $data['is_active'] ?? true;
        $this->parent_id = $data['parent_id'] ?? null;
    }

    /**
     * Crear DTO desde un array (por ejemplo: request validated).
     */
    public static function fromArray(array $data): self
    {
        return new self([
            'id'          => $data['id'] ?? null,
            'name'        => $data['name'],
            'slug'        => $data['slug'],
            'bgClass'     => $data['bg_class'] ?? $data['bgClass'] ?? null,
            'description' => $data['description'] ?? null,
            'image'       => $data['image'] ?? null,
            'sort_order'  => $data['sort_order'] ?? 0,
            'is_active'   => $data['is_active'] ?? true,
            'parent_id'   => $data['parent_id'] ?? null,
        ]);
    }

    /**
     * Retorna un array listo para guardar o actualizar
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'bg_class'    => $this->bgClass, // 👈 aquí lo devolvemos en snake_case para BD
            'description' => $this->description,
            'image'       => $this->image,
            'sort_order'  => $this->sort_order,
            'is_active'   => $this->is_active,
            'parent_id'   => $this->parent_id,
        ];
    }
}
