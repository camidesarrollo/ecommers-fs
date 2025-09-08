<?php

namespace App\Application\Category\DTOs;

class CategoryFilterDTO
{
    public ?string $name;
    public ?bool $is_active;
    public ?int $parent_id;
    public ?int $perPage;
    public ?int $page;

    public function __construct(array $filters = [])
    {
        $this->name = $filters['name'] ?? null;
        $this->is_active = $filters['is_active'] ?? null;
        $this->parent_id = $filters['parent_id'] ?? null;
        $this->perPage = $filters['per_page'] ?? 15;
        $this->page = $filters['page'] ?? 1;
    }
}
