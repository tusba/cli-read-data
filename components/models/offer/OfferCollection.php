<?php

namespace components\models\offer;

use ArrayObject;
use Exception;
use Iterator;

class OfferCollection extends ArrayObject implements OfferCollectionInterface
{
    /** @var OfferInterface[] */
    private array $items;

    public function __construct($array = array(), $flags = 0, $iteratorClass = "ArrayIterator")
    {
        $this->initItems($array);
        parent::__construct($this->items, $flags, $iteratorClass);
    }

    public function get(int $index): OfferInterface
    {
        if (!isset($this->items[$index])) {
            throw new Exception("Item [{$index}] not found");
        }

        return $this->items[$index];
    }

    public function getIterator(): Iterator
    {
        return parent::getIterator();
    }

    private function initItems(array $rawItems): void
    {
        $this->items = array_map(fn ($item) => (new Offer())->load($item), $rawItems);
    }
}
