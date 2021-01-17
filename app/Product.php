<?php

namespace App;

use JsonSerializable;

class Product implements JsonSerializable
{
    private $provider;
    private $item_id;
    private $click_out_link;
    private $main_photo_url;
    private $price;
    private $price_currency;
    private $shipping_price;
    private $title;
    private $description;
    private $valid_until;
    private $brand;

    public function jsonSerialize()
    {
        return [
            'provider' => $this->provider,
            'item_id' => $this->item_id,
            'click_out_link' => $this->click_out_link,
            'main_photo_url' => $this->main_photo_url,
            'price' => $this->price,
            'price_currency' => $this->price_currency,
            'shipping_price' => $this->shipping_price,
            'title' => $this->title,
            'description' => $this->description,
            'valid_until' => $this->valid_until,
            'brand' => $this->brand,
        ];
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * @param mixed $item_id
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;
    }

    /**
     * @return mixed
     */
    public function getClickOutLink()
    {
        return $this->click_out_link;
    }

    /**
     * @param mixed $click_out_link
     */
    public function setClickOutLink($click_out_link)
    {
        $this->click_out_link = $click_out_link;
    }

    /**
     * @return mixed
     */
    public function getMainPhotoUrl()
    {
        return $this->main_photo_url;
    }

    /**
     * @param mixed $main_photo_url
     */
    public function setMainPhotoUrl($main_photo_url)
    {
        $this->main_photo_url = $main_photo_url;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPriceCurrency()
    {
        return $this->price_currency;
    }

    /**
     * @param mixed $price_currency
     */
    public function setPriceCurrency($price_currency)
    {
        $this->price_currency = $price_currency;
    }

    /**
     * @return mixed
     */
    public function getShippingPrice()
    {
        return $this->shipping_price;
    }

    /**
     * @param mixed $shipping_price
     */
    public function setShippingPrice($shipping_price)
    {
        $this->shipping_price = $shipping_price;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getValidUntil()
    {
        return $this->valid_until;
    }

    /**
     * @param mixed $valid_until
     */
    public function setValidUntil($valid_until)
    {
        $this->valid_until = $valid_until;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
}
