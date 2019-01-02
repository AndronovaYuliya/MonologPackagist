<?php

ini_set("display_errors",1);
ini_set("log_errors",1);
ini_set("error_log", __DIR__ . '/var/log/error_log.txt');

require 'vendor/autoload.php';

use CostumLogger\CostumLogger;

use Monolog\ErrorHandler;
use ErrorException;
use Error;
try {
    $log=new CostumLogger();
}catch (Error $errorException){

    echo "<pre>";
    var_dump($errorException);
    echo "</pre>";
}

