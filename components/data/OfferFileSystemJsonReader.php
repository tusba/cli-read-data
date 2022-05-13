<?php

namespace components\data;

use Exception;

class OfferFileSystemJsonReader extends OfferReader
{
    protected function readAsArray(string $input): array
    {
        if (!file_exists($input) || !($raw = file_get_contents($input))) {
            throw new Exception("Failed to read `{$input}`");
        }

        if (is_null($data = json_decode($raw, true))) {
            throw new Exception("Failed to parse `{$input}`");
        }

        return $data;
    }
}
