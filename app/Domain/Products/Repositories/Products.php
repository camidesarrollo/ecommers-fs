<?php
/*
namespace App\Domain\Products\Repositories;

use App\Domain\Products\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    public function findBySlug(string $slug): ?Product;
    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator;
    public function getFeatured(int $limit = 10): Collection;
    public function getByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator;
    public function search(string $term, int $perPage = 15): LengthAwarePaginator;
    public function create(array $data): Product;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
}*/