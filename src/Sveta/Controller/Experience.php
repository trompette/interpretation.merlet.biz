<?php

namespace Sveta\Controller;

class Experience extends ApplicationAware
{
    public function execute($language)
    {
        $this['monolog']->addInfo('Executing Experience()');

        return $this['twig']->render('template.twig');
    }
}
