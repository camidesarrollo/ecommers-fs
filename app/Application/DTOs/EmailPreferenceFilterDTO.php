<?php

namespace App\Application\DTOs;

class EmailPreferenceFilterDTO
{
    public ?int $user_id;
    public ?bool $is_unsubscribed;
    public ?bool $marketing_emails;
    public ?bool $newsletter;
    public ?bool $promotions;
    public ?bool $product_updates;
    public ?int $perPage;
    public ?int $page;

    public function __construct(array $filters = [])
    {
        $this->user_id = $filters['user_id'] ?? null;
        $this->is_unsubscribed = $filters['is_unsubscribed'] ?? null;
        $this->marketing_emails = $filters['marketing_emails'] ?? null;
        $this->newsletter = $filters['newsletter'] ?? null;
        $this->promotions = $filters['promotions'] ?? null;
        $this->product_updates = $filters['product_updates'] ?? null;
        $this->perPage = $filters['per_page'] ?? 15;
        $this->page = $filters['page'] ?? 1;
    }

    /**
     * Crear instancia desde un array (por ejemplo: request()->all())
     */
    public static function fromArray(array $filters): self
    {
        return new self($filters);
    }

    /**
     * Convertir DTO a array usable en repositorios o queries
     */
    public function toArray(): array
    {
        return [
            'user_id'          => $this->user_id,
            'is_unsubscribed'  => $this->is_unsubscribed,
            'marketing_emails' => $this->marketing_emails,
            'newsletter'       => $this->newsletter,
            'promotions'       => $this->promotions,
            'product_updates'  => $this->product_updates,
            'perPage'          => $this->perPage,
            'page'             => $this->page,
        ];
    }
}
