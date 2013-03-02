<?php

namespace Sveta\Controller;

class Service extends ApplicationAware
{
    public function execute($language)
    {
        $this['monolog']->addInfo('Executing Service()');

        return $this['twig']->render('template.twig');
    }
}
