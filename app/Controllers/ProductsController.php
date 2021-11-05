<?php

namespace App\Controllers;

use App\View;

class ProductsController
{
    public function index(): ?View
    {
        return new View('products.twig', ['products' => 'apple']);
    }

    public function delete()
    {
        var_dump($_POST);
    }

    public function create(): ?View
    {
        return new View('productsAdd.twig', []);
    }

    public function store()
    {
        var_dump($_POST);
    }
}