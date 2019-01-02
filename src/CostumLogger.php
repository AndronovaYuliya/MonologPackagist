<?php

namespace CostumLogger;

ini_set("display_errors",1);
ini_set("log_errors",1);
ini_set("error_log", dirname($_SERVER['DOCUMENT_ROOT'],2). '/var/log/error_log.txt');

use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class CostumLogger extends Logger
{
    private $log;
    private $formatter;
    private $path;
    private $stream;

    public function __construct($name="security")
    {
        // bind it to a logger object
        $this->log = new Logger($name);

        // the default date format is "Y-m-d H:i:s"
        $dateFormat = "Y n j, g:i a";

        // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
        $output = "%datetime% > %level_name% > %message% %context% %extra%\n";

        //create a formatter
        $this->formatter = new LineFormatter($output, $dateFormat);

        $this->path = dirname($_SERVER['DOCUMENT_ROOT']).'/var/log/error_log.txt';


        // Create a handler
        $this->stream = new StreamHandler($this->path);
        $this->stream->setFormatter($this->formatter);

        $this->log->pushHandler($this->stream);

        $this->log->info($name.' is now ready');
        //$this->log->warning();
    }

    function warning($message, array $context = array()):bool
    {
        return $this->log->warning($message, $context);
    }

    function info($message, array $context = array()):bool
    {
        return $this->log->info($message, $context);
    }

    function err($message, array $context = array()):bool
    {
        return $this->log->err($message, $context);
    }

    function alert($message, array $context = array()):bool
    {
        return $this->log->alert($message, $context);
    }

    function emergency($message, array $context = array()):bool
    {
        return $this->log->emergency($message, $context);
    }

    function critical($message, array $context = array()):bool
    {
        return $this->log->critical($message, $context);
    }

    function error($message, array $context = array()):bool
    {
        return $this->log->error($message, $context);
    }

    function notice($message, array $context = array()):bool
    {
        return $this->log->notice($message, $context);
    }

    function debug($message, array $context = array()):bool
    {
        return $this->log->debug($message, $context);
    }
}