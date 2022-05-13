<?php

const DS = DIRECTORY_SEPARATOR;

spl_autoload_extensions('.php');
spl_autoload_register();

use \components\logger\FileSystemLogger;

$logDir = __DIR__ . DS . 'log';
$logFileName = date('Y-m-d') . '.txt';
try {
    $logger = new FileSystemLogger($logDir . DS . $logFileName);
} catch (Exception $e) {
    printf('Error on logging: "%s"' . PHP_EOL, $e->getMessage());
    exit(1);
}
