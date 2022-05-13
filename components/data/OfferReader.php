<?php

namespace components\data;

use components\models\offer\OfferCollection;
use components\models\offer\OfferCollectionInterface;

abstract class OfferReader implements ReaderInterface
{
    abstract protected function readAsArray(string $input): array;

    public function read(string $input): OfferCollectionInterface
    {
        $dataItems = $this->readAsArray($input);

        return new OfferCollection($dataItems);
    }
}
