<?php

namespace App\Infrastructure\Http\Requests\EmailPreference;

use Illuminate\Foundation\Http\FormRequest;

class EmailPreferenceIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'           => ['nullable', 'integer', 'exists:users,id'],
            'is_unsubscribed'   => ['nullable', 'boolean'],
            'marketing_emails'  => ['nullable', 'boolean'],
            'order_emails'      => ['nullable', 'boolean'],
            'newsletter'        => ['nullable', 'boolean'],
            'promotions'        => ['nullable', 'boolean'],
            'product_updates'   => ['nullable', 'boolean'],
            'limit'             => ['nullable', 'integer', 'min:1', 'max:100'],
            'offset'            => ['nullable', 'integer', 'min:0'],
        ];
    }
}
