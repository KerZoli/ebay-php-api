<?php

namespace App\ProductFeeds\Feeds;

use App\Product;
use App\ProductFeeds\AbstractFeed;

class EbayFeed extends AbstractFeed
{
    public const PROVIDER = 'ebay';

    public function addProduct(array $data)
    {
        $product = new Product();
        $product->setProvider(self::PROVIDER);
        $product->setBrand('Test Brand');
        $this->products[] = $product;
    }
}
