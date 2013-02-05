<?php

namespace Sveta\Controller;

class Index extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Index()');

        return $this->redirect($this['url_generator']->generate('home', ['language' => $this['language']]));
    }
}
