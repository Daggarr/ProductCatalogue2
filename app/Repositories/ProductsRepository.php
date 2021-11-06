<?php
namespace App\Repositories;

use App\Models\Collections\ProductsCollection;
use App\Models\Product;

interface ProductsRepository
{
    public function save(Product $product):void;
    public function getAll(): ProductsCollection;
    public function delete(string $id): void;
}