<?php

namespace Sveta\Controller;

class Home extends ApplicationAware
{
    public function execute($language)
    {
        $this['monolog']->addInfo('Executing Home()');

        return $this['twig']->render('template.twig');
    }
}
