<?php

namespace Sveta\Controller;

class Experience extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Experience()');

        return $this['twig']->render('template.twig');
    }
}
