<?php

namespace components\logger;

use Exception;

trait InitLoggerTrait
{
    public function initLogger(): void
    {
        if (!isset($GLOBALS['logger'])) {
            throw new Exception('Logger is not set');
        }

        $this->logger = $GLOBALS['logger'];
    }
}
