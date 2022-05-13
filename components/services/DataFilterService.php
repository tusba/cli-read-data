<?php

namespace components\services;

class DataFilterService
{
    public function __construct(private array $data = [])
    {
    }

    public function filterByPriceRange($from, $to): array
    {
        return $this->data;
    }

    public function filterByVendorId($id): array
    {
        return $this->data;
    }
}
