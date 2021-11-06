<?php
namespace App;

use App\Models\Product;
use Ramsey\Uuid\Uuid;

class Create
{
    public static function createFurniture(array $post): Product
    {
        $furniture = new Product(
            Uuid::uuid4(),
            $post['sku'],
            $post['name'],
            $post['price'],
            "Dimension (CM)",
            $post['dimensions'][0]."x".$post['dimensions'][1]."x".$post['dimensions'][2]
        );

        return $furniture;
    }

    public static function createBook(array $post): Product
    {
        $book = new Product(
            Uuid::uuid4(),
            $post['sku'],
            $post['name'],
            $post['price'],
            "Weight (KG)",
            $post['weight']
        );

        return $book;
    }

    public static function createDVD(array $post): Product
    {
        $dvd = new Product(
            Uuid::uuid4(),
            $post['sku'],
            $post['name'],
            $post['price'],
            "Size (MB)",
            $post['size']
        );

        return $dvd;
    }
}