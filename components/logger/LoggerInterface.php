<?php

namespace components\logger;

interface LoggerInterface
{
    function log(mixed $thing): void;
}
