<?php

namespace Sveta;

use Silex\Application;

abstract class ApplicationAware implements \ArrayAccess
{
    protected $application = null;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->application, $name), $arguments);
    }

    public function offsetSet($offset, $value)
    {
        $this->application[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        return $this->application[$offset];
    }

    public function offsetExists($offset)
    {
        return isset($this->application[$offset]);
    }

    public function offsetUnset($id)
    {
        unset($this->application[$offset]);
    }
}
