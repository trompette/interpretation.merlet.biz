<?php

namespace Sveta;

use Sveta\Application;

abstract class ApplicationAware
{
    protected $application = null;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }
}
