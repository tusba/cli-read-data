<?php

namespace components\logger;

use DateTime;
use Exception;

class FileSystemLogger implements LoggerInterface
{
    public function __construct(private string $filePath)
    {
        if (!file_exists(dirname($this->filePath))) {
            throw new Exception('Directory does not exist');
        }
    }

    public function log(mixed $thing): void
    {
        $content = print_r($thing, true);
        $dt = (new DateTime())->format('Y-m-d H:i:s.u');
        $log = "[{$dt}]\t{$content}\n";

        file_put_contents($this->filePath, $log, FILE_APPEND);
    }
}
