<?php

namespace components\data;

use components\models\offer\OfferCollectionInterface;

interface ReaderInterface
{
    function read(string $input): OfferCollectionInterface;
}
