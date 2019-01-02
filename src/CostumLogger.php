<?php

namespace CostumLogger;

ini_set("display_errors",1);
ini_set("log_errors",1);
ini_set("error_log", dirname($_SERVER['DOCUMENT_ROOT'],2). '/var/log/error_log.txt');

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
        $this->stream = new StreamHandler(dirname($_SERVER['DOCUMENT_ROOT'],2). '/var/log/error_log.txt', $logger);
        $this->stream->setFormatter($formatter);

        // bind it to a logger object
        $this->log = new Logger($name);
        $this->log->pushHandler($this->stream);

        $this->log->info($name.' is nov ready');
    }
}