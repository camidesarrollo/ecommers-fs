<?php

namespace App\Infrastructure\Http\Requests\EmailPreference;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmailPreferenceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $emailPreferenceId = $this->route('id');

        return [
            'user_id'           => ['sometimes', 'required', 'integer', 'exists:users,id'],
            'unsubscribe_token' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('email_preferences', 'unsubscribe_token')->ignore($emailPreferenceId),
            ],
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
