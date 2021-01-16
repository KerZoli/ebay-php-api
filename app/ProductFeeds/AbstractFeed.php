<?php

namespace App\ProductFeeds;

abstract class AbstractFeed {

    protected $products = [];

    public function getResults()
    {
       return json_encode($this->products);
    }

    public abstract function addProduct(array $data);
}
