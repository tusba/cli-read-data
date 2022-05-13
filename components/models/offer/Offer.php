<?php

namespace components\models\offer;

class Offer implements OfferInterface
{
    private string|int $offerId;
    private string $productTitle;
    private string|int $vendorId;
    private float $price;

    public function load(array $data)
    {
        foreach ($data as $prop => $val) {
            if (property_exists($this, $prop)) {
                $this->$prop = $val;
            }
        }

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getVendorId(): string|int
    {
        return $this->vendorId;
    }
}
