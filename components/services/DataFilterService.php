<?php

namespace components\services;

class DataFilterService
{
    public function __construct(private array $data = [])
    {
    }

    public function filterByPriceRange(string|int|float $from, string|int|float $to): array
    {
        return $this->data;
    }

    public function filterByVendorId(string|int $id): array
    {
        return $this->data;
    }
}
