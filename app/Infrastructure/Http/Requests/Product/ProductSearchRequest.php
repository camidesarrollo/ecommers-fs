<?php
namespace App\Infrastructure\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'slug' => 'sometimes|string',
            'sku' => 'sometimes|string',
            'is_active' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'stock_status' => 'sometimes|in:in_stock,out_of_stock',
            'min_price' => 'sometimes|numeric|min:0',
            'max_price' => 'sometimes|numeric|min:0',
        ];
    }
}
