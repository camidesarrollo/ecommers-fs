<?php

namespace App\Infrastructure\Http\Requests\EmailPreference;

use Illuminate\Foundation\Http\FormRequest;

class EmailPreferenceStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'           => ['required', 'integer', 'exists:users,id'],
            'unsubscribe_token' => ['nullable', 'string', 'max:255', 'unique:email_preferences,unsubscribe_token'],
            'marketing_emails'  => ['nullable', 'boolean'],
            'order_emails'      => ['nullable', 'boolean'],
            'newsletter'        => ['nullable', 'boolean'],
            'promotions'        => ['nullable', 'boolean'],
            'product_updates'   => ['nullable', 'boolean'],
            'is_unsubscribed'   => ['nullable', 'boolean'],
            'unsubscribed_at'   => ['nullable', 'date'],
        ];
    }
}
