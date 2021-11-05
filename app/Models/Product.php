<?php

namespace App\Models;

class Product
{
    private string $id;
    private string $sku;
    private string $name;
    private int $price;
    private string $attribute;

    public function __construct(string $id, string $sku, string $name, int $price, string $attribute)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attribute = $attribute;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getSku(): string
    {
        return $this->sku;
    }
}