<?php

namespace components\models\offer;

use ArrayObject;
use Exception;
use Iterator;

class OfferCollection extends ArrayObject implements OfferCollectionInterface
{
    /** @var OfferInterface[] */
    private array $items;

    /**
     * @inheritDoc
     * @param OfferInterface[] $array
     */
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
        return $this->getIterator();
    }

    private function initItems($rawItems)
    {
        $this->items = array_map(fn ($item) => (new Offer())->load($item), $rawItems);
    }
}
