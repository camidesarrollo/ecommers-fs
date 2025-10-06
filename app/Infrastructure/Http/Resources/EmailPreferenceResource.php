<?php

namespace App\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EmailPreferenceResource extends JsonResource
{
    /**
     * Transforma el recurso en un array JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'unsubscribeToken' => $this->unsubscribe_token,
            'marketingEmails' => (bool) $this->marketing_emails,
            'orderEmails' => (bool) $this->order_emails,
            'newsletter' => (bool) $this->newsletter,
            'promotions' => (bool) $this->promotions,
            'productUpdates' => (bool) $this->product_updates,
            'isUnsubscribed' => (bool) $this->is_unsubscribed,
            'unsubscribedAt' => $this->unsubscribed_at
                ? Carbon::parse($this->unsubscribed_at)->toDateTimeString()
                : null,
            'isRecentlyUnsubscribed' => $this->unsubscribed_at
                ? Carbon::parse($this->unsubscribed_at)->gt(now()->subDays(7))
                : false,

            // Relación: usuario dueño de las preferencias
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),

            'createdAt' => $this->created_at?->toDateTimeString(),
            'updatedAt' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
