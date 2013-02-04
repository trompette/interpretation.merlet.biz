<?php

require_once __DIR__.'/../vendor/autoload.php';

use Sveta\FrontController;

$ga_tracking_id = getenv('GA_TRACKING_ID');
$debug = filter_var(getenv('DEBUG'), FILTER_VALIDATE_BOOLEAN);

$fc = new FrontController($ga_tracking_id, $debug);
$fc->run();
