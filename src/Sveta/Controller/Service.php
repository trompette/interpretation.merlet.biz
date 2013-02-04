<?php

namespace Sveta\Controller;

use Sveta\ApplicationAware;

class Service extends ApplicationAware
{
    public function execute()
    {
        $this['monolog']->addInfo('Executing Service()');

        $template = sprintf('@%s/service.twig', $this['language']);

        return $this['twig']->render($template, array('language' => $this['language']));
    }
}
