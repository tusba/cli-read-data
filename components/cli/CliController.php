<?php

namespace components\cli;

use components\data\OfferFileSystemJsonReader;
use components\data\ReaderInterface;
use components\logger\InitLoggerTrait;
use components\logger\LoggerInterface;
use components\services\DataFilterService;
use Exception;

class CliController
{
    const COUNT_BY_PRICE_RANGE = 'count_by_price_range';
    const COUNT_BY_VENDOR_ID = 'count_by_vendor_id';

    private LoggerInterface $logger;
    private ReaderInterface $reader;
    private string $command;
    private array $options;

    use InitLoggerTrait;

    public function __construct()
    {
        $this->initLogger();
        $this->reader = new OfferFileSystemJsonReader();
    }

    public function run(array $argv): string | int
    {
        $this->resolve($argv);
        $this->validate();
        $this->logger->log(['cmd' => $this->command, 'args' => $this->options]);

        $dataCollection = $this->reader->read(implode(DS, [__DIR__, '..', '..', 'data', 'offers.json']));
        $this->logger->log(['data' => ['total' => count($dataCollection)]]);

        $dataFilterService = new DataFilterService($dataCollection);
        switch ($this->command) {
            case self::COUNT_BY_PRICE_RANGE:
                $filteredData = $dataFilterService->filterByPriceRange(...$this->options);
                break;
            case self::COUNT_BY_VENDOR_ID:
                $filteredData = $dataFilterService->filterByVendorId(...$this->options);
                break;
            default:
                throw new Exception("Not implemented for `{$this->command}`");
        }
        $this->logger->log(['data' => ['result' => $filteredData]]);

        return count($filteredData);
    }

    private function api(): array
    {
        return [
            self::COUNT_BY_PRICE_RANGE => ['from', 'to'],
            self::COUNT_BY_VENDOR_ID => ['id'],
        ];
    }

    private function resolve(array $argv): void
    {
        $argc = count($argv);

        if ($argc < 2) {
            throw new Exception('Too few arguments');
        }

        $this->command = $argv[1];
        $this->options = array_slice($argv, 2);
    }

    private function validate(): void
    {
        $api = $this->api();

        if (!isset($api[$this->command])) {
            throw new Exception("Unrecognized command: `{$this->command}`");
        }

        $argc = count($api[$this->command]);
        if ($argc > count($this->options)) {
            throw new Exception("`{$this->command}` command accepts {$argc} argument(-s)");
        }
    }
}
