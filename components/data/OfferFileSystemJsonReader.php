<?php

namespace components\data;

use components\models\offer\OfferCollection;
use components\models\offer\OfferCollectionInterface;
use Exception;

class OfferFileSystemJsonReader implements ReaderInterface
{
    public function read(string $input): OfferCollectionInterface
    {
        if (!file_exists($input) || !($raw = file_get_contents($input))) {
            throw new Exception("Failed to read `{$input}`");
        }

        if (is_null($data = json_decode($raw, true))) {
            throw new Exception("Failed to parse `{$input}`");
        }

        return new OfferCollection($data);
    }
}
