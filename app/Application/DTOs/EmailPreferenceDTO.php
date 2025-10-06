<?php

namespace App\Application\DTOs;

class EmailPreferenceDTO
{
    public ?int $id;
    public int $user_id;
    public string $unsubscribe_token;
    public bool $marketing_emails;
    public bool $order_emails;
    public bool $newsletter;
    public bool $promotions;
    public bool $product_updates;
    public bool $is_unsubscribed;
    public ?string $unsubscribed_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'];
        $this->unsubscribe_token = $data['unsubscribe_token'] ?? '';
        $this->marketing_emails = (bool) ($data['marketing_emails'] ?? true);
        $this->order_emails = (bool) ($data['order_emails'] ?? true);
        $this->newsletter = (bool) ($data['newsletter'] ?? true);
        $this->promotions = (bool) ($data['promotions'] ?? true);
        $this->product_updates = (bool) ($data['product_updates'] ?? true);
        $this->is_unsubscribed = (bool) ($data['is_unsubscribed'] ?? false);
        $this->unsubscribed_at = $data['unsubscribed_at'] ?? null;
    }

    /**
     * Crear DTO desde un array (por ejemplo: datos validados del request)
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Retorna un array listo para guardar o actualizar en la BD
     */
    public function toArray(): array
    {
        return [
            'id'                => $this->id,
            'user_id'           => $this->user_id,
            'unsubscribe_token' => $this->unsubscribe_token,
            'marketing_emails'  => $this->marketing_emails,
            'order_emails'      => $this->order_emails,
            'newsletter'        => $this->newsletter,
            'promotions'        => $this->promotions,
            'product_updates'   => $this->product_updates,
            'is_unsubscribed'   => $this->is_unsubscribed,
            'unsubscribed_at'   => $this->unsubscribed_at,
        ];
    }
}
