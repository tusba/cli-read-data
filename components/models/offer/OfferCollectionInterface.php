<?php

namespace components\models\offer;

use Iterator;

interface OfferCollectionInterface
{
    function get(int $index): OfferInterface;
    function getIterator(): Iterator;
}
