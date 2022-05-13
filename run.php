<?php

const DS = DIRECTORY_SEPARATOR;
const EOL = PHP_EOL;

spl_autoload_extensions('.php');
spl_autoload_register();

use components\cli\CliController;
use components\logger\FileSystemLogger;

$logDir = __DIR__ . DS . 'log';
$logFileName = date('Y-m-d') . '.txt';
try {
    $logger = new FileSystemLogger($logDir . DS . $logFileName);
} catch (Exception $e) {
    printf('Error on logging: "%s"' . EOL, $e->getMessage());
    exit(1);
}

$cli = new CliController();
try {
    $result = $cli->run($argv);
} catch (Exception $e) {
    printf('Error on resolving CLI arguments: "%s"' . EOL, $e->getMessage());
    exit(1);
}

printf('Result is %d' . EOL, $result);
