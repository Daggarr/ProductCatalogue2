<?php
namespace App\Repositories;

use App\Models\Collections\ProductsCollection;
use App\Models\Product;
use PDO;
use PDOException;

class MySqlProductsRepository implements ProductsRepository
{
    private PDO $connection;

    public function __construct()
    {
        $config = parse_ini_file('config.ini');

        try {
            $this->connection = new PDO(
                "mysql:host={$config['serverName']};dbname={$config['dbName']}",
                $config['dbUser'],
                $config['dbPassword']);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function save(Product $product): void
    {
        $sql = "INSERT INTO products (id, sku, name, price, attribute, attribute_value) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            $product->getId(),
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getAttribute(),
            $product->getAttributeValue()
        ]);
    }

    public function getAll(): ProductsCollection
    {
        $collection = new ProductsCollection();

        $sql = "SELECT * FROM products";
        $statement = $this->connection->prepare($sql);
        $statement->execute([]);
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product)
        {
            $collection->add(new Product(
                $product['id'],
                $product['sku'],
                $product['name'],
                $product['price'],
                $product['attribute'],
                $product['attribute_value']
            ));
        }

        return $collection;
    }

    public function delete(string $id): void
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);
    }

}