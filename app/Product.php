<?php

namespace App;

use PHPUnit\Util\Json;

class Product
{
    private $provider;
    public $item_id;
    public $click_out_link;
    public $main_photo_url;
    public $price;
    public $price_currency;
    public $shipping_price;
    public $title;
    public $description;
    public $valid_until;
    public $brand;

    public function toJson()
    {
        return json_encode($this);
    }

}
