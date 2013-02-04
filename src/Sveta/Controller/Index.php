<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Index extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Index()');

        return $this->redirect($this['url_generator']->generate('home', array('language' => $this['language'])));
    }
}
