<?php

namespace App\Controllers;

use App\Create;
use App\Models\Product;
use App\Repositories\MySqlProductsRepository;
use App\View;
use Ramsey\Uuid\Uuid;

class ProductsController
{

    private MySqlProductsRepository $productsRepository;

    public function __construct()
    {
        $this->productsRepository = new MySqlProductsRepository();
    }

    public function index(): ?View
    {
        $products = $this->productsRepository->getAll();

        return new View('products.twig', ['products' => $products]);
    }

    public function delete()
    {
        foreach ($_POST['productId'] as $product)
        {
            $this->productsRepository->delete($product);
        }

        header('Location: /');
    }

    public function create(): ?View
    {
        return new View('productsAdd.twig', []);
    }

    public function store()
    {
        $objectName ="create".$_POST['type'];
        $product = Create::$objectName($_POST);

        $this->productsRepository->save($product);

        header('Location: /');
    }
}