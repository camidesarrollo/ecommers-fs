<?php
/**
 * =============================================================================
 * MODELO: app/Models/EmailPreference.php
 * =============================================================================
 */

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class EmailPreference extends Model
{
    protected $fillable = [
        'user_id',
        'unsubscribe_token',
        'marketing_emails',
        'order_emails',
        'newsletter',
        'promotions',
        'product_updates',
        'is_unsubscribed',
        'unsubscribed_at',
    ];

    protected $casts = [
        'marketing_emails' => 'boolean',
        'order_emails' => 'boolean',
        'newsletter' => 'boolean',
        'promotions' => 'boolean',
        'product_updates' => 'boolean',
        'is_unsubscribed' => 'boolean',
        'unsubscribed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($preference) {
            if (empty($preference->unsubscribe_token)) {
                $preference->unsubscribe_token = Str::random(64);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Desuscribir usuario de todos los correos
     */
    public function unsubscribeAll(): void
    {
        $this->update([
            'is_unsubscribed' => true,
            'marketing_emails' => false,
            'newsletter' => false,
            'promotions' => false,
            'product_updates' => false,
            'unsubscribed_at' => now(),
        ]);
    }

    /**
     * Reactivar suscripción
     */
    public function resubscribe(): void
    {
        $this->update([
            'is_unsubscribed' => false,
            'marketing_emails' => true,
            'newsletter' => true,
            'promotions' => true,
            'product_updates' => true,
            'unsubscribed_at' => null,
        ]);
    }
}
