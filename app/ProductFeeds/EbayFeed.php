<?php

namespace App\ProductFeeds;

use App\Product;

class EbayFeed implements FeedInterface
{
    public const PROVIDER = 'ebay';

    private $products = [];

    public function addProducts(array $data)
    {
        foreach ($data as $prd) {
            $this->addProduct($prd);
        }
    }

    public function addProduct(array $data)
    {
        $product = new Product();
        $product->setProvider(self::PROVIDER);
        $product->setBrand('Test Brand');
        $this->products[] = json_encode($product);
    }

    public function getResults()
    {
        return response()->json(
            $this->products
        );
    }
}
