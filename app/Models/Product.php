<?php

namespace App\Models;

class Product
{
    private string $id;
    private string $sku;
    private string $name;
    private float $price;
    private string $attribute;
    private string $attributeValue;

    public function __construct(string $id, string $sku, string $name, float $price, string $attribute, string $attributeValue)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attribute = $attribute;
        $this->attributeValue = $attributeValue;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
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

    public function getAttributeValue(): string
    {
        return $this->attributeValue;
    }
}