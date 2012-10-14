<?php

require_once __DIR__.'/../vendor/autoload.php';

$debug = false;

$application = new Sveta\Application($debug);
$application->run();
