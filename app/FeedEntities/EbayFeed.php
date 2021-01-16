<?php

namespace App\FeedEntities;

use App\Product;

class EbayFeed implements FeedInterface
{
    public const PROVIDER = 'ebay';

    private $products = [];

    public function add(array $data)
    {
        $product = new Product();
        $product->setProvider(self::PROVIDER);
        $product->setBrand('Test Brand');
        $this->products[] = $product;
    }

    public function getResults()
    {
        return json_encode($this->products);
    }
}
