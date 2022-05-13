<?php

namespace components\services;

use components\models\offer\OfferCollectionInterface;
use components\models\offer\OfferInterface;
use Iterator;

class DataFilterService
{
    private Iterator $iterator;

    public function __construct(OfferCollectionInterface $dataCollection)
    {
        $this->iterator = $dataCollection->getIterator();
    }

    public function filterByPriceRange(string|int|float $from, string|int|float $to): array
    {
        $result = [];

        foreach ($this->iterator as $offer) {
            /** @var OfferInterface $offer */
            $price = $offer->getPrice();
            if ($price >= $from && $price <= $to) {
                $result[] = $offer;
            }
        }

        return $result;
    }

    public function filterByVendorId(string|int $id): array
    {
        $result = [];

        foreach ($this->iterator as $offer) {
            /** @var OfferInterface $offer */
            if ($id == $offer->getVendorId()) {
                $result[] = $offer;
            }
        }

        return $result;
    }
}
