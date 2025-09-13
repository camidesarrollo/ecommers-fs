<?php

namespace App\Application\DTOs;

class OrderFilterDTO
{
    public ?int $user_id;
    public ?string $status;
    public ?string $created_from;
    public ?string $created_to;
    public ?int $perPage;
    public ?int $page;

    public function __construct(array $filters = [])
    {
        $this->user_id = $filters['user_id'] ?? null;
        $this->status = $filters['status'] ?? null;
        $this->created_from = $filters['created_from'] ?? null;
        $this->created_to = $filters['created_to'] ?? null;
        $this->perPage = $filters['per_page'] ?? 15;
        $this->page = $filters['page'] ?? 1;
    }

    public function toArray(): array
    {
        return [
            'user_id'      => $this->user_id,
            'status'       => $this->status,
            'created_from' => $this->created_from,
            'created_to'   => $this->created_to,
            'perPage'      => $this->perPage,
            'page'         => $this->page,
        ];
    }
}
