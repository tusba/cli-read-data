<?php

namespace components\models\offer;

interface OfferInterface
{
    function getPrice(): float;
    function getVendorId(): string|int;
}
