<?php

namespace CostumLogger;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CostumLogger
{
    private $log;
    private $stream;

    public function __construct($name="security",$logger="DEBUG")
    {
        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y n j, g:i a";

        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output = "%datetime% > %level_name% > %message% %context% %extra%\n";

        //create a formatter
        $formatter = new LineFormatter($output, $dateFormat);

        $logger=strtoupper($logger);

        // Create a handler
        $this->stream = new StreamHandler(__FILE__.'/var/log/error_log.txt', Logger::$logger);
        $this->stream->setFormatter($formatter);

        // bind it to a logger object
        $this->log = new Logger($name);
        $this->log->pushHandler($this->stream);
    }
}